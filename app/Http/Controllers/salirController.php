<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class salirController extends Controller
{
    public function salir()
    {
        Session::flush();
        return redirect('/');
    }
} 