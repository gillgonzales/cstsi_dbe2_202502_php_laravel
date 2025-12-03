<?php

namespace App\Services\Produto;

use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Requests\ProdutoUpdateRequest;
use App\Models\Produto;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProdutoUploadService
{
    private static $path = 'produtos/';

    public static function handleUploadFile(UploadedFile $produtoImage): string | null
    {
        $hashedFileName = $produtoImage->hashName();
        if (!$produtoImage->store(self::$path, 'public'))
            throw new Exception("Erro ao salvar imagem do produto!!");
        if(!Storage::disk('public')->exists(self::$path.$hashedFileName))
            return null;
        return $hashedFileName;
    }
  }
