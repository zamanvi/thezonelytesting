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
        try {
            $filename = Str::uuid() . '.webp';
            $dir      = storage_path('app/public/' . $folder);
            $fullPath = $dir . '/' . $filename;

            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $manager->read($file->getPathname())
                ->scaleDown(width: 800)
                ->toWebp(quality: 82)
                ->save($fullPath);

            return 'storage/' . $folder . '/' . $filename;
        } catch (\Throwable $e) {
            $path = $file->store($folder, 'public');
            return 'storage/' . $path;
        }
    }
}
