<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_etiquetas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_etiquetas")->insert([
            [
                'id_user_fk' => '1',
                'id_lug_fk' => '1',
               
            ],
            [
                'id_user_fk' => '2',
                'id_lug_fk' => '1',
             
               
            ],
            [
                'id_user_fk' => '3',
                'id_lug_fk' => '1',
               
            ],
            [
                'id_user_fk' => '4',
                'id_lug_fk' => '1',
              
            ],
        ]);
    }
}