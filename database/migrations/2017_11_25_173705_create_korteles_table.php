<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKortelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korteles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('savininko_id');
            $table->string('saskaitos_nr');
            $table->string('banko_pavadinimas');
            $table->string('korteles_nr');
            $table->string('galiojimo_data');
            $table->string('korteles_tipas');
            $table->integer('cvv')->lentgh(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('korteles');
    }
}
