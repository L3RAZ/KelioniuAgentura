<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelioniuDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelioniu_datos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keliones_nr')->unsigned();
            $table->date('isvykimo_data');
            $table->date('grizimo_data');
            $table->integer('laisvu_vietu_sk');
        });

        Schema::table('kelioniu_datos', function($table){
            $table->foreign('keliones_nr')->references('id')->on('keliones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelioniu_datos');
    }
}
