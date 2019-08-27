<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIsencaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isencaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('usuarioId');
            $table->integer('editalId');
            $table->string('tipo');
            $table->string('nomeDadoEconomico');
            $table->string('cpfDadoEconomico');
            $table->string('parentescoDadoEconomico');
            $table->string('rendaDadoEconomico');
            $table->string('fontePagadoraDadoEconomico');
            $table->string('nomeNucleoFamiliar')->nullable();
            $table->string('cpfNucleoFamiliar')->nullable();
            $table->string('parentescoNucleoFamiliar')->nullable();
            $table->string('rendaNucleoFamiliar')->nullable();
            $table->string('fontePagadoraNucleoFamiliar')->nullable();
            $table->string('nomeNucleoFamiliar1')->nullable();
            $table->string('cpfNucleoFamiliar1')->nullable();
            $table->string('parentescoNucleoFamiliar1')->nullable();
            $table->string('rendaNucleoFamiliar1')->nullable();
            $table->string('fontePagadoraNucleoFamiliar1')->nullable();
            $table->string('rendaFamiliarHomologacao')->nullable();
            $table->string('ensinoMedioHomologacao')->nullable();
            $table->string('parecer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('isencaos');
    }
}
