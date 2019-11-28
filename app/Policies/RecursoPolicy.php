<?php

namespace extravestibular\Policies;

use extravestibular\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecursoPolicy
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

    public function homologarRecurso(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'homologar recursos'){
          return true;
        }
      }
      return false;
    }

    public function cadastrarRecurso(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'cadastrar recursos'){
          return true;
        }
      }
      return false;
    }
}
