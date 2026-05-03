<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizer
{
    /**
     * Resize, convert to WebP, compress, and store a profile photo.
     * Returns the path to store in the DB (e.g. "storage/profiles/uuid.webp").
     */
    public static function saveProfilePhoto(UploadedFile $file, string $folder = 'profiles'): string
    {
        $filename  = Str::uuid() . '.webp';
        $dir       = storage_path('app/public/' . $folder);
        $fullPath  = $dir . '/' . $filename;

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $manager->read($file->getPathname())
            ->scaleDown(width: 800)   // max 800px wide, keeps ratio, never upscales
            ->toWebp(quality: 82)     // 82% quality = good visual / small file
            ->save($fullPath);

        return 'storage/' . $folder . '/' . $filename;
    }
}
