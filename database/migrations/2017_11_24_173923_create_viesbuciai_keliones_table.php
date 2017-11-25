<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViesbuciaiKelionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viesbuciai_keliones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keliones_nr')->unsigned();
            $table->integer('viesbucio_id')->unsigned();
        });

        Schema::table('viesbuciai_keliones', function($table) {
            $table->foreign('keliones_nr')->references('id')->on('keliones');
            $table->foreign('viesbucio_id')->references('id')->on('viesbuciai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viesbuciai_keliones');
    }
}
