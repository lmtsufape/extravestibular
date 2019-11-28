<?php

namespace extravestibular\Policies;

use extravestibular\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use extravestibular\ApiLmts;



class RecursoPolicy
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

    public function homologarRecurso(?User $user){
      return $this->api->autorizar('homologar recursos');

    }

    public function cadastrarRecurso(?User $user){
      return $this->api->autorizar('cadastrar recursos');

    }
}
