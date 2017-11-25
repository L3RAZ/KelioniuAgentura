<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoNuomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_nuomos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sutarties_nr')->unsigned();
            $table->date('pradzios_data');
            $table->date('pabaigos_data');
            $table->double('bendra_kaina');
        });

        Schema::table('auto_nuomos', function($table) {
            $table->foreign('sutarties_nr')->references('nr')->on('sutartys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_nuomos');
    }
}
