<?php

// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\tbl_usuarios;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function iniciarSesion(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'contra' => 'required',
        ]);

        $usuario = $request->input('user');
        $contraseña = $request->input('contra');

        // Comprobamos si el usuario existe y si las credenciales son válidas
        $usuarioValido = tbl_usuarios::where('correo_user', $usuario)->first();
        if ($usuarioValido) {
            // Verificar si la contraseña coincide utilizando Auth::attempt
            if (password_verify($contraseña, $usuarioValido->pwd_user)) {
                // Las credenciales son correctas
                // Almacenar información del usuario en la sesión
                Session::put('usuario', $usuarioValido);
                Session::put('rol', $usuarioValido->id_rol_fk); // Guardar el rol en la sesión
                // Redirigir según el rol del usuario
                // Agrega este código según tus necesidades
                if ($usuarioValido->id_rol_fk==1){
                    echo "admin";
                }
                else{
                    echo "noAdmin";
                }
            } else {
                // Las credenciales son inválidas
                return view('login')->with('error', 'Credenciales inválidas. Inténtelo de nuevo.');
            }
        } else {
            // El usuario no existe
            return view('login')->with('error', 'El usuario no existe.');
        }
    }
}
