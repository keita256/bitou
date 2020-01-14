<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MonelyzeDBServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'monelyzeDB',
            'App\Services\MonelyzeDB'
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
