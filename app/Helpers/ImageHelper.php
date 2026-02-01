<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Str;

class ImageHelper
{
    public static function convertToWebpSharp($file, string $dir): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());

        $filename = Str::uuid() . '.webp';
        $path = storage_path("app/public/{$dir}/{$filename}");

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // 🔥 lossless webp (ไม่เสียรายละเอียด)
        $image->encode(new WebpEncoder(100, true))->save($path);

        return "{$dir}/{$filename}";
    }
}
