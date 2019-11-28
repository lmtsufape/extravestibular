<?php

namespace extravestibular\Providers;

use Illuminate\Support\Facades\Gate;
use extravestibular\Inscricao;
use extravestibular\Recurso;
use extravestibular\Isencao;
use extravestibular\Edital;
use extravestibular\Policies\InscricaoPolicy;
use extravestibular\Policies\RecursoPolicy;
use extravestibular\Policies\IsencaoPolicy;
use extravestibular\Policies\EditalPolicy;


use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'extravestibular\Model' => 'extravestibular\Policies\ModelPolicy',
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
