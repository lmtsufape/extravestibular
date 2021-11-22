<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDadosToInscricaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscricaos', function (Blueprint $table) {
            $table->boolean('declaracaoDeVeracidade')->nullable();
            $table->string('declaracaoENADE')->nullable();
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('quitacaoEleitoral')->nullable();
            $table->string('reservista')->nullable();
            $table->string('certidaoNascimento')->nullable();
            $table->string('historicoEnsinoMedio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscricaos', function (Blueprint $table) {
            $table->dropColumn([
                'declaracaoDeVeracidade',
                'declaracaoENADE',
                'rg',
                'cpf',
                'quitacaoEleitoral',
                'reservista',
                'certidaoNascimento',
                'historicoEnsinoMedio']);
        });
    }
}
