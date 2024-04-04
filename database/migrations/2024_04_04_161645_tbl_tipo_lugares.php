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
        Schema::create('tbl_tipo-lugares', function (Blueprint $table) {
            $table->id('id_tipo-lug');
            $table->unsignedBigInteger('id_tipo_fk');
            $table->unsignedBigInteger('id_lug_fk');
            $table->primary('id_tipo-lug');
            $table->foreign('id_tipo_fk')->references('id_tipo')->on('tbl_tipo')->onDelete('cascade');
            $table->foreign('id_lug_fk')->references('id_lug')->on('tbl_lugares')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tipo-lugares');
    }
};
