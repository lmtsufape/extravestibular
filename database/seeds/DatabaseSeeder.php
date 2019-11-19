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
          DB::table('dados_usuarios')->insert([
            'nome' => 'Candidato' . $i,
            'rg' => 'Dados',
            'nascimento' => '2019-09-10',
            'orgaoEmissor' =>  'Dados',
            'orgaoEmissorUF' =>  'Dados',
            'cpf' =>  '123456789'.$i,
            'tituloEleitoral' =>  'Dados',
            'filiacao' =>  'Dados',
            'endereco' =>  'Dados',
            'num' =>  'Dados',
            'bairro' =>  'Dados',
            'cidade' =>  'Dados',
            'uf' =>  'Dados',
            'foneResidencial' =>  'Dados',
            'foneCelular' =>  'Dados',
            'foneComercial' =>  'Dados',
          ]);
        }

        for($i = 1; $i < 21; $i++){
          DB::table('users')->insert([
            'email' => 'candidato'.$i.'@gmail.com',
            'password' => bcrypt('12345678'),
            'tipo' => 'candidato',
            'dados' => $i,
          ]);
        }

        DB::table('editals')->insert([
          'pdfEdital' => 'seed/pdfTeste.pdf',
          'vagas' => '11:1?1?1?1?1!12:10?10?10?10?1!',
          'inicioInscricoes' => '2019-09-01',
          'fimInscricoes' => '2019-09-02',
          'inicioRecurso' => '2019-09-03',
          'fimRecurso' => '2019-09-04',
          'inicioIsencao' => '2019-09-05',
          'fimIsencao' => '2019-09-06',
          'inicioRecursoIsencao' => '2019-09-07',
          'fimRecursoIsencao' => '2019-09-08',
          'nome' => 'Edital para classificação',
          'created_at' => '2019-09-02 18:15:48',
          'publicado' => 'sim',
          'dataPublicacao' => '2019-09-02',
          'resultado' => '2019-09-10',
          'inicioRecursoResultado' => '2019-10-11',
          'fimRecursoResultado' => '2019-11-12',
          'resultadoFinal' => '2019-12-13',
          'descricao' => 'Edital extravestibular 2019.2',

        ]);

        DB::table('editals')->insert([
            'pdfEdital' => 'seed/pdfTeste.pdf',
            'vagas' => '11:1?2?3?4?5!12:1?2???!',
            'inicioInscricoes' => '2019-09-01',
            'fimInscricoes' => '2019-12-02',
            'inicioRecurso' => '2019-09-03',
            'fimRecurso' => '2019-12-04',
            'inicioIsencao' => '2019-09-05',
            'fimIsencao' => '2019-12-06',
            'inicioRecursoIsencao' => '2019-09-07',
            'fimRecursoIsencao' => '2019-12-08',
            'nome' => 'Edital para Demonstração',
            'created_at' => '2019-09-10 18:15:48',
            'publicado' => 'sim',
            'dataPublicacao' => '2019-09-10',
            'resultado' => '2019-12-10',
            'inicioRecursoResultado' => '2019-09-11',
            'fimRecursoResultado' => '2019-12-12',
            'resultadoFinal' => '2019-12-13',
            'descricao' => 'Edital extravestibular 2019.2',


        ]);


        for($i = 1; $i < 21; $i++){
          if( $i < 15){
            DB::table('inscricaos')->insert([
                'usuarioId' => $i,
                'editalId' => '1',
                'tipo' => 'reintegracao',
                'comprovante' => 'isento',
                'historicoEscolar' => 'seed/pdfTeste.pdf',
                'curso' => '11',
                'turno' => 'manhã',
                'cursoDeOrigem' => 'Dados',
                'instituicaoDeOrigem' => 'Dados',
                'naturezaDaIes' => 'Dados',
                'endereco' => 'Dados',
                'num' => 'Dados',
                'bairro' => 'Dados',
                'homologado' => 'aprovado',
                'homologadoDrca' => 'aprovado',
                'cidade' => 'Dados',
                'uf' => 'Dados',
                'coeficienteDeRendimento' => '9',
                'nota' => '0.5'



            ]);
          }

          if($i == 19){
            DB::table('inscricaos')->insert([
                'usuarioId' => $i,
                'editalId' => '1',
                'tipo' => 'reintegracao',
                'historicoEscolar' => 'seed/pdfTeste.pdf',
                'comprovante' => 'isento',
                'curso' => '11',
                'turno' => 'manhã',
                'cursoDeOrigem' => 'Dados',
                'instituicaoDeOrigem' => 'Dados',
                'naturezaDaIes' => 'Dados',
                'endereco' => 'Dados',
                'num' => 'Dados',
                'bairro' => 'Dados',
                'homologado' => 'aprovado',
                'homologadoDrca' => 'aprovado',
                'cidade' => 'Dados',
                'uf' => 'Dados',
                'coeficienteDeRendimento' => 'nao',

            ]);
          }

          if($i == 20){
            DB::table('inscricaos')->insert([
                'usuarioId' => $i,
                'editalId' => '1',
                'tipo' => 'reintegracao',
                'historicoEscolar' => 'seed/pdfTeste.pdf',
                'comprovante' => 'isento',
                'curso' => '11',
                'turno' => 'manhã',
                'cursoDeOrigem' => 'Dados',
                'instituicaoDeOrigem' => 'Dados',
                'naturezaDaIes' => 'Dados',
                'endereco' => 'Dados',
                'num' => 'Dados',
                'bairro' => 'Dados',
                'homologado' => 'aprovado',
                'homologadoDrca' => 'aprovado',
                'cidade' => 'Dados',
                'uf' => 'Dados',
                'coeficienteDeRendimento' => '9',
                'nota' => '0.5'
            ]);
          }

        }

        DB::table('isencaos')->insert([
          'usuarioId' => 1,
          'editalId' => 1,
          'tipo' => 'ambos',
          'motivoRejeicao' => 'Anexou arquivo errado.',
        ]);

        DB::table('recursos')->insert([
          'tipo' => 'taxa',
          'motivo' => 'Erro na documentação',
          'usuarioId' => 1,
          'editalId' => 1,
          'data' => '2019-09-11',
          'homologado' => 'indeferida',
          'motivoRejeicao' => 'Não se aplica',

        ]);
    }
}
