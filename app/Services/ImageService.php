<?php

namespace App\Services;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver);
    }

    public function resizeAndSave($file, $width, $height, $path): string
    {
        $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

        $this->manager->read($file)
            ->resize($width, $height)
            ->save(public_path($path.$name_gen));

        return $path.$name_gen;
    }
}
