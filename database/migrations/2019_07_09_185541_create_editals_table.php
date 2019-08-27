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
            $table->string('pdfEdital');
            $table->string('vagas');
            $table->date('inicioInscricoes');
            $table->date('fimInscricoes');
            $table->date('inicioRecurso');
            $table->date('fimRecurso');
            $table->date('inicioIsencao');
            $table->date('fimIsencao');
            $table->date('inicioRecursoIsencao');
            $table->date('fimRecursoIsencao');
            $table->string('nome');
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
