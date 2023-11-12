<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\ClientePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //Se agrega la policy asociando al modelo User con la ClientePolicy
        User::class => ClientePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Al llamarlo, Laravel automáticamente buscará las políticas definidas en la aplicación y las registrará para su uso
        $this->registerPolicies();
    }
}
