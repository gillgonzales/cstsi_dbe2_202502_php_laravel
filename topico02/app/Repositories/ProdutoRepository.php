<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Services\ProdutoUploadService;
use Exception;
use Illuminate\Support\Facades\DB;

class ProdutoRepository
{
    public static function store(array $produtoData): Produto
    {
        try {
            if (!isset($produtoData['imagem']) && !isset($produtoData['video']))
                return Produto::create($produtoData);

            $novoProduto = Produto::make($produtoData);

            DB::beginTransaction();
            $novoProduto->save();
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
                    'source' => $produtoData['video']
                ]);
            }
            $novoProduto->load('media');
            $novoProduto->refresh();
            return $novoProduto;
        } catch (Exception $error) {
            DB::rollBack();
            throw $error;
        }finally{
            DB::commit();
        }
    }
}
