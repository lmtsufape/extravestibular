<?php

namespace extravestibular\Http\Controllers;

use Illuminate\Http\Request;
use extravestibular\Edital;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;


class EditalController extends Controller
{
    public function novoEdital(){
      $client = new Client(); //GuzzleHttp\Client
      /*$result = $client->post('your-request-uri', [
        'form_params' => [
          'sample-form-data' => 'value'
        ]
      ]);*/

        // Send an asynchronous request.
        // $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
        // $promise = $client->sendAsync($request)->then(function ($response) {
        //     echo 'I completed! ' . $response->getBody();
        // });
        // $promise->wait();
      $cursos = $client->get('lmts.api/api/curso/');
      if($cursos->getStatusCode() == 201){
        $cursos = json_decode($cursos->getBody(), true);
        return view('novoEdital', ['cursos' => $cursos]);
      }
    }

    public function cadastroEdital(Request $request){
      $file = $request->pdfEdital;
      $path = 'editais/';
      Storage::putFileAs($path, $file, $_FILES['pdfEdital']['name']);
      $vagas = "";
      for($i = 0; $i < $request->nCursos; $i++){
        $aux = "cursoId" . $i;
        $vagas = $vagas . $request->$aux . ":";
        $vagas = $vagas . $request->$i . "!";
      }

      Edital::create([
        'vagas'             => $vagas,
        'pdfEdital'         => '/home/wteia/usuario/extravestibular/storage/app/' . $path . $_FILES['pdfEdital']['name'],
        'inicioInscricoes'  => $request->inicioInscricoes,
        'fimInscricoes'     => $request->fimInscricoes,

      ]);

      return view('home');


    }
}
