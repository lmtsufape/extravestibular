<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChavesEstrangeiras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('inscricaos', function (Blueprint $table) {
          $table->foreign('usuarioId')->references('id')->on('users');
          $table->foreign('editalId')->references('id')->on('editals');
      });

      Schema::table('recursos', function (Blueprint $table) {
        $table->foreign('usuarioId')->references('id')->on('users');
        $table->foreign('editalId')->references('id')->on('editals');
      });

      Schema::table('isencaos', function (Blueprint $table) {
        $table->foreign('usuarioId')->references('id')->on('users');
        $table->foreign('editalId')->references('id')->on('editals');

      });
      Schema::table('users', function (Blueprint $table) {
          $table->foreign('dados')->references('id')->on('dados_usuarios')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
