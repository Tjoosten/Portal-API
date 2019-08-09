<?php

namespace Leasedeck\ApiPortalApi;

use Illuminate\Support\ServiceProvider;

/**
 * Class ApiPortalApiServiceProvider
 *
 * @package Leasedeck\ApiPortalApi
 */
class ApiPortalApiServiceProvider extends ServiceProvider
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
            // TODO: Implement console specific tasks.
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
