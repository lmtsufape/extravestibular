<?php

namespace extravestibular\Policies;

use extravestibular\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use extravestibular\ApiLmts;



      return $this->api->autorizar('homologar recursos');

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
        $this->api = new ApiLmts();
    }

    public function homologarIsencao(?User $user){
      return $this->api->autorizar('homologar isencoes');
    }

    public function cadastrarIsencao(?User $user){
      return $this->api->autorizar('cadastrar isencoes');
    }
}
