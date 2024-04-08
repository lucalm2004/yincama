<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_lugares', function (Blueprint $table) {
            $table->id('id_lug');
            $table->string('nombre_lug')->nullable();
            $table->integer('tipo_lug')->nullable();
            $table->string('barrio_lug')->nullable();
            $table->string('coordenadas_lug')->nullable();
            $table->string('desc_lug')->nullable();
            $table->primary('id_lug');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lugares');
    }
};
