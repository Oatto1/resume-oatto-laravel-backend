<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Str;

class ImageHelper
{
    public static function smartResizeAndStore($file, string $dir): string
    {
        $ext = strtolower($file->getClientOriginalExtension());

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());

        $basePath = storage_path("app/public/{$dir}");
        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }

        // 🟢 PNG screenshot → ไม่ resize
        if ($ext === 'png') {
            $filename = Str::uuid() . '.png';
            $path = "{$basePath}/{$filename}";

            // save ตรง ๆ (optimize IO แต่ไม่ทำลาย pixel)
            $image->save($path);

            return "{$dir}/{$filename}";
        }

        // 🔵 รูปถ่าย (jpg) → resize + webp
        if ($image->width() > 1600) {
            $image->scaleDown(1600);
        }

        $filename = Str::uuid() . '.webp';
        $path = "{$basePath}/{$filename}";

        $image->encode(new WebpEncoder(90, false))->save($path);

        return "{$dir}/{$filename}";
    }
}
