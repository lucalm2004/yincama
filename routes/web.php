<?php
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/cliente', function() {
//     return view('cliente.index');
// });


Route::get('/cliente', [ClienteController::class, 'redirecion_pagina']) ->name('redirecion_pagina');

Route::post('/cliente', [ClienteController::class, 'listar_lugares']) ->name('listar_lugares');

Route::post('/añadir_like', [ClienteController::class, 'dar_favorito']) ->name('dar_favorito');

Route::post('/añadir_camino', [ClienteController::class, 'listar_lugares']) ->name('listar_lugares');

Route::post('/mostrar_favorito', [ClienteController::class, 'mostrar_favorito']) ->name('mostrar_favorito');
