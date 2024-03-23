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

        if ($env === 'production') {
        URL::forceScheme('https');
        }
        
        if ($env === 'production') {
        $this->app['request']->server->set('HTTPS', true);
        }
    }
}
