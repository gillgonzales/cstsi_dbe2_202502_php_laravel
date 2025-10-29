<?php

use App\Http\Controllers\Api\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rotas da api para o endpoint produtos com apiResource

Route::prefix('v1')->group(function () {
    Route::apiResource('produtos', ProdutoController::class);
});
