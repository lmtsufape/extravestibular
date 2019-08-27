<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nome');
            $table->string('rg');
            $table->string('orgaoEmissor');
            $table->string('orgaoEmissorUF');
            $table->string('cpf')->unique();
            $table->string('tituloEleitoral');
            $table->string('filiacao');
            $table->string('endereco');
            $table->string('num');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('uf');
            $table->string('foneResidencial')->nullable();
            $table->string('foneCelular')->nullable();
            $table->string('foneComercial')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dados_usuarios');
    }
}
