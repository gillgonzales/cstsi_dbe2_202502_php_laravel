<?php

use App\Http\Controllers\Api\Auth\LoginStatefulController;
use App\Http\Controllers\Api\Auth\LoginTokensController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rotas da api para o endpoint produtos com apiResource

Route::prefix('v1')->group(function () {
    Route::apiResource('produtos', ProdutoController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('produtos', ProdutoController::class)
            ->only(['store','update']);

        Route::apiResource('produtos', ProdutoController::class)
            ->only(['delete'])
            ->middleware('ability:is-admin');//Apenas o Admin remove produtos da base

        Route::apiResource('users', UserController::class)->except(['index']);
        Route::apiResource('users', UserController::class)
            ->only(['index'])
            ->middleware('ability:is-admin');//Apenas Admin lista usuários
    });

    Route::apiResource('users', UserController::class)
        ->except(['index','show']);


    Route::middleware('web')->group(function () {
        Route::post('login', [LoginStatefulController::class, 'login']);
        Route::post('logout', [LoginStatefulController::class, 'logout'])->middleware('auth:sanctum');
    });

    Route::prefix('token')
        ->controller(LoginTokensController::class)
        ->group(function (){
            Route::post('login','login');
        });
});
