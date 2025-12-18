<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Services\ProdutoUploadService;
use Exception;
use Illuminate\Http\Request;
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
                $uploadedImage = ProdutoUploadService::handleUploadFile($produtoData['imagem']);

                $novoProduto->media()->create([
                    'source' => $uploadedImage['url'],
                    'public_id'=> $uploadedImage['public_id']
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
