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
        $novoProduto['importado'] = $request->has('importado');
        if(Produto::create($novoProduto))
            return redirect('/produtos');
        else dd("Erro ao inserir produto!!!");
    }

    public function edit($id){
        $produto = Produto::find($id);
        if($produto)
            return view('produtos.edit',compact('produto'));
        else dd("Produto não encontrado!!!");
    }


    public function update(Request $request, $id){

    }

    public function delete($id){


    }

    public function remove($id){

    }
}
