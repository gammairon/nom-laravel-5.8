<?php

namespace App\Providers;

use App\UseCases\JsonLd\JsonLdFactory;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('JsonLdFactory', function ($app) {
            return new JsonLdFactory();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
