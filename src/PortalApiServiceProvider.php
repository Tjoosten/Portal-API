<?php

namespace Leasedeck\PortalApi;

use Illuminate\Support\Facades\Route;
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
     * register the application services.
     *
     * @eturn void
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/voyager-api.php', 'voayger-api');

        Route::middlewareGroup('portalApi', config('api.middleware', []));

        if ($this->app->runningInConsole()) {
            $this->commands([GenerateApiKey::class]);
        }

        $this->registerRoutes();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes(): void
    {
        Route::group($this->routeConfiguration(), static function (): void {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the portal route group configuration array
     *
     * @return array
     */
    private function routeConfiguration(): array
    {
        return [
            'namespace'  => 'LeaseDeck\PortalApi\Http\Controllers',
            'middleware' => 'portalApi',
        ];
    }
}
