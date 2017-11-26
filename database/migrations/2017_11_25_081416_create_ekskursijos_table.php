<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEkskursijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekskursijos', function (Blueprint $table) {
            $table->increments('nr');
            $table->integer('keliones_nr')->unsigned();
            $table->date('isvykimo_data');
            $table->date('grizimo_data');
            $table->string('vieta');
            $table->double('kaina');
            $table->string('gidas');
        });

        Schema::table('ekskursijos', function($table) {
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
        Schema::dropIfExists('ekskursijos');
    }
}
