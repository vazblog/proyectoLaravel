<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{

    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        //
        $env = config('app.env');

        if ($env === 'development') {
        URL::forceScheme('https');
        }
        
        if ($env === 'development') {
        $this->app['request']->server->set('HTTPS', true);
        }
    }
}
