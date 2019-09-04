<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\logService;

class logServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Contracts\logContract', function ($app) {
            return new logService();
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
