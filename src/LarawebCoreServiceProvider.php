<?php

namespace Ombimo\LarawebCore;

use Illuminate\Support\ServiceProvider;
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
        $this->publishes([
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
