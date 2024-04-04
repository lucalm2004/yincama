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
        Schema::create('tbl_etiquetas', function (Blueprint $table) {
            $table->id('id_fav');
            $table->unsignedBigInteger('id_user_fk');
            $table->unsignedBigInteger('id_lug_fk');
            $table->primary('id_fav');
            $table->foreign('id_user_fk')->references('id_user')->on('tbl_user')->onDelete('cascade');
            $table->foreign('id_lug_fk')->references('id_lug')->on('tbl_lugares')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_etiquetas');
    }
};
