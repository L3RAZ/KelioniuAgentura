<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViesbuciaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viesbuciai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('miesto_kodas')->unsigned();
            $table->string('pavadinimas');
            $table->string('reitingas');
            $table->double('paros_kaina');
            $table->string('adresas');
            $table->string('telefono_nr');
            $table->timestamps();
        });

        Schema::table('viesbuciai', function($table) {
            $table->foreign('miesto_kodas')->references('kodas')->on('miestas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viesbuciai');
    }
}
