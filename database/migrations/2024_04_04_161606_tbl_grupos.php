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
        Schema::create('tbl_grupos', function (Blueprint $table) {
            $table->id('id_gru');
            $table->string('nombre_gru')->nullable();
            $table->integer('id_gim-lug_fk')->nullable();
            $table->primary('id_gru');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_grupos');
    }
};
