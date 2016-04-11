<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CancionMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_cancion', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_cancion');
            $table->string('txt_cancion');
            $table->string('tono');
            $table->string('tempo');
            $table->string('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cat_cancion');
    }
}
