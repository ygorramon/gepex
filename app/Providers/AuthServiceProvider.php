<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            $permissao = false;
            foreach ($user->perfils as $perfil) {
                if ($perfil->name == "ADMIN") {
                    $permissao = true;
                }
            }
            return ($permissao);
        });
        Gate::define('prefeito', function (User $user) {
            $permissao = false;
            foreach ($user->perfils as $perfil) {
                if ($perfil->name == "ADMIN" || $perfil->name == "PREFEITO") {
                    $permissao = true;
                }
            }
            return ($permissao);
        });
        Gate::define('secretaria', function (User $user) {
            $permissao = false;
            foreach ($user->perfils as $perfil) {
                if ($perfil->name == "ADMIN" || $perfil->name == "SECRETARIA") {
                    $permissao = true;
                }
            }
            return ($permissao);
        });
    }
}
