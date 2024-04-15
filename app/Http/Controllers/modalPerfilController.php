<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;



class modalPerfilController extends Controller
{
   public function index()
{
    $id_user = Session::get('id_user');

    // Consulta para obtener los resultados de la tabla tbl_grupos_user
    $modal = DB::table('tbl_grupos_user')
        ->join('tbl_usuario', 'tbl_grupos_user.id_user', '=', 'tbl_usuario.id_user')
        ->where('tbl_grupos_user.id_user', $id_user)
        ->get();

    // Verificar si no hay resultados en tbl_grupos_user
    if ($modal->isEmpty()) {
        // Si no hay resultados, consultar solo en la tabla tbl_usuario
        $modal = DB::table('tbl_usuario')
            ->where('tbl_usuario.id_user', $id_user)
            ->get();
    }

    // Mostrar los resultados
   // dd($modal);

    return view('perfil.index', compact('modal'));
}

    public function cambiarPwd()
    {

        $id_user = Session::get('id_user');
        $pwd = $_POST['contraseña'];
        $pwdcr = bcrypt($pwd);

        DB::table('tbl_usuario')
    ->where('id_user', $id_user)
    ->update([
        'pwd_user' => $pwdcr,
    ]);

    }
    public function cambiarUser()
{
    $id_user = Session::get('id_user');
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    DB::table('tbl_usuario')
->where('id_user', $id_user)
->update([
    'nombre_user' => $nombre,
    'correo_user' => $correo,

]);

}

    
    
}
