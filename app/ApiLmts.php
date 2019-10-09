<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

class ApiLmts extends Model{
  public $api = 'http://app.uag.ufrpe.br/api/api/';
  // public $api = 'lmts.api/api/';

  public function getCursos(){
    $client = new Client(); //GuzzleHttp\Client
    $response = $client->request('GET',$this->api . 'curso/', [
                                                             'headers' => [
                                                                           'Authorization' => session('token_type').' '.session('access_token'),
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

  public function loginApi($email, $password){
    $client = new Client(); //GuzzleHttp\Client
    try{
      $usuario = $client->request('POST', $this->api . 'auth/login', [
        //'headers' => ['Content-Type' => 'application/json', 'X-Requested-With' => 'XMLHttpRequest'],
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
