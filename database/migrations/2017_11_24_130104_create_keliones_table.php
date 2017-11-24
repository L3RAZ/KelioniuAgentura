<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keliones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('miesto_kodas')->unsigned();
            $table->string('valstybe');
            $table->double('kaina');
            $table->string('transporto_priemones');
            $table->text('aprasymas');
            $table->integer('tipas')->unsigned();
        });

        Schema::table('keliones', function($table) {
            $table->foreign('miesto_kodas')->references('kodas')->on('miestas');
        });

        Schema::table('keliones', function($table) {
            $table->foreign('tipas')->references('id')->on('keliones_tipas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keliones');
    }
}
