<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miestas', function (Blueprint $table) {
            $table->increments('kodas');
            $table->string('pavadinimas');
            $table->integer('pasto_kodas')->nullable($value = true);
            $table->string('meras')->nullable($value = true);
            $table->string('savivaldybe')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('miestas');
    }
}
