<?php

namespace Jumper\User\Provider;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // pointing views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'jumperUser');
        // publishing views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/user'),

        ]);
        $this->publishes([
            __DIR__.'/../resources/assets/js/app/user' => resource_path('assets/js/app/user_raw'),

        ], 'js');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
