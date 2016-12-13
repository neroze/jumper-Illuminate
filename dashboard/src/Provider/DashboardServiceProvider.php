<?php

namespace Jumper\Dashboard\Provider;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // pointing views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dash');
        // publishing views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dash'),

        ]);
        $this->publishes([
            __DIR__.'/../resources/assets/js/app/dashboard' => resource_path('assets/js/app/dashboard_raw'),

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
