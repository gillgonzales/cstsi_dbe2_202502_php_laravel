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
// Route::prefix('/produtos')->group(function () {
//     Route::get('/', [ProdutoController::class, 'index'])->name("produtos.index");
//     Route::get('/{id}',[ProdutoController::class, 'show'])->name("produtos.show");
// });

// //Rotas agrupadas pelo prefixo "produto"
// Route::prefix('/produto')->group(function () {
//     Route::get('/',[ProdutoController::class, 'create'] )->name("produto.create");
//     Route::post('/',[ProdutoController::class, 'store'])->name("produto.store");
//     Route::get('/{id}/edit',[ProdutoController::class, 'edit'])->name("produto.edit");
//     Route::put('/{id}/update',[ProdutoController::class, 'update'])->name("produto.update");
//     Route::get('/{id}/delete',[ProdutoController::class, 'delete'])->name("produto.delete");
//     Route::delete('/{id}/destroy',[ProdutoController::class, 'remove'])->name("produto.destroy");
// });

//Rotas por controlador
// Route::controller(ProdutoController::class)->group(function(){
//     Route::get('/produtos','index')->name("produtos.index");
//     Route::get('/produtos/{id}','show')->name("produtos.show");
//     Route::get('/produto','create')->name("produto.create");
//     Route::post('/produto','store')->name("produto.store");
//     Route::get('/produto/{id}/edit','edit')->name("produto.edit");
//     Route::put('/produto/{id}/update','update')->name("produto.update");
//     Route::get('/produto/{id}/delete','delete')->name("produto.delete");
//     Route::delete('/produto/{id}/destroy','remove')->name("produto.destroy");
// });

//Combinação de vários agrupamentos Controller e Prefixo
Route::controller(ProdutoController::class)->group(function () {
    // Rotas agrupadas pelo prefixo "produtos"
    Route::prefix('/produtos')->group(function () {
        Route::get('/', 'index')->name("produtos.index");
        Route::get('/{id}', 'show')->name("produtos.show");
    });

    //rota->middleware->controller
    //Agrupamento por middlewares
    Route::middleware('auth')->group(function () {//Protegidas por autenticação
        // Rotas agrupadas pelo prefixo "produto"
        Route::prefix('/produto')->group(function () {
            Route::get('/',  'create')->name("produto.create");
            Route::post('/', 'store')->name("produto.store");
            Route::get('/{id}/edit',  'edit')->name("produto.edit");
            Route::put('/{id}/update', 'update')->name("produto.update");
            Route::get('/{id}/delete', 'delete')->name("produto.delete");
            Route::delete('/{id}/destroy', 'remove')->name("produto.destroy");
        });
    });
});


//Exemplo para testar o middleware padrão Auth do laravel
Route::get('login',function(){
    echo "<h1>O middleware AUTH redireciona para a rota login se não encontrar uma sessão ativa!!!<h1>";
    echo "<p>Trabalharemos com middleware de autenticação na API</p>";
})->name('login');//O laravel internamente prefere usar os nomes
