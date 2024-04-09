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
        Schema::create('tbl_usuario', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nombre_user')->nullable();
            $table->string('correo_user')->nullable();
            $table->string('pwd_user')->nullable();
            $table->unsignedBigInteger('id_rol_fk');
            $table->unsignedBigInteger('id_gru_fk')->nullable();
            $table->foreign('id_rol_fk')->references('id_rol')->on('tbl_roles')->onDelete('cascade');
            $table->foreign('id_gru_fk')->references('id_gru')->on('tbl_grupos')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_usuario');
    }
};