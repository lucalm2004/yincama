<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\modalGincamasController;
use App\Http\Controllers\modalPerfilController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\salirController;
use App\Http\Controllers\iniciarYim;
use App\Http\Middleware\HomeMiddleware;
use App\Http\Controllers\adminController;

use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('login');
});

Route::post('/logear', [LoginController::class, 'iniciarSesion'])->name('logear');
Route::post('/resgistrar', [LoginController::class, 'registro'])->name('resgistrar');

Route::middleware(HomeMiddleware::class)->group(function () {
    Route::view('home', 'home');
});

Route::middleware('auth')->get('/user', function () {
    $user = auth()->user();

    return $user;
});

Route::middleware('admin')->group(function () {
    Route::view('admin', 'admin');
});

Route::middleware('cliente')->group(function () {
    Route::view('cliente', 'cliente');
});

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

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


// Route::get('/cliente', [ClienteController::class, 'redirecion_pagina']) ->name('redirecion_pagina');

Route::post('/cliente', [ClienteController::class, 'listar_lugares'])->name('listar_lugares');

Route::post('/anadir_like', [ClienteController::class, 'dar_favorito'])->name('dar_favorito');

Route::post('/añadir_camino', [ClienteController::class, 'listar_lugares'])->name('listar_lugares');

Route::post('/mostrar_favorito', [ClienteController::class, 'mostrar_favorito'])->name('mostrar_favorito');

Route::get('/salir', [salirController::class, 'salir'])->name('salir');
Route::post('/mostrar_tipos', [ClienteController::class, 'mostrar_tipos'])->name('mostrar_tipos');
Route::post('/listar_lugares_teatro', [ClienteController::class, 'listar_lugares_teatro'])->name('listar_lugares_teatro');

Route::post('/listar_lugares_centros_comerciales', [ClienteController::class, 'listar_lugares_centros_comerciales'])->name('listar_lugares_centros_comerciales');

Route::post('/listar_lugares_playas', [ClienteController::class, 'listar_lugares_playas'])->name('listar_lugares_playas');

Route::post('/listar_lugares_museos', [ClienteController::class, 'listar_lugares_museos'])->name('listar_lugares_museos');

Route::post('/listar_lugares_bares', [ClienteController::class, 'listar_lugares_bares'])->name('listar_lugares_bares');

Route::post('/listar_lugares_parques', [ClienteController::class, 'listar_lugares_parques'])->name('listar_lugares_parques');

Route::post('/listar_lugares_discotecas', [ClienteController::class, 'listar_lugares_discotecas'])->name('listar_lugares_discotecas');

Route::post('/listar_lugares_monumentos', [ClienteController::class, 'listar_lugares_monumentos'])->name('listar_lugares_monumentos');

Route::post('/listar_lugares_restaurante', [ClienteController::class, 'listar_lugares_restaurante'])->name('listar_lugares_restaurante');

Route::post('/listar_lugares_estacion', [ClienteController::class, 'listar_lugares_estacion'])->name('listar_lugares_estacion');
Route::get('/eliminarGrupo', [GrupoController::class, 'eliminarGrupo']);
Route::post('/iniciarYim', [iniciarYim::class, 'iniciarYim'])->name('iniciarYim');
Route::post('/ubicacion', [iniciarYim::class, 'ubicacion'])->name('ubicacion');
Route::post('/mostrar_tipos', [ClienteController::class, 'mostrar_tipos'])->name('mostrar_tipos');


Route::post('/selectCategoria', [adminController::class, 'selectCategoria'])->name('selectCategoria');
Route::post('/crearCategoria', [adminController::class, 'crearCategoria'])->name('crearCategoria');
Route::post('/elimCategoria', [adminController::class, 'elimCategoria'])->name('elimCategoria');


Route::post('/selectMarcador', [adminController::class, 'selectMarcador'])->name('selectMarcador');
Route::post('/crearMarcador', [adminController::class, 'crearMarcador'])->name('crearMarcador');
Route::post('/elimMarcador', [adminController::class, 'elimMarcador'])->name('elimMarcador');


Route::post('/selectYincana', [adminController::class, 'selectYincana'])->name('selectYincana');
Route::post('/crearYincana', [adminController::class, 'crearYincana'])->name('crearYincana');
Route::post('/elimYincana', [adminController::class, 'elimYincana'])->name('elimYincana');
