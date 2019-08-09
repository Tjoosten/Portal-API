<?php

namespace Leasedeck\PortalApi;

use Illuminate\Support\ServiceProvider;
use Leasedeck\PortalApi\Console\Commands\GenerateApiKey;

/**
 * Class PortalApiServiceProvider
 *
 * @package Leasedeck\ApiPortalApi
 */
class PortalApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @eturn void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([GenerateApiKey::class]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
