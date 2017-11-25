<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraudimaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draudimai', function (Blueprint $table) {
            $table->increments('nr');
            $table->double('kaina');
            $table->date('galioja_nuo');
            $table->date('galioja_iki');
            $table->string('draudimo_imone');
            $table->integer('tipas')->unsigned();
        });

        Schema::table('draudimai', function($table){
            $table->foreign('tipas')->references('id')->on('draudimo_tipas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draudimai');
    }
}
