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
        Schema::create('tbl_gimcana-lugares', function (Blueprint $table) {
            $table->id('id_gim-lug');
            $table->unsignedBigInteger('id_gim_fk');
            $table->unsignedBigInteger('id_lug_fk');
            $table->string('pista_gim-lug')->nullable();
            $table->primary('id_gim-lug');
            $table->foreign('id_gim_fk')->references('id_gim')->on('tbl_gimcana')->onDelete('cascade');
            $table->foreign('id_lug_fk')->references('id_lug')->on('tbl_lugares')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_gimcana-lugares');
    }
};
