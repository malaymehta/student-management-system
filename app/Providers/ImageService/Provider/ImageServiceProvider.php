<?php namespace App\Providers\ImageService\Provider;

use Illuminate\Support\ServiceProvider;


class ImageServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    /**
     * Bind the Select Class to the IOC container.
     * Used for Populating Select Boxes.
     */
    public function register()
    {
        $this->app->bind('ImageService', function () {
            return $this->app->make('App\Providers\ImageService\ImageService');
        });
    }
}
