<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProdutoController extends Controller
{
    public function index() {
        $listProdutos = Produto::all();
        // dd($listProdutos);
        // return response()->json($listProdutos);

        return View::make('produtos.index',["listProdutos"=>$listProdutos]);
    }

    //Também usaremos Route Model Bind
    public function show(Produto $produto){
        // $produto = Produto::find($id);
        // dd($produto);
        return view('produtos.show',['produto'=>$produto]);
    }

    public function create(){
        return view('produtos.create');
    }

    public function store(Request $request){
        // dd($request->all());
        $novoProduto = $request->all();
        // dd($novoProduto);
        $novoProduto['importado'] = $request->has('importado');
        // dd($novoProduto);
        if(Produto::create($novoProduto))
            return redirect('/produtos');

        dd("Erro ao inserir produto!!!");
    }

    //Receberá diretamente o modelo de produto de acordo com o id passado na url
    public function edit(Produto $produto){
        // $produto = Produto::find($id);//Não é necessário com Route Model Bind

        if($produto)
            return view('produtos.edit', compact('produto'));

        dd("Produto não encontrado!!!");
    }

    //Corrigimos os métodos para receber diretamente a Model $produto
    public function update(Request $request,Produto $produto){//Importante tipar o argumento

        $updatedProduto = $request->all();

        $updatedProduto['importado'] = $request->has('importado');

        // $produtoAtual = Produto::find($id);// Não é mais necessário
        if($produto){
            if($produto->update($updatedProduto)){
                return redirect('/produtos');
            }
        }
        dd("Erro ao atualizar o produto!!!");
    }

    // public function delete($id){
    public function delete(Produto $produto){//Reescrito com Route Model Bind
    //    $produto = Produto::find($id);//Desnecessário
    // A model de produto será encontrada e passada ao método
    //diretamente, ou o laravel mesmo retorno um erro se não encontrar.
        if($produto)
            return view('produtos.delete', compact('produto'));

        dd("Produto não encontrado!!!");

    }

    //Para recursos é necessário manter o nome padrão 'destroy'
    public function destroy(Produto $produto){
        //realmente realiza a remoção no banco
        //User o método destroy do Eloquent (Model)
        try{
          Produto::destroy($produto->id);
          return redirect('/produtos');
        }catch(Exception $error){
            dd($error);
        }
    }
}
