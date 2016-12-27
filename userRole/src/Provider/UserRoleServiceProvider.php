<?php

namespace Jumper\UserRole\Provider;

use Illuminate\Support\ServiceProvider;

class UserRoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // pointing views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'userRole');
        // publishing views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/userRole'),

        ]);
        $this->publishes([
            __DIR__.'/../resources/assets/js/app/user_role' => resource_path('assets/js/app/user_role_raw'),

        ], 'role_js');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
