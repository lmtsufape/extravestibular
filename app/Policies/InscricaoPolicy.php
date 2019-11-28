<?php

namespace extravestibular\Policies;

use extravestibular\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InscricaoPolicy
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

    public function classificarInscricao(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'classificar inscrições'){
          return true;
        }
      }
      return false;
    }

    public function homologarInscricao(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'homologar inscrições'){
          return true;
        }
      }
      return false;
    }

    public function cadastrarInscricao(?User $user){
      $acl = explode(';', session('acl'));
      foreach ($acl as $key) {
        if($key == 'cadastrar inscrições'){
          return true;
        }
      }
      return false;
    }
}
