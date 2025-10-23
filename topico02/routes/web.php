<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('ola', function () {
    echo "Hola Mundo !!!";
});


Route::get('ola', [
    HomeController::class,
    'index'
]);

Route::get('greetings', 'App\Http\Controllers\HomeController@welcome');

Route::get('greetings/{name?}', 'App\Http\Controllers\HomeController@welcome');

Route::get('listusers', [HomeController::class, 'listUsers']);


// Route::get('produtos',[ProdutoController::class,'index']);
// Route::get('produtos/{id}',[ProdutoController::class,'show'])->name('produtos.show');
// Route::get('produto',[ProdutoController::class,'create']);
// Route::post('produto',[ProdutoController::class,'store']);
// Route::get('produto/{id}/edit',[ProdutoController::class,'edit'])->name('produtos.edit');
// Route::post('produto/{id}/edit',[ProdutoController::class,'update'])->name('produtos.update');

// Use o seguinte comando para listar suas rotas de 'produto': sail/php artisan route:list --path=produto

/**
 * Exemplo de resource: cria todas as rotas automaticamente,
 * .. mas deve cuidar o padrão de parâmetros que muda e usar
 * .. @method para os forms submetidos as rotas PUT e DELETE
 */

// Route::resource('products',ProdutoController::class);

//AGRUPAMENTO DE ROTAS
//Rotas agrupadas pelo prefixo "produtos"
Route::prefix('/produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'index'])->name("produtos.index");
    Route::get('/{id}',[ProdutoController::class, 'show'])->name("produtos.show");
});

//Rotas agrupadas pelo prefixo "produto"
Route::prefix('/produto')->group(function () {
    Route::get('/',[ProdutoController::class, 'create'] )->name("produto.create");
    Route::post('/',[ProdutoController::class, 'store'])->name("produto.store");
    Route::get('/{id}/edit',[ProdutoController::class, 'edit'])->name("produto.edit");
    Route::post('/{id}/update',[ProdutoController::class, 'update'])->name("produto.update");
});
