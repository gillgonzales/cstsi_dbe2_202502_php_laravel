<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ExceptionJsonResponse;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Requests\ProdutoUpdateRequest;
use App\Http\Resources\ProdutoCollection;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\ProdutoStoredResource;
use App\Http\Resources\ProdutoUpdatedResource;
use App\Models\Produto;
use App\Repositories\ProdutoRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //retornamos uma coleção de modelos de Produto no formato JSON com a classe
        //Resource Collection de Produto.
        return new ProdutoCollection(Produto::all()->load('media'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdutoStoreRequest $request)
    {
         try {
            $novoProduto = ProdutoRepository::store($request->validated());
            return new ProdutoStoredResource($novoProduto);
        } catch (Exception $error) {
            $this->errorHandler("Erro ao criar Produto!!",$error);
        }
    }

    /**
     * Display the specified resource.
     * Pelo Route Model Binding, quando não encontra retorna a página 404
     */
    public function show(Produto $produto)
    {
        //A classe ProdutoResouce é para um único objeto no formato JSON
        // recebe o objeto do modelo para retornar como JSON
        return new ProdutoResource($produto->load(['fornecedor.estado','media','promocoes']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdutoUpdateRequest $request, Produto $produto)
    {
        try {
            $produto->update($request->validated());
            return new ProdutoUpdatedResource($produto);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao atualizar o protudo!!!", $error, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        try {
            $produto->delete();
            return new ProdutoResource($produto)
            ->additional(["message"=>"Produto removido com sucesso!!!"]);
        } catch (Exception $error) {
            return $this->errorHandler("Erro ao remover o protudo!!!", $error, 500);
        }
    }
}
