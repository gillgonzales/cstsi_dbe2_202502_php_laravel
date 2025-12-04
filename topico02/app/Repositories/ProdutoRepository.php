<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Services\ProdutoUploadService;
use Exception;

class ProdutoRepository
{
    public static function store(array $produtoData): Produto
    {
        if (!isset($produtoData['imagem']) && !isset($produtoData['video']))
            return Produto::create($produtoData);


        $novoProduto = Produto::create($produtoData);

        if (isset($produtoData['imagem'])) {
            $produtoData['imagem'] = ProdutoUploadService::handleUploadFile($produtoData['imagem']);
            if (!$produtoData['imagem'])
                throw new Exception("Erro ao salvar produto com imagem!!");

            $novoProduto->media()->create([
                'source' => $produtoData['imagem']
            ]);
        }

        if (isset($produtoData['video'])) {
            $novoProduto->media()->create([
                'source' => $produtoData['videvideoo']
            ]);
        }

        return $novoProduto->load('media');
    }
}
