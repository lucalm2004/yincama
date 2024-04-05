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
            $table->unsignedBigInteger('ind_gim')->nullable();
            $table->primary('id_gru');
            $table->foreign('ind_gim')->references('id_gim')->on('tbl_gimcana')->onDelete('cascade');
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
