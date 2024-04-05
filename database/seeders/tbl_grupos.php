<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tbl_grupos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table("tbl_grupos")->insert([
            [
                'nombre_gru' => 'Millogangsters',
                // 'id_gim_lug_fk' => 1,
            ],
            [
                'nombre_gru' => 'Los Bebesitos',
                // 'id_gim_lug_fk' => 1,
            ],
            [
                'nombre_gru' => 'Magics',
                // 'id_gim_lug_fk' => 2,
            ],
            [
                'nombre_gru' => 'Los Manes',
                // 'id_gim_lug_fk' => 2,
            ],
       
        ]);
    }
}
