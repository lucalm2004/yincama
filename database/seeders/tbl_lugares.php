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
                'latitud_lug' => '41.39563908249548',
                'longitud_lug' => '2.157296801147742',
                'desc_lug' => 'El  mejor museo de Barcelona con unos cuadros bonitos.' ,
               
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '2',
                'barrio_lug' => 'El Born',
                'latitud_lug' => '41.406416238763036',
                'longitud_lug' => '2.1743924748125343',
                'desc_lug' => 'Aqui nos encontramos en una playa con un agua muy cristalina' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '3',
                'barrio_lug' => 'El Raval',
                'latitud_lug' => '41.395471212759546',
                'longitud_lug' => '2.1446376001765852',
                'desc_lug' => 'En este Bar se encuentran las bravas más buenas.' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '4',
                'barrio_lug' => 'Gràcia',
                'latitud_lug' => '41.40277027405965',
                'longitud_lug' => '2.1319204997441905',
                'desc_lug' => 'Los pisos de aqui son muy altos.' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '5',
                'barrio_lug' => 'Port Vell',
                'latitud_lug' => '41.39655528359603',
                'longitud_lug' => '2.1619791007662146',
                'desc_lug' => 'Este parque esta muy variado tirolinas, colchonetas....' ,
            ],
            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '4',
                'barrio_lug' => 'Barceloneta',
                'latitud_lug' => '41.382677811538706',
                'longitud_lug' => '2.1302826915074853',
                'desc_lug' => 'Este paseo es uno de los más largos donde se encuentra mucha gente.' ,
            ],

            [
                'nombre_lug' => 'Barcelona',
                'tipo_lug' => '5',
                'barrio_lug' => 'El Casino',
                'latitud_lug' => '41.387582561323704',  
                'longitud_lug' => '2.196989533986049',
                'desc_lug' => 'Para jugar.' ,
            ],
       
        ]);
    }
}
