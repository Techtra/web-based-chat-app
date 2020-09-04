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

        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['create-users', 'edit-users', 'delete-users']);
        });

        Gate::define('create-users', function($user){
            return $user->hasRole('create-users');
        });

        Gate::define('edit-users', function($user){
            return $user->hasRole('edit-users');
        });

        $this->registerPolicies();

        Gate::define('delete-users', function($user){
            return $user->hasRole('delete-users');
        });

        Gate::define('create-chatroom', function($user){
            return $user->hasRole('create-chatroom');
        });
    }
}
