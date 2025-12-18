<?php

namespace App\Services;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProdutoUploadService
{
    private static $path = 'produtos';

    public static function handleUploadFile(UploadedFile $produtoImage): array | null
    {
        $hashFilename = $produtoImage->hashName();
        $result = Storage::putFile(self::$path, $produtoImage);

        if (!$result)
            throw new Exception("Erro ao salvar imagem do produto!!");

        $public_id = self::$path."/$hashFilename";
        $url = Storage::url($public_id);

        if (!$url)
            throw new Exception("Erro ao salvar imagem $public_id em Cloudnary!!");

        return compact('url','public_id');
    }
}
