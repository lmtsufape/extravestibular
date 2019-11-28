<?php

namespace extravestibular\Policies;

use extravestibular\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IsencaoPolicy
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

    public function homologarIsencao(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'homologar isenções'){
          return true;
        }
      }
      return false;
    }

    public function cadastrarIsencao(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'cadastrar isenções'){
          return true;
        }
      }
      return false;
    }
}
