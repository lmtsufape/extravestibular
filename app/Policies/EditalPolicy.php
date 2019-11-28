<?php

namespace extravestibular\Policies;

use extravestibular\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use extravestibular\ApiLmts;

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
        $this->api = new ApiLmts();
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
