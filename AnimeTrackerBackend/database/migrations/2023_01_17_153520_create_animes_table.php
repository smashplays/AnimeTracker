<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 32);
            $table->string('descripcion', 32);
            $table->string('genero', 16);
            $table->Integer('capitulos');
            $table->string('estado', 16);
            $table->string('fecha_inicio', 32);
            $table->string('fecha_fin', 32)->nullable();
            $table->string('URL_imagen', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
    }
}
