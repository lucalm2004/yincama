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
        $categorias = tbl_tipo::all();

        return response()->json($categorias);
    }

    public function crearCategoria(Request $request)
    {
        $nombreCat = $request->input('nombreCat');

        if (!$request->input('idCat')) {

            $categoriaSearch = tbl_tipo::where('tipo', $nombreCat)->get();

            if ($categoriaSearch->isEmpty()) {
                $categorias = new tbl_tipo();
                $categorias->tipo = $nombreCat;

                $categorias->save();

                echo "ok";
            } else {
                echo "error";
            }
        } else {
            $idCat = $request->input('idCat');

            $categoriaSearch = tbl_tipo::where('tipo', $nombreCat)->where('id_tipo', '!=', $idCat)->get();

            if ($categoriaSearch->isEmpty()) {
                $categorias = tbl_tipo::where('id_tipo', $idCat)->first();
                $categorias->tipo = $nombreCat;

                $categorias->save();

                echo "modificado";
            } else {
                echo 'error';
            }
        }
    }

    public function elimCategoria(Request $request)
    {
        $idCat = $request->input('idCat');

        tbl_tipo::where('id_tipo', '=', $idCat)->delete();
    }

    public function selectMarcador(Request $request)
    {
        $marcadores = tbl_Lugar::leftJoin('tbl_tipo-lugares', 'tbl_lugares.id_lug', '=', 'tbl_tipo-lugares.id_lug_fk')
            ->leftJoin('tbl_tipo', 'tbl_tipo-lugares.id_tipo_fk', '=', 'tbl_tipo.id_tipo')
            ->groupBy('tbl_lugares.id_lug', 'tbl_lugares.nombre_lug', 'tbl_lugares.tipo_lug', 'tbl_lugares.barrio_lug', 'tbl_lugares.latitud_lug', 'tbl_lugares.longitud_lug', 'tbl_lugares.desc_lug')
            ->select('tbl_lugares.*', tbl_tipo::raw('GROUP_CONCAT(tbl_tipo.tipo) AS tipos'))
            ->get();

        return response()->json($marcadores);
    }

    public function crearMarcador(Request $request)
    {
        $nombreMar = $request->input('nombreMar');

        if (!$request->input('idMar')) {

            $marcadorSearch = tbl_tipo::where('tipo', $nombreMar)->get();

            if ($marcadorSearch->isEmpty()) {
                $marcadores = new tbl_tipo();
                $marcadores->tipo = $nombreMar;

                $marcadores->save();

                echo "ok";
            } else {
                echo "error";
            }
        } else {
            $idMar = $request->input('idMar');

            $marcadorSearch = tbl_tipo::where('tipo', $nombreMar)->where('id_tipo', '!=', $idMar)->get();

            if ($marcadorSearch->isEmpty()) {
                $marcadores = tbl_tipo::where('id_tipo', $idMar)->first();
                $marcadores->tipo = $nombreMar;

                $marcadores->save();

                echo "modificado";
            } else {
                echo 'error';
            }
        }
    }
}
