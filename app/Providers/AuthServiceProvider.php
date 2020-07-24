<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('manage-users',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('manage-colors',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('manage-IPs',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('manage-tests',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('manage-SSL',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('manage-login',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('edit-users',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('delete-users',function($user){
            return $user->hasRole('admin');
        });
        Gate::define('login-history',function($user){
            return $user->hasAnyRoles(['admin','user']);
        });
        Gate::define('testing-history',function($user){
            return $user->hasAnyRoles(['admin','user']);
        });
        Gate::define('work-IPs',function($user){
            return $user->hasAnyRoles(['admin','user']);
        });

        Gate::define('run-test',function($user){
            return $user->hasAnyRoles(['admin','user']);
        });
        //
    }
}
