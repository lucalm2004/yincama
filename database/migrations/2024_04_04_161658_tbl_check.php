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
        Schema::create('tbl_check', function (Blueprint $table) {
            $table->id('id_check');
            $table->unsignedBigInteger('id_gim-lug_fk');
            $table->unsignedBigInteger('id_user_fk');
            $table->primary('id_check');
            $table->foreign('id_gim-lug_fk')->references('id_gim-lug')->on('tbl_gimcana-lugares')->onDelete('cascade');
            $table->foreign('id_user_fk')->references('id_user')->on('tbl_usuario')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_check');
    }
};
