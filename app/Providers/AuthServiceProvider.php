<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Inscricao;
use App\Recurso;
use App\Isencao;
use App\Edital;
use App\Policies\InscricaoPolicy;
use App\Policies\RecursoPolicy;
use App\Policies\IsencaoPolicy;
use App\Policies\EditalPolicy;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Inscricao::class => InscricaoPolicy::class,
        Recurso::class => RecursoPolicy::class,
        Isencao::class => IsencaoPolicy::class,
        Edital::class => EditalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
