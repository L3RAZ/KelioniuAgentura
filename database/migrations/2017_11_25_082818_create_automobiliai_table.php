<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutomobiliaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobiliai', function (Blueprint $table) {
            $table->increments('nr');
            $table->integer('auto_nuomos_id')->unsigned()->nullable($value = true);
            $table->string('marke');
            $table->string('modelis');
            $table->double('variklio_turis');
            $table->integer('variklio_galia');
            $table->integer('pagaminimo_metai');
            $table->double('paros_kaina');
            $table->integer('duru_sk');
            $table->string('registracijos_nr');
            $table->string('pavaru_deze');
            $table->string('kebulo_tipas');
        });

        Schema::table('automobiliai', function($table) {
            $table->foreign('auto_nuomos_id')->references('id')->on('auto_nuomos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automobiliai');
    }
}
