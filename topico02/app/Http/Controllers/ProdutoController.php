<?php

namespace App\Http\Controllers;

use App\Models\Produto;
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

    public function show($id){
        $produto = Produto::find($id);
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

    public function edit($id){
        $produto = Produto::find($id);

        if($produto)
            return view('produtos.edit', compact('produto'));

        dd("Produto não encontrado!!!");
    }


    public function update(Request $request, $id){

        $updatedProduto = $request->all();

        $updatedProduto['importado'] = $request->has('importado');

        $produtoAtual = Produto::find($id);
        if($produtoAtual){
            if($produtoAtual->update($updatedProduto)){
                return redirect('/produtos');
            }
        }
        dd("Erro ao atualizar o produto!!!");
    }

    public function delete($id){
        //formulário de confirmação

    }

    public function remove($id){
        //realmente realiza a remoção no banco
        //User o método destroy do Eloquent (Model)
    }
}
