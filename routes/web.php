<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\modalGincamasController;
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
Route::get('/grupos', [GrupoController::class, 'obtenerGrupo']);
Route::get('/creargrupo', [GrupoController::class, 'crearGrupo']);
Route::get('/unirseGrupo', [GrupoController::class, 'unirseGrupo']);
Route::get('/agregaGrupo', [GrupoController::class, 'agregaGrupo']);

