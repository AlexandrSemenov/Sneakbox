<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Classes\CleanProductsService;

class CleanProductsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Classes\CleanProducts', function(){
            return new CleanProductsService();
        });
    }
}