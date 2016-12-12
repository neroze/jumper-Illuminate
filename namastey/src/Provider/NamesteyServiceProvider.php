<?php
namespace Jumper\Namstey\Provider;
use Illuminate\Support\ServiceProvider;

class NamesteyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // pointing views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'namastey');
        // publishing views
         $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/namastey'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
    }
}
