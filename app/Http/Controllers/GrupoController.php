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

        $grupos = DB::table('tbl_grupos')->where('id_gru', $id)->get();

        
        return response()->json($grupos);
    }
}
