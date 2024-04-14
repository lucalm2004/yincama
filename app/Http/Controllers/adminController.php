<?php

namespace App\Http\Controllers;

use App\Models\tbl_gimcana;
use App\Models\tbl_gimcana_lugare;
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
            ->get();

        return response()->json($marcadores);
    }

    public function crearMarcador(Request $request)
    {
        $nombreMar = $request->input('nombreMar');
        $descripcionMar = $request->input('descripcionMar');
        $catMar = $request->input('catMar');
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');

        if (!$request->input('idMar')) {
            $marcadores = new tbl_lugar();
            $marcadores->nombre_lug = $nombreMar;
            $marcadores->desc_lug = $descripcionMar;
            $marcadores->latitud_lug = $latitud;
            $marcadores->longitud_lug = $longitud;


            $marcadores->save();

            $lastInsertedId = $marcadores->id_lug;

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
            $marcadores->latitud_lug = $latitud;
            $marcadores->longitud_lug = $longitud;

            $marcadores->save();

            $marcador_lugar = tbl_tipo_lugar::where('id_lug_fk', $idMar)->first();

            if ($marcador_lugar) {
                $marcador_lugar->id_tipo_fk = $catMar;
                $marcador_lugar->id_lug_fk = $idMar;

                $marcador_lugar->save();
            } else {
                $new_marcador_lugar = new tbl_tipo_lugar();
                $new_marcador_lugar->id_tipo_fk = $catMar;
                $new_marcador_lugar->id_lug_fk = $idMar;

                $new_marcador_lugar->save();
            }

            echo "modificado";
        }

        echo 'awa';
    }

    public function elimMarcador(Request $request)
    {
        $idMar = $request->input('idMar');

        tbl_Lugar::where('id_lug', '=', $idMar)->delete();
        tbl_tipo_lugar::where('id_lug_fk', '=', $idMar)->delete();
    }

    public function selectYincana(Request $request)
    {
        $yincana = tbl_gimcana::select('tbl_gimcana.id_gim', 'tbl_gimcana.nombre_gim', tbl_lugar::raw('GROUP_CONCAT(CONCAT(tbl_lugares.id_lug, ":", tbl_lugares.nombre_lug, ":", `tbl_gimcana-lugares`.`pista_gim-lug`) SEPARATOR ",") as lugares'))
            ->join('tbl_gimcana-lugares', 'tbl_gimcana.id_gim', '=', 'tbl_gimcana-lugares.id_gim_fk')
            ->join('tbl_lugares', 'tbl_gimcana-lugares.id_lug_fk', '=', 'tbl_lugares.id_lug')
            ->groupBy('tbl_gimcana.id_gim', 'tbl_gimcana.nombre_gim')
            ->orderBy('tbl_lugares.id_lug')
            ->get();

        return response()->json($yincana);
    }

    public function crearYincana(Request $request)
    {
        $nombreYin = $request->input('nombreYin');

        $marca = $request->input('marca');
        $pista = $request->input('pista');

        $marcadores = explode(",", $marca);
        $pistas = explode(",", $pista);

        if (!$request->input('idYin')) {
            $yincanaSearch = tbl_gimcana::where('nombre_gim', $nombreYin)->get();

            if ($yincanaSearch->isEmpty()) {
                $yincana = new tbl_gimcana();
                $yincana->nombre_gim = $nombreYin;

                $yincana->save();

                $lastInsertedId = $yincana->id_gim;

                foreach ($marcadores as $i => $marcador) {
                    $yincanaLugar = new tbl_gimcana_lugare();
                    $yincanaLugar->id_gim_fk = $lastInsertedId;
                    $yincanaLugar->id_lug_fk = $marcador;
                    $yincanaLugar->{'pista_gim-lug'} = $pistas[$i];

                    $yincanaLugar->save();
                }

                echo 'ok';
            } else {
                echo 'error';
            }
        } else {
            $idYin = $request->input('idYin');
            $nombreYin = $request->input('nombreYin');

            $yincana = tbl_gimcana::where('id_gim', $idYin)->first();

            $yincana->nombre_gim = $nombreYin;

            $yincana->save();

            tbl_gimcana_lugare::where('id_gim_fk', $idYin)->delete();

            foreach ($marcadores as $i => $marcador) {
                $yincanaLugar = new tbl_gimcana_lugare();
                $yincanaLugar->id_gim_fk = $idYin;
                $yincanaLugar->id_lug_fk = $marcador;
                $yincanaLugar->{'pista_gim-lug'} = $pistas[$i];

                $yincanaLugar->save();
            }
        }
        echo 'modificado';
    }

    public function elimYincana(Request $request)
    {
        $idYin = $request->input('idYin');

        tbl_gimcana::where('id_gim', '=', $idYin)->delete();
        tbl_gimcana_lugare::where('id_gim_fk', '=', $idYin)->delete();
    }
}
