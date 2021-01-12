<?php

namespace Ombimo\LarawebCore;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Ombimo\LarawebCore\Commands\SitemapIndex;

class LarawebCoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //route
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        //migration
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        if (config('laraweb.multilang')) {
            $this->loadMigrationsFrom(__DIR__.'/Database/MigrationsMulti');
        }

        $this->publishes([
            __DIR__ . '/../resources/view' => resource_path('views'),
            __DIR__ . '/../config/laraweb.php' => config_path('laraweb.php'),
            __DIR__ . '/../config/seo.php' => config_path('seo.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                SitemapIndex::class,
            ]);
        }

    }
}
