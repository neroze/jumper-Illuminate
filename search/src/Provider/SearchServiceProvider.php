<?php

namespace Jumper\Search\Provider;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
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
        ]);

        $this->publishes([
            __DIR__.'/../resources/assets/js' => resource_path('assets/js/app/search'),

        ], 'search_js');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
       // $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
