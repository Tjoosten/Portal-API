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
     * Bootstrap the application services.
     *
     * @eturn void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

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
            'namespace' => 'LeaseDeck\PortalApi\Http\Controllers',
            'middleware' => 'portalApi',
        ];
    }
}
