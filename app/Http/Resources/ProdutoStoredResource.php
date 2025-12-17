<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProdutoStoredResource extends ProdutoResource
{
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode(201,'Produto Criado!');

    }

    public function with(Request $request):array
    {
        return [
            "message" => 'Produto criado com sucesso !!!'
        ];
    }
}
