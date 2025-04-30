<?php
namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function resizeAndSave($file, $width, $height, $path): string
    {
        $name_gen = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

        $this->manager->read($file)
            ->resize($width, $height)
            ->save(public_path($path . $name_gen));

        return $path . $name_gen;
    }
}
