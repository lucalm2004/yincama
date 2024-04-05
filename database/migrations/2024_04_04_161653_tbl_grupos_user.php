<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


    public function up()
    {
        Schema::create('tbl_grupos_user', function (Blueprint $table) {
            $table->id('id_grupo_tabla');
            $table->unsignedBigInteger('id_grupo')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('tbl_usuario')->onDelete('cascade');
            $table->foreign('id_grupo')->references('id_gru')->on('tbl_grupos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_grupos_user');
    }
};

