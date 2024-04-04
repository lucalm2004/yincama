<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cliente', [ClienteController::class, 'cliente']) ->name('cliente');