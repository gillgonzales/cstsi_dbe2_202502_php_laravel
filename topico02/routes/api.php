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

    //Rotas privadas (sanctum cookies)
    Route::middleware(['auth:sanctum', 'web'])->group(function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });

        // Route::apiResource('produtos', ProdutoController::class)
        //     ->only(['store', 'update'])
        //     ->middleware('ability:is_admin,is_manager');

        // Route::apiResource('produtos', ProdutoController::class)
        //     ->only(['destroy'])
        //     ->middleware('ability:is_admin'); //Apenas o Admin remove produtos da base

        Route::controller(ProdutoController::class)->group(function (){
                Route::middleware('ability:is_admin,is_manager')
                    ->group(function () {
                          Route::post('produtos','store');
                          Route::put('produtos/{produto}','update');
                    });
                Route::delete('produtos/{produto}','destroy')->middleware('ability:is_admin');
        });

        Route::apiResource('users', UserController::class)->except(['index', 'store']);

        Route::apiResource('users', UserController::class)
            ->only(['index'])
            ->middleware('ability:is_admin'); //Apenas Admin lista usuários

        Route::post('logout', [LoginStatefulController::class, 'logout']);
    });

   //Rotas privadas (sanctum tokens)
    Route::prefix('token')
        ->middleware('auth:sanctum')
        ->controller(LoginTokensController::class)
        ->group(function () {
            Route::post('refresh', 'refresh');
            Route::post('logout', 'logout');
            Route::get('user', function (Request $request) {
                    return $request->user()->currentAccessToken();
            });
        });
});
