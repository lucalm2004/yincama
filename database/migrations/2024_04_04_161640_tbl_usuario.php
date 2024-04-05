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
            $table->foreign('id_rol_fk')->references('id_rol')->on('tbl_roles')->onDelete('cascade');
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

