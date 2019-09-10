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
        for($i = 1; $i < 21; $i++){
          DB::table('editals')->insert([
              'pdfEdital' => 'seed',
              'vagas' => '1:10!2:10!3:10!',
              'inicioInscricoes' => '2019-09-01',
              'fimInscricoes' => '2019-09-01',
              'inicioRecurso' => '2019-09-02',
              'fimRecurso' => '2019-09-03',
              'inicioIsencao' => '2019-09-04',
              'fimIsencao' => '2019-09-05',
              'inicioRecursoIsencao' => '2019-09-06',
              'fimRecursoIsencao' => '2019-09-07',
              'nome' => 'editalTeste'.$i,
              'created_at' => '2019-09-10 18:15:48',

          ]);
        }

        for($i = 1; $i < 21; $i++){
          if( $i < 15){
            DB::table('inscricaos')->insert([
                'usuarioId' => $i,
                'editalId' => '1',
                'tipo' => 'reintegracao',
                'cpfCandidato' => '12345678901',
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
                'cpfCandidato' => '1234567890'.$i,
                'nomeCandidato' => 'tester'.$i,
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
