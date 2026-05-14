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
        $novoProduto = $request->all();
        $novoProduto['importado'] = $request->has('importado');
        if(Produto::create($novoProduto))
            return redirect('/produtos');
        dd("Erro ao inserir produto!!!");
    }

    public function edit($id){
        $produto = Produto::find($id);
        if(!$produto) dd("Produto não encontrado!!!");
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id){
        $updatedProduto = $request->all();
        $updatedProduto['importado'] = $request->has('importado');
        if(!Produto::find($id)->update($updatedProduto))
            dd("Erro ao atualizar o produto!!!");
        return redirect('/produtos');

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
