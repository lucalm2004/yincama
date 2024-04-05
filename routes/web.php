<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\modalGincamasController;


Route::get('/', function () {
    return view('cliente');
});


Route::get('/modal', [modalGincamasController::class, 'index'])->name('modal.index');
