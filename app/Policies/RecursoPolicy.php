<?php

namespace App\Policies;

use App\User;
use App\Recurso;
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
      $recurso = Recurso::all()->where('id', request()->recursoId)->first();
      return $this->api->autorizar('homologar recursos')
        || auth()->user()->analistas()->where('analistas.edital_id', $recurso->edital->id)->count();

    }

    public function cadastrarRecurso(?User $user){
      return $this->api->autorizar('cadastrar recursos');

    }
}
