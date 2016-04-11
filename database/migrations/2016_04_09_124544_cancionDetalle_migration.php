<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CancionDetalleMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_cancion_detalle', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id_cancion');
            $table->foreign('id_cancion')->references('id_cancion')->on('cat_cancion');
            $table->integer('id_verso');
            $table->string('txt_verso');
            $table->integer('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cat_cancion_detalle');
    }
}
