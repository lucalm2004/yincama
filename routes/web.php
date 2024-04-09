<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/admintest', function () {
    return view('admin');
});

Route::post('/selectCategoria', [adminController::class, 'selectCategoria'])->name('selectCategoria');
Route::post('/crearCategoria', [adminController::class, 'crearCategoria'])->name('crearCategoria');
Route::post('/elimCategoria', [adminController::class, 'elimCategoria'])->name('elimCategoria');


Route::post('/selectMarcador', [adminController::class, 'selectMarcador'])->name('selectMarcador');
Route::post('/crearMarcador', [adminController::class, 'crearMarcador'])->name('crearMarcador');
