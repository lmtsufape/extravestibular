<?php

namespace App\Policies;

use App\User;
use App\Isencao;
use Illuminate\Auth\Access\HandlesAuthorization;
use Lmts\src\controller\LmtsApi;


class IsencaoPolicy
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

    public function homologarIsencao(?User $user){
      $isencao = Isencao::all()->where('id', request()->isencaoId)->first();
      return $this->api->autorizar('homologar isencoes')
        || auth()->user()->analistas()->where('analistas.edital_id', $isencao->edital->id)->count();
    }

    public function cadastrarIsencao(?User $user){
      return $this->api->autorizar('cadastrar isencoes');
    }
}
