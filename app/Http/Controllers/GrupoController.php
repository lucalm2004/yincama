<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    public function obtenerGrupo(Request $request)
    {
        // Captura el ID enviado en la solicitud AJAX
        $id = $request->input('id');

        $grupos = DB::table('tbl_grupos')->where('ind_gim', $id)->get();

        
        return response()->json($grupos);
    }

    public function crearGrupo(Request $request)
    {
        // Captura el ID enviado en la solicitud AJAX
        $id = $request->input('id');
        $nombre = $request->input('nombre');

        DB::table('tbl_grupos')->insert([
            'nombre_gru' => $nombre,
            'ind_gim' => $id
        ]);
        
    }

    public function unirseGrupo(Request $request)
    {
        $id = $request->input('id');

        $grupo = DB::table('tbl_usuario as u')
        ->join('tbl_grupos_user as gu', 'u.id_user', '=', 'gu.id_user')
        ->join('tbl_grupos as g', 'gu.id_grupo', '=', 'g.id_gru')
        ->select('u.*', 'g.*') 
        ->where('gu.id_grupo', '=', $id)
        ->get();

        // dd($grupo);
    
        
        return response()->json($grupo);

        
    }

    // public function agregaGrupo(Request $request)
    // {
    //     $id = $request->input('id');
    //     // Cuando recupera la variable de sesion se setea aqui
    //     // $idUser = $request->input('idUser');
    //     DB::table('tbl_grupos_user')->insert([
    //         'id_grupo' => $id,
    //         'id_user' => 1
    //     ]);

    //     // DB::table('tbl_grupos_user')->insert([
    //     //     'id_grupo' => $id,
    //     //     'id_user' => $idUser
    //     // ]);
        
    // }
    public function agregaGrupo(Request $request)
{
    $id_grupo = $request->input('id');

    // Verificar si el usuario ya está dentro del grupo
    $usuario_en_grupo = DB::table('tbl_grupos_user')
                        ->where('id_grupo', $id_grupo)
                        ->where('id_user', 1) // Aquí debes cambiar 1 por la ID del usuario actual
                        ->exists();

    if ($usuario_en_grupo) {
        // El usuario ya está en el grupo, no es necesario agregarlo nuevamente
        return response()->json(['message' => 'El usuario ya está en el grupo'], 400);
    } else {
        // El usuario no está en el grupo, se puede agregar
        DB::table('tbl_grupos_user')->insert([
            'id_grupo' => $id_grupo,
            'id_user' => 1 // Aquí debes cambiar 1 por la ID del usuario actual
        ]);

        return response()->json(['message' => 'Usuario agregado al grupo'], 200);
    }
}


    
}