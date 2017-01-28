<?php

namespace App\Providers;

use App\Classes\UploadImage;
use Illuminate\Support\ServiceProvider;

class ImageUploadProvider extends ServiceProvider
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
        $this->app->singleton('App\Classes\UploadImage', function($app){
            return new UploadImage();
        });
    }
}
