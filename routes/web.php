<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\modalGincamasController;
use App\Http\Controllers\modalPerfilController;
use App\Http\Controllers\ClienteController;

use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('login');
});

Route::post('/logear', [LoginController::class, 'iniciarSesion'])->name('logear');

Route::get('/cliente', function () {
    return view('cliente');
})->name('cliente');

Route::get('/modal', [modalGincamasController::class, 'index'])->name('modal.index');
Route::get('/perfil', [modalPerfilController::class, 'index'])->name('perfil.index');
Route::post('/cambiarUser', [modalPerfilController::class, 'cambiarUser']);
Route::get('/grupos', [GrupoController::class, 'obtenerGrupo']);
Route::get('/creargrupo', [GrupoController::class, 'crearGrupo']);
Route::get('/unirseGrupo', [GrupoController::class, 'unirseGrupo']);
Route::get('/agregaGrupo', [GrupoController::class, 'agregaGrupo']);

Route::post('/cambiarpwd', [modalPerfilController::class, 'cambiarPwd']);


Route::get('/cliente', [ClienteController::class, 'redirecion_pagina']) ->name('redirecion_pagina');

Route::post('/cliente', [ClienteController::class, 'listar_lugares']) ->name('listar_lugares');

Route::post('/añadir_like', [ClienteController::class, 'dar_favorito']) ->name('dar_favorito');

Route::post('/añadir_camino', [ClienteController::class, 'listar_lugares']) ->name('listar_lugares');

Route::post('/mostrar_favorito', [ClienteController::class, 'mostrar_favorito']) ->name('mostrar_favorito');