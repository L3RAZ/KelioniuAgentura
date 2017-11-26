<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSutartysEkskursijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sutartys_ekskursijos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sutarties_nr')->unsigned();
            $table->integer('ekskursijos_nr')->unsigned();
        });

        Schema::table('sutartys_ekskursijos', function($table) {
            $table->foreign('sutarties_nr')->references('nr')->on('sutartys');
            $table->foreign('ekskursijos_nr')->references('nr')->on('ekskursijos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sutartys_ekskursijos');
    }
}
