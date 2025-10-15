<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('ola',function(){
    echo "Hola Mundo !!!";
});


Route::get('ola', [
    HomeController::class,
    'index'
]);

Route::get('greetings', 'App\Http\Controllers\HomeController@welcome');

Route::get('greetings/{name?}', 'App\Http\Controllers\HomeController@welcome');

Route::get('listusers',[HomeController::class,'listUsers']);


Route::get('produtos',[ProdutoController::class,'index']);
Route::get('produtos/{id}',[ProdutoController::class,'show'])->name('produtos.show');
Route::get('produto',[ProdutoController::class,'create']);
Route::post('produto',[ProdutoController::class,'store']);
Route::get('produto/{id}/edit',[ProdutoController::class,'edit'])->name('produtos.edit');
Route::post('produto/{id}/edit',[ProdutoController::class,'update'])->name('produtos.update');
