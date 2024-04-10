<?php

namespace App\Http\Controllers;

use App\Models\tbl_lugar;
use App\Models\tbl_tipo;
use App\Models\tbl_tipo_lugar;
use App\Models\tbl_tipo_real;
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
            ->get();

        return response()->json($marcadores);
    }

    public function crearMarcador(Request $request)
    {
        $nombreMar = $request->input('nombreMar');
        $descripcionMar = $request->input('descripcionCat');
        $catMar = $request->input('catMar');

        if (!$request->input('idMar')) {

            $marcadores = new tbl_lugar();
            $marcadores->nombre_lug = $nombreMar;
            $marcadores->desc_lug = $descripcionMar;

            $marcadores->save();


            $lastInsertedId = $marcadores->id;

            $marcador_lugar = new tbl_tipo_lugar();
            $marcador_lugar->id_tipo_fk = $catMar;
            $marcador_lugar->id_lug_fk = $lastInsertedId;

            $marcador_lugar->save();

            echo 'ok';
        } else {
            $idMar = $request->input('idMar');

            $marcadores = tbl_lugar::where('id_lug', $idMar)->first();
            $marcadores->nombre_lug = $nombreMar;
            $marcadores->desc_lug = $descripcionMar;

            $marcadores->save();


            $marcador_lugar = tbl_tipo_lugar::where('id_lug_fk', $idMar)->first();
            $marcador_lugar->id_tipo_fk = $catMar;
            $marcador_lugar->id_lug_fk = $idMar;

            $marcador_lugar->save();

            echo "modificado";
        }
    }
}
