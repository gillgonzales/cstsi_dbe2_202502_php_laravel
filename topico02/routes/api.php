<?php

use App\Http\Controllers\Api\Auth\LoginStatefulController;
use App\Http\Controllers\Api\Auth\LoginTokensController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Rotas da api para o endpoint produtos com apiResource

Route::prefix('v1')->group(function () {

    //Rotas Públicas
    Route::apiResource('produtos', ProdutoController::class);

    Route::apiResource('users', UserController::class)->only(['store']);

    Route::middleware('web')->post('login', [LoginStatefulController::class, 'login']);

    Route::prefix('token')->group(function () {
        Route::post('login', [LoginTokensController::class, 'login']);
    });

    //Rotas privadas (sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('produtos', ProdutoController::class)
            ->only(['store', 'update']);

        Route::apiResource('produtos', ProdutoController::class)
            ->only(['delete'])
            ->middleware('ability:is-admin'); //Apenas o Admin remove produtos da base

        Route::apiResource('users', UserController::class)->except(['index']);

        Route::apiResource('users', UserController::class)
            ->only(['index'])
            ->middleware('ability:is-admin'); //Apenas Admin lista usuários


        Route::prefix('token')
            ->controller(LoginTokensController::class)
            ->group(function () {
                Route::post('refresh', 'refresh');
                Route::post('logout', 'logout');
            });

        Route::middleware('web')->post('logout', [LoginStatefulController::class, 'logout']);
    });
});
