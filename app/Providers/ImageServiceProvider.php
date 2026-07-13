<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\ImageManager;

// use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver; // if using imagick

class ImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImageManager::class, function () {
            return new ImageManager(new GdDriver);
            // If you want imagick instead:
            // return new ImageManager(new ImagickDriver());
        });
    }

    public function boot()
    {
        //
    }
}
