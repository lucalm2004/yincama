<?php

namespace App\Http\Controllers;

use App\Models\tbl_lugar;
use App\Models\tbl_tipo;
use App\Models\tbl_tipo_lugar;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function selectCategoria(Request $request)
    {
        if (!$request->input('idCat')) {
            $id = $request->input('idCat');

            $categorias = tbl_tipo::find($id);
        } else {
            $categorias = tbl_tipo::all();
        }


        return response()->json($categorias);
    }

    public function crearCategoria(Request $request)
    {
        $nombreCat = $request->input('nombreCat');

        if (!$request->input('idCat')) {

            $categorias = new tbl_tipo();
            $categorias->tipo = $nombreCat;

            $categorias->save();

            echo "ok";
        } else {
            $id = $request->input('idCat');

            $categorias = tbl_tipo::find($id);
            $categorias->tipo = $nombreCat;

            $categorias->save();

            echo "modificado";
        }
    }

    public function selectMarcador(Request $request)
    {
        $marcadores = tbl_Lugar::leftjoin('tbl_tipo-lugares', 'tbl_lugares.tipo_lug', '=', 'tbl_tipo-lugares.id_lug_fk')
            ->leftjoin('tbl_tipo', 'tbl_tipo-lugares.id_tipo_fk', '=', 'tbl_tipo.id_tipo')
            ->get();

        return response()->json($marcadores);
    }
}
