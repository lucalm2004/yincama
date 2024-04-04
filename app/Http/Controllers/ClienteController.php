<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function cliente()
    {
        return view('form_cliente.index');
    }
}
