<?php

namespace Jumper\Subscriptions\Provider;

use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // pointing views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'jumperSubscriptions');
        // publishing views
         $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/jumperSubscriptions'),
        ]);

        $this->publishes([
            __DIR__.'/../resources/assets/app/' => resource_path('assets/js/app/subscriptions_raw/'),

        ], 'jumperSubscriptions_js');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
       $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
