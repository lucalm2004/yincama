<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_gimcana_lugares extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_gimcana-lugares")->insert([
            [
                'id_gim_fk' => '1',
                'id_lug_fk' => '1',
                'pista_gim-lug' => 'Dirígete a la sala de arte moderno y busca una pintura con un reloj derretido en ella. Allí encontrarás la primera pista que te llevará al siguiente punto de encuentro.'
               
            ],
            [
                'id_gim_fk' => '1',
                'id_lug_fk' => '1',
                'pista_gim-lug' => 'Sigue el sendero marcado por las flechas amarillas. Cuando llegues al árbol más alto del bosque, busca entre sus raíces el siguiente mensaje oculto que te guiará hacia la siguiente parada.'
               
            ],
            [
                'id_gim_fk' => '1',
                'id_lug_fk' => '1',
                'pista_gim-lug' => 'Ve al monumento principal de la ciudad y busca una placa conmemorativa con las coordenadas X, Y. Allí encontrarás una pista que te llevará al siguiente lugar.',
            ],
            [
                'id_gim_fk' => '1',
                'id_lug_fk' => '1',
                'pista_gim-lug' => 'Sumérgete en la zona marcada por boyas rojas y busca un cofre enterrado a 5 metros de profundidad. Dentro encontrarás una pista que te conducirá al siguiente desafío.',
            ],
        ]);
    }
}
