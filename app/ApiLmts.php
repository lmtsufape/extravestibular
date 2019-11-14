<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

class ApiLmts extends Model{
  public $api = 'http://app.uag.ufrpe.br/api/api/';
  // public $api = 'http://lmts.api/api/';

  public function check(){
    $client = new Client(); //GuzzleHttp\Client
    $response = $client->request('GET',$this->api . 'check/', [
                                                             'headers' => [
                                                                           'Authorization' => session('token_type').' '.session('access_token'),
                                                                           'Content-Type' => 'application/json',
                                                                           'X-Requested-With' => 'XMLHttpRequest'
                                                                          ]
                                                            ]);
    if($response->getStatusCode() == 201){

      return true;
    }
    else{
      return false;
    }
  }

  public function getCursos(){
    $client = new Client(); //GuzzleHttp\Client
    $response = $client->request('GET',$this->api . '1/getUnidades/6/5', [
                                                             'headers' => [
                                                                           'Authorization' => session('token_type').' '.session('access_token'),
                                                                           'Content-Type' => 'application/json',
                                                                           'X-Requested-With' => 'XMLHttpRequest'
                                                                          ]
                                                            ]);
    if($response->getStatusCode() == 200){
      $response = json_decode($response->getBody(), true);
      $aux = [];
      // dd($response);
      for($i = 0; $i < sizeof($response); $i++){
        $nomeCampus = '';
        $nomeDep = '';
        for($j = 0; $j < sizeof($response[$i]); $j++){
          for($k = 0; $k < sizeof($response[$i][$j]); $k++){
            if($response[$i][$j][$k] == ''){
              continue;
            }
            if($response[$i][$j][$k][0]['tipoUnidade'] == 'Campus'){
              $nomeCampus = $response[$i][$j][$k][0]['nome'];
            }
            if($response[$i][$j][$k][0]['tipoUnidade'] == 'Departamento'){
              $nomeDep = $response[$i][$j][$k][0]['nome'];
            }
            if($response[$i][$j][$k][0]['tipoUnidade'] == 'Curso de Graduação'){
              array_push($aux, [
                'id' => $response[$i][$j][$k][0]['id'],
                'nome' => $response[$i][$j][$k][0]['nome'],
                'departamento' => $nomeDep,
                'campus'  => $nomeCampus,
              ]);
            }
          }
        }
      }

      $response = $aux;
      return $response;
    }
    else{
      return null;
    }
  }

  public function loginApi($email, $password){
    $client = new Client(); //GuzzleHttp\Client
    try{
      $usuario = $client->request('POST', $this->api . 'auth/login', [
        // 'headers' => ['Content-Type' => 'application/json', 'X-Requested-With' => 'XMLHttpRequest'],
        'form_params' => ['email' => $email, 'password' => $password],
      ]);

      if($usuario->getStatusCode() == 201){
        $usuario = json_decode($usuario->getBody(), true);
        session(['access_token' => $usuario['access_token'], 'token_type' => $usuario['token_type']]);
        $usuario = $client->request('GET', $this->api . 'usuario/getDados/' .             $email, [
                                                                                                    'headers' =>  [
                                                                                                                    'Content-Type' => 'application/json',
                                                                                                                    'X-Requested-With' => 'XMLHttpRequest',
                                                                                                                    'Authorization' => $usuario['token_type'].' '.$usuario['access_token']
                                                                                                                  ],
                                                                                                  ]);
        $usuario = json_decode($usuario->getBody(), true);
        // dd($usuario);
        return $usuario;
      }
      else{
        return null;
      }
    }catch(ClientException $e){
      return null;
    }
  }

  public function getEmailsCoordenadorPorCurso($cursoId){
    $client = new Client(); //GuzzleHttp\Client
    $response = $client->request('GET',$this->api . 'usuario/coordenador/getEmails/' . $cursoId, [
                                                                                                 'headers' => [
                                                                                                               'Content-Type' => 'application/json',
                                                                                                               'X-Requested-With' => 'XMLHttpRequest'
                                                                                                              ]
                                                                                                ]);
    if($response->getStatusCode() == 201){
      $response = json_decode($response->getBody(), true);
      return $response;
    }
    else{
      return null;
    }
  }

  public function getEmailsPreg(){
    $client = new Client(); //GuzzleHttp\Client
    $response = $client->request('GET',$this->api . 'usuario/preg/getEmails',                   [
                                                                                                 'headers' => [
                                                                                                               'Content-Type' => 'application/json',
                                                                                                               'X-Requested-With' => 'XMLHttpRequest'
                                                                                                              ]
                                                                                                ]);
    if($response->getStatusCode() == 201){
      $response = json_decode($response->getBody(), true);
      return $response;
    }
    else{
      return null;
    }
  }
}
