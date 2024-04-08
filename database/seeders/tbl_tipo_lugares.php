<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_tipo_lugares extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_tipo-lugares")->insert([
            [
                'id_tipo_fk' => '1',
                'id_lug_fk' => '1',
               
               
            ],
            [
                'id_tipo_fk' => '2',
                'id_lug_fk' => '1',
               
            ],
            [
                'id_tipo_fk' => '3',
                'id_lug_fk' => '1',
               
            ],
            [
                'id_tipo_fk' => '4',
                'id_lug_fk' => '1',
               
            ],
        ]);
    }
}