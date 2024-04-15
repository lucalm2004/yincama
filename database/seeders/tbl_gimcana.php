<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_gimcana extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_gimcana")->insert([
            [
                'nombre_gim' => 'La ruta del dinero',
               
            ],
            [
                'nombre_gim' => 'En busca del tesoro',
            ],
            [
                'nombre_gim' => 'Buscando a Mane',
            ],
            [
                'nombre_gim' => 'Sobre el agua',
            ],
        ]);
    }
}