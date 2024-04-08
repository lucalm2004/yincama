<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
// Route::post('/vamos', 'AuthController@iniciarSesion')->name('inicio');
Route::post('/vamos', function(){
    return view('home');
});
Route::post('/yim', function(){
    return "hola";
});