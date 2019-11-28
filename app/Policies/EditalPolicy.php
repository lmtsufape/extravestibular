<?php

namespace extravestibular\Policies;

use extravestibular\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EditalPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Gerenciar editais = criar, modificar, apagar, erratas.
     *
     * @return bollean
     */
    public function gerenciarEdital(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'gerenciar editais'){
          return true;
        }
      }
      return false;
    }
}
