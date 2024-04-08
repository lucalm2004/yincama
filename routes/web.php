<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\modalGincamasController;
use App\Http\Controllers\GrupoController;


Route::get('/', function () {
    return view('cliente');
});


Route::get('/modal', [modalGincamasController::class, 'index'])->name('modal.index');
Route::get('/grupos', [GrupoController::class, 'obtenerGrupo']);
Route::get('/creargrupo', [GrupoController::class, 'crearGrupo']);
Route::get('/unirseGrupo', [GrupoController::class, 'unirseGrupo']);
