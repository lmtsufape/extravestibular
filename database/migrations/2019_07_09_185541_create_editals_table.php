<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('pdfEdital');
            $table->text('vagas');
            $table->date('inicioInscricoes');
            $table->date('fimInscricoes');
            $table->date('inicioRecurso');
            $table->date('fimRecurso');
            $table->date('inicioIsencao');
            $table->date('fimIsencao');
            $table->date('inicioRecursoIsencao');
            $table->date('fimRecursoIsencao');
            $table->date('resultado');
            $table->date('inicioRecursoResultado');
            $table->date('fimRecursoResultado');
            $table->date('resultadoFinal');
            $table->string('nome');
            $table->string('publicado')->nullable();
            $table->date('dataPublicacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editals');
    }
}
