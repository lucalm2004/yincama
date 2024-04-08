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
}
