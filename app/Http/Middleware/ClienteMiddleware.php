<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClienteMiddleware
{
    public function handle($request, Closure $next)
    {
        // Obtener el valor de 'rolUser' de la sesión
        $rolUser = session('rolUser');

        // Comprobar si el usuario tiene el rol de administrador
        if ($rolUser && $rolUser === 'cliente') {
            // Si es administrador, continuar con la solicitud
            return $next($request);
        }

        // Si el usuario no es administrador, retornar un error 403 (Acceso no autorizado)
        abort(403, 'Acceso no autorizado.');
    }
}
