<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProdutoCollection extends ResourceCollection
{
    /**
     * Transform the resource collectiassertJsonIsArrayon into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // JsonResource::withoutWrapping();
        return parent::toArray($request);
    }
}
