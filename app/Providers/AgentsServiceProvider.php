<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AgentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Services\Contracts\AgentsAuthServiceInterface::class,
            \App\Services\AgentsService::class
        );
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
