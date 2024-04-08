<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_tipo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_tipo")->insert([
            [
                'tipo' => 'Museo',
               
            ],
            [
                'tipo' => 'Playa',
            ],
            [
                'tipo' => 'Bar',
            ],
            [
                'tipo' => 'Edificio',
            ],
            [
                'tipo' => 'Paseo',
            ],
            [
                'tipo' => 'Parque',
                
            ],
            [
                'tipo' => 'Restaurante',
               
            ],
            [
                'tipo' => 'Cafetería',
               
            ],
            [
                'tipo' => 'Centro comercial',
               
            ],
            [
                'tipo' => 'Teatro',
            ],
        ]);
    }
}
