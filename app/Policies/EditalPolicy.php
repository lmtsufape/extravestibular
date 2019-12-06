<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Lmts\src\controller\LmtsApi;




class EditalPolicy
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

    /**
     * Gerenciar editais = criar, modificar, apagar, erratas.
     *
     * @return bollean
     */
    public function gerenciarEdital(?User $user){
      return $this->api->autorizar('gerenciar editais');
    }
}
