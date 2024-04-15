<?php

namespace App\Http\Controllers;

use App\Models\tbl_grupo;
use App\Models\tbl_gimcana_lugare;
use App\Models\TblGruposUser;
use App\Models\UserGim;
use App\Models\tbl_lugar;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Session;

class iniciarYim extends Controller
{
    public function iniciarYim(Request $request)
    {
        // Validación de datos
        $request->validate([
            'gru' => 'required|integer|exists:tbl_grupos,id_gru',
            'gim' => 'nullable|integer|exists:tbl_grupos,ind_gim', // Corregir el nombre de la columna
        ]);

        // Obtener el ID de usuario de la sesión
        $id_user = Session::get('id_user');

        // Validar si el ID de usuario existe en la sesión
        if (!$id_user) {
            return response()->json(['mensaje' => 'No se ha iniciado sesión'], 404);
        }

        // Eliminar registros de users_gims asociados al usuario actual
        $deletedCount = UserGim::where('user_id', $id_user)->delete();

        // Crear un nuevo registro en users_gims
        $userGim = new UserGim();
        $userGim->user_id = $id_user; // Asignar el ID de usuario
        $userGim->gim_id = $request->gim;
        $userGim->save();

        // Buscar el grupo por su ID
        $grupo = tbl_grupo::findOrFail($request->gru);

        // Actualizar el campo 'ind_gim' del grupo
        $grupo->ind_gim = $request->gim; // Corregir el nombre del campo si es necesario
        $grupo->save();

        // Guardar el ID de la gimcana en la sesión
        $id_gim_fk = $grupo->ind_gim;
        Session::put('idGim', $id_gim_fk);

        // Buscar la primera pista de la gimcana
        $gimcanaLugar = tbl_gimcana_lugare::where('id_gim_fk', $id_gim_fk)
            ->orderBy('id_gim-lug', 'asc')
            ->take(1)
            ->first();

        if ($gimcanaLugar) {
            $html = 'Primera pista: ' . $gimcanaLugar->{'pista_gim-lug'};

            $id_lug_fk = $gimcanaLugar->id_lug_fk;

            // Obtener los resultados del lugar
            $lugar = tbl_lugar::where('id_lug', $id_lug_fk)->first();

            // Guardar datos en sesión
            Session::put('pista', '1');
            Session::put('latitud', $lugar->latitud_lug);
            Session::put('longitud', $lugar->longitud_lug);

            // Envolver el HTML en un objeto HtmlString
            $htmlOutput = new HtmlString($html);

            // Retornar el HTML
            return $htmlOutput;
        } else {
            // Si no se encuentra ningún lugar, puedes retornar un mensaje de error
            return response()->json(['mensaje' => 'No se encontró ningún lugar para esta gimcana'], 404);
        }
    }

    public function ubicacion()
    {
        if (session('pista') == 6) {
            echo 0;
            echo ",";
            echo 0;
        } else {
            echo Session::get('latitud');
            echo ",";
            echo Session::get('longitud');
        }
    }

    public function nuevaP()
    {
        $id_gim_fk = session('idGim');
        if (session('pista') == 1) {
            Session::put('pista', '2');
        } elseif (session('pista') == 2) {
            Session::put('pista', '3');
        } elseif (session('pista') == 3) {
            Session::put('pista', '4');
        } elseif (session('pista') == 4) {
            Session::put('pista', '5');

            $uniqueUserIds = UserGim::where('gim_id', $id_gim_fk)->distinct()->pluck('user_id');
            $countAllUsers = UserGim::where('gim_id', $id_gim_fk)->count();

            if ($uniqueUserIds->count() * 4 != $countAllUsers) {
                $html = 'No todos los miembros del grupo han acabado. Espere a los demas.';
                $htmlOutput = new HtmlString($html);
                Session::put('pista', '4');
                return $htmlOutput;
            }
        } elseif (session('pista') == 5) {
            Session::put('pista', '6');
            $html = 'Felicidades. ¡Habeis ganado!';
            $htmlOutput = new HtmlString($html);
            return $htmlOutput;
        } else {
            return;
        }
        $pista_actual = session('pista');

        $gimcanaLugar = tbl_gimcana_lugare::where('id_gim_fk', $id_gim_fk)
            ->orderBy('id_gim-lug', 'asc')
            ->skip($pista_actual - 1)
            ->take(1)
            ->first();

        if ($gimcanaLugar) {
            $html = 'Nueva pista: ' . $gimcanaLugar->{'pista_gim-lug'};
            // $html = "hola";

            $id_lug_fk = $gimcanaLugar->id_lug_fk;

            $userGim = new UserGim();
            $userGim->user_id = session('id_user');
            $userGim->gim_id = $id_gim_fk;
            $userGim->save();

            // Obtener los resultados del lugar
            $lugar = tbl_lugar::where('id_lug', $id_lug_fk)->first();

            // Guardar datos en sesión
            Session::put('latitud', $lugar->latitud_lug);
            Session::put('longitud', $lugar->longitud_lug);

            // Envolver el HTML en un objeto HtmlString
            $htmlOutput = new HtmlString($html);

            // Retornar el HTML
            return $htmlOutput;
        }
    }
}
