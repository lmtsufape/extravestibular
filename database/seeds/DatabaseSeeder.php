<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        for($i = 1; $i < 21; $i++){
          DB::table('users')->insert([
              'email' => 'teste'.Str::random(5).'@gmail.com',
              'password' => bcrypt('password'),
              'tipo' => 'candidato',
          ]);
        }
        DB::table('users')->insert([
            'email' => 'preg@teste.com',
            'password' => bcrypt('12345678'),
            'tipo' => 'PREG',

        ]);
        DB::table('users')->insert([
            'email' => 'drca@teste.com',
            'password' => bcrypt('12345678'),
            'tipo' => 'DRCA',

        ]);
        DB::table('users')->insert([
            'email' => 'coord@teste.com',
            'password' => bcrypt('12345678'),
            'tipo' => 'coordenador',

        ]);
        DB::table('editals')->insert([
            'pdfEdital' => 'seed',
            'vagas' => '1:10!2:10!3:10!',
            'inicioInscricoes' => '2019-09-10',
            'fimInscricoes' => '2019-10-01',
            'inicioRecurso' => '2019-09-02',
            'fimRecurso' => '2019-10-03',
            'inicioIsencao' => '2019-09-04',
            'fimIsencao' => '2019-09-05',
            'inicioRecursoIsencao' => '2019-09-06',
            'fimRecursoIsencao' => '2019-09-07',
            'nome' => 'Inscrição aberta',
            'created_at' => '2019-09-10 18:15:48',

        ]);
        DB::table('editals')->insert([
            'pdfEdital' => 'seed',
            'vagas' => '1:10!2:10!3:10!',
            'inicioInscricoes' => '2019-09-01',
            'fimInscricoes' => '2019-09-02',
            'inicioRecurso' => '2019-09-03',
            'fimRecurso' => '2019-10-04',
            'inicioIsencao' => '2019-09-10',
            'fimIsencao' => '2019-10-06',
            'inicioRecursoIsencao' => '2019-09-07',
            'fimRecursoIsencao' => '2019-09-08',
            'nome' => 'Isençao aberta',
            'created_at' => '2019-09-10 18:15:48',

        ]);
        DB::table('editals')->insert([
            'pdfEdital' => 'seed',
            'vagas' => '1:10!2:10!3:10!',
            'inicioInscricoes' => '2019-09-01',
            'fimInscricoes' => '2019-09-02',
            'inicioRecurso' => '2019-09-03',
            'fimRecurso' => '2019-10-04',
            'inicioIsencao' => '2019-09-05',
            'fimIsencao' => '2019-09-06',
            'inicioRecursoIsencao' => '2019-09-07',
            'fimRecursoIsencao' => '2019-10-08',
            'nome' => 'Recurso Isençao aberta',
            'created_at' => '2019-09-10 18:15:48',

        ]);
        DB::table('editals')->insert([
            'pdfEdital' => 'seed',
            'vagas' => '1:10!2:10!3:10!',
            'inicioInscricoes' => '2019-09-01',
            'fimInscricoes' => '2019-09-02',
            'inicioRecurso' => '2019-09-03',
            'fimRecurso' => '2019-10-04',
            'inicioIsencao' => '2019-09-05',
            'fimIsencao' => '2019-09-06',
            'inicioRecursoIsencao' => '2019-09-07',
            'fimRecursoIsencao' => '2019-09-08',
            'nome' => 'Recurso Inscrição aberta',
            'created_at' => '2019-09-10 18:15:48',

        ]);
        for($i = 1; $i < 7; $i++){
          DB::table('editals')->insert([
              'pdfEdital' => 'seed',
              'vagas' => '1:10!2:10!3:10!',
              'inicioInscricoes' => '2019-09-01',
              'fimInscricoes' => '2019-09-02',
              'inicioRecurso' => '2019-09-03',
              'fimRecurso' => '2019-09-04',
              'inicioIsencao' => '2019-09-05',
              'fimIsencao' => '2019-09-06',
              'inicioRecursoIsencao' => '2019-09-07',
              'fimRecursoIsencao' => '2019-09-08',
              'nome' => 'editalTeste'.$i,
              'created_at' => '2019-09-01 18:15:48',

          ]);
        }

        for($i = 1; $i < 21; $i++){
          if( $i < 15){
            DB::table('inscricaos')->insert([
                'usuarioId' => $i,
                'editalId' => '1',
                'tipo' => 'reintegracao',
                'comprovante' => 'isento',
                'curso' => '1',
                'turno' => 'manhã',
                'cursoDeOrigem' => 'seed',
                'instituicaoDeOrigem' => 'seed',
                'naturezaDaIes' => 'seed',
                'endereco' => 'seed',
                'num' => 'seed',
                'bairro' => 'seed',
                'cidade' => 'seed',
                'uf' => 'seed',
                'nota' => $i,


            ]);
          }
          if($i >= 15){
            DB::table('inscricaos')->insert([
                'usuarioId' => $i,
                'editalId' => '1',
                'tipo' => 'reintegracao',
                'comprovante' => 'isento',
                'curso' => '2',
                'turno' => 'manhã',
                'cursoDeOrigem' => 'seed',
                'instituicaoDeOrigem' => 'seed',
                'naturezaDaIes' => 'seed',
                'endereco' => 'seed',
                'num' => 'seed',
                'bairro' => 'seed',
                'cidade' => 'seed',
                'uf' => 'seed',
                'nota' => $i,


            ]);
          }

        }
    }
}
