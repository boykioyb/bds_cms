<?php

namespace App\Providers;

use App\GuzzleHttp\ConnectAPI;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\GuzzleHttp\ConnectAPI', function ($app) {
            return new ConnectAPI();
        });
    }
}
