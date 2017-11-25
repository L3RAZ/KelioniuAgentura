<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSutartysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sutartys', function (Blueprint $table) {
            $table->increments('nr');
            $table->integer('vartotojo_id')->unsigned();
            $table->integer('keliones_nr')->unsigned();
            $table->integer('viesbucio_id')->unsigned();
            $table->integer('draudimo_nr')->unsigned()->nullable($value = true);
            $table->date('sudarymo_data');
            $table->integer('pasirinkta_data')->unsigned();
            $table->double('bendra_kaina');
            $table->date('nutraukimo_data')->nullable($value = true);
            $table->boolean('yra_archyvuota');
            $table->integer('busena')->unsigned();
            $table->integer('zmoniu_sk');
        });

        Schema::table('sutartys', function($table) {
            $table->foreign('vartotojo_id')->references('id')->on('users');
            $table->foreign('keliones_nr')->references('id')->on('keliones');
            $table->foreign('viesbucio_id')->references('id')->on('viesbuciai');
            $table->foreign('draudimo_nr')->references('nr')->on('draudimai');
            $table->foreign('pasirinkta_data')->references('id')->on('kelioniu_datos');
            $table->foreign('busena')->references('id')->on('sutarties_busena');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sutartys');
    }
}
