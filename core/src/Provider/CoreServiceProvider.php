<?php

namespace Jumper\Core\Provider;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // pointing views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'jumperCore');
        // publishing views
         $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/jumperCore'),
        ],'core_views');

        $this->publishes([
            __DIR__.'/../resources/assets/js/app/jumper' => resource_path('assets/js/app/jumper'),
            __DIR__.'/../resources/assets/js/app/config' => resource_path('assets/js/app/config'),
            __DIR__.'/../resources/assets/js/lib' => resource_path('assets/js/lib'),
            __DIR__.'/../resources/assets/js/app.js' => resource_path('assets/js/app_raw.js'),

        ], 'core_app_js');

        $this->publishes([
            __DIR__.'/../Middleware/AccessOnlyIfRoolAs.php' => app_path('HTTP/Middleware/AccessOnlyIfRoolAs.php'),
            __DIR__.'/../Middleware/Impersonate.php' => app_path('HTTP/Middleware/Impersonate.php'),
            __DIR__.'/../Middleware/IsActive.php' => app_path('HTTP/Middleware/IsActive.php')

        ], 'core_middleware');

        $this->publishes([
            __DIR__.'/../resources/public' => public_path('/'),

        ], 'core_public_assets');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
