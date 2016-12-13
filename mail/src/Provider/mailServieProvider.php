<?php

namespace Jumper\Mail\Provider;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // pointing views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'jumperMail');
        // publishing views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/mail'),

        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
       // $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
