<?php

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
        $contrase�a = $request->input('contra');
        $usuarioValido = tbl_usuarios::where('correo_user', $usuario)->first();
        if ($usuarioValido) {
            if (password_verify($contrase�a, $usuarioValido->pwd_user)) {
                Session::put('id_user', $usuarioValido->id_user);
                Session::put('usuario', $usuarioValido->nombre_user);
                Session::put('rol', $usuarioValido->id_rol_fk);
                if ($usuarioValido->id_rol_fk == 2) {
                    echo "admin";
                } else {
                    echo "noAdmin";
                }
            } else {
                echo "mal";
            }
        } else {
            echo "mal";
        }
    }

    public function registro(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'user' => 'required|email|unique:tbl_usuario,correo_user',
            'contra' => 'required',
        ]);

        $idRol = 1;

        $usuario = new tbl_usuarios();
        $usuario->nombre_user = $request->input('nombre');
        $usuario->correo_user = $request->input('user');
        $usuario->pwd_user = bcrypt($request->input('contra'));
        $usuario->id_rol_fk = $idRol;

        $usuario->save();

        Session::put('id_user', $usuario->id);
        Session::put('usuario', $request->input('user'));
        Session::put('rol', 2);

        return response()->json(['message' => 'Usuario creado correctamente'], 200);
    }
}
