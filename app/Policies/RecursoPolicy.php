<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Lmts\src\controller\LmtsApi;

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
        $this->api = new LmtsApi();
    }

    public function homologarRecurso(?User $user){
      return $this->api->autorizar('homologar recursos');

    }

    public function cadastrarRecurso(?User $user){
      return $this->api->autorizar('cadastrar recursos');

    }
}
