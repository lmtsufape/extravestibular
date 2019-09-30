<?php

namespace extravestibular;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ApiLmts extends Model{
  public $api = 'http://app.uag.ufrpe.br/api/api/';
  //public $api = 'lmts.api/api/curso/';

  public function getCursos(){
    $client = new Client(); //GuzzleHttp\Client
    $cursos = $client->get($this->api . 'curso/');//lmts.api/api/curso/
    if($cursos->getStatusCode() == 201){
      $cursos = json_decode($cursos->getBody(), true);
      return $cursos;
    }
    else{
      return (404);
    }
  }



}
