<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoCollection;
use App\Http\Resources\ProdutoResource;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //retornamos uma coleção de modelos de Produto no formato JSON com a classe
        //Resource Collection de Produto.
        return new ProdutoCollection(Produto::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * Pelo Route Model Binding, quando não encontra retorna a página 404
     */
    public function show(Produto $produto)
    {
        //A classe ProdutoResouce é para um único objeto no formato JSON
        // recebe o objeto do modelo para retornar como JSON
        return new ProdutoResource($produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
