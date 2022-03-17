<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposToInscricaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscricaos', function (Blueprint $table) {
            $table->string('declaracao_veracidade')->nullable();
            $table->string('escola_em')->nullable();
            $table->string('natureza_em')->nullable();
            $table->string('endereco_em')->nullable();
            $table->string('num_em')->nullable();
            $table->string('bairro_em')->nullable();
            $table->string('cidade_em')->nullable();
            $table->string('uf_em')->nullable();
            $table->string('curso_segunda_opcao')->nullable();
            $table->string('turno_segunda_opcao')->nullable();
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
                'declaracao_veracidade',
                'escola_em',
                'natureza_em',
                'endereco_em',
                'num_em',
                'bairro_em',
                'cidade_em',
                'uf_em',
                'curso_segunda_opcao',
                'turno_segunda_opcao',
            ]);
        });
    }
}
