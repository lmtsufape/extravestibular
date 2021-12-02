<?php

namespace App\Policies;

use App\User;
use App\Inscricao;
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
      $inscricao = Inscricao::all()->where('id', request()->inscricaoId)->first();
      return $this->api->autorizar('homologar inscricoes')
        || auth()->user()->analistas()->where('analistas.edital_id', $inscricao->edital->id)->count();
    }

    public function cadastrarInscricao(?User $user){
      return $this->api->autorizar('cadastrar inscricoes');
    }
}
