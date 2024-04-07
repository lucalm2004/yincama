<?php

namespace App\Http\Controllers;

use App\Models\tbl_lugar;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente.index');
    //     $incidencias = tbl_lugar::select(
    //         'tbl_lugares.id_lug',
    //         'tbl_lugares.nombr_lug',
    //         'tbl_lugares.   ',
    //         'tbl_lugares.fecha_inc',
    //         'tbl_lugares.foto_inc',
    //         'tbl_subcategorias.nombre_sub_cat AS nombre_subcat',
    //         'tbl_estados.nombre_estado AS nombre_estado',
    //         'tbl_users.nombre_user'
    //     )


}
}