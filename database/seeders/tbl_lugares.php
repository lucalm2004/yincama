<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_lugares extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_lugares")->insert([
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '1',
                'barrio_lug' => 'Nou Barris',
                'coordenadas_lug' => '41.38879, 2.15899',
                'desc_lug' => 'El  mejor museo de Barcelona con unos cuadros bonitos.' ,
               
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '2',
                'barrio_lug' => 'El Born',
                'coordenadas_lug' => '41.38879, 2.15888',
                'desc_lug' => 'Aqui nos encontramos en una playa con un agua muy cristalina' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '3',
                'barrio_lug' => 'El Raval',
                'coordenadas_lug' => '41.38879, 2.15777',
                'desc_lug' => 'En este Bar se encuentran las bravas más buenas.' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '4',
                'barrio_lug' => 'Gràcia',
                'coordenadas_lug' => '41.38879, 2.15666',
                'desc_lug' => 'Los pisos de aqui son muy altos.' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '5',
                'barrio_lug' => 'Port Vell',
                'coordenadas_lug' => '41.38879, 2.15555',
                'desc_lug' => 'Este parque esta muy variado tirolinas, colchonetas....' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '4',
                'barrio_lug' => 'Barceloneta',
                'coordenadas_lug' => '41.38879, 2.14444',
                'desc_lug' => 'Este paseo es uno de los más largos donde se encuentra mucha gente.' ,
            ],
       
        ]);
    }
}