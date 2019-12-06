<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Lmts\src\controller\LmtsApi;



class InscricaoPolicy
{
    use HandlesAuthorization;
    private $api;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->api = new LmtsApi();
    }

    public function classificarInscricao(?User $user){
      return $this->api->autorizar('classificar inscricoes');
    }

    public function homologarInscricao(?User $user){
      return $this->api->autorizar('homologar inscricoes');
    }

    public function cadastrarInscricao(?User $user){
      return $this->api->autorizar('cadastrar inscricoes');
    }
}
