<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\tbl_usuarios;

class AuthController extends Controller
{
    /**
     * Función que se encarga de recibir los datos del formulario de inicio de sesión,
     * comprobar que el usuario existe y en caso de éxito, iniciar sesión.
     */
    public function iniciarSesion(Request $request)
    {
        // Validar las credenciales
        $request->validate([
            'user' => 'required',
            'contra' => 'required',
        ]);

        $usuario = $request->input('user');
        $contraseña = $request->input('contra');

        // Comprobamos si el usuario existe y si las credenciales son válidas
        $usuarioValido = tbl_usuarios::where('nombre_user', $usuario)
            ->first();

        if ($usuarioValido) {
            // Autenticar al usuario
            Auth::login($usuarioValido);

            // Almacenar información del usuario en la sesión si es necesario
            Session::put('usuario', $usuarioValido);

            // Redirigir según el rol del usuario
            if ($usuarioValido->Rol == 'admin') {
                return redirect()->route('home_admin');
            } elseif ($usuarioValido->Rol == 'cliente') {
                return redirect()->route('user_home');
            } elseif ($usuarioValido->Rol == 'gestor') {
                return redirect()->route('home_gestor');
            } elseif ($usuarioValido->Rol == 'tecnico') {
                return redirect()->route('tecnico_home');
            }
        }

        // Si las credenciales son inválidas, redirigir de nuevo a la página de inicio de sesión con un mensaje de error
        return redirect()->route('home')->with('error', 'Credenciales inválidas. Inténtelo de nuevo.');
    }
}
