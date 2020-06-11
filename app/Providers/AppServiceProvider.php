<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* if(env('FORCE_HTTPS',false)) { // Default value should be false for local server
            URL::forceSchema('https');
        } */
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
