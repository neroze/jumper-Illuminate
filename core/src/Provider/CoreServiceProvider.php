<?php
namespace Jumper\Core\Provider;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
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
            __DIR__.'/../resources/assets/js/app/jumper' => resource_path('assets/js/app/jumper_raw'),
            
        ],'js');
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
