<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoUpdatedResource extends ProdutoResource
{

    public function with(Request $request)
    {
        return ["message"=>"Produto Atualizado!!!"];
    }
}
