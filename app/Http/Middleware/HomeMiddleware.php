<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class HomeMiddleware
{
    public function handle($request, Closure $next)
    {
        $rolUser = session('id_rol_fk');
        $user = session('nombre_user');

        if ($rolUser && $rolUser === '1') {
            return response(view('admin'));
        } elseif ($rolUser && $rolUser === '2') {
            return response(view('cliente'));
        }

        // Si el usuario no es administrador, retornar un error 403 (Acceso no autorizado)
        abort(403, 'Acceso no autorizado.');
    }
}
