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
