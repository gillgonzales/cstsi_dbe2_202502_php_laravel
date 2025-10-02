<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index() {
        $listProdutos = Produto::all();
        // return response()->json($listProdutos);
        return view('produtos.index',["listProdutos"=>$listProdutos]);
    }

    public function show($id){}
}
