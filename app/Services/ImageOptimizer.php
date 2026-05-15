<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizer
{
    /**
     * Resize, convert to WebP, compress, and store a profile photo to R2.
     * Returns full public URL (https://...) to store in DB.
     */
    public static function saveProfilePhoto(UploadedFile $file, string $folder = 'profiles'): string
    {
        $filename = $folder . '/' . Str::uuid() . '.webp';

        try {
            $manager = new ImageManager(new Driver());
            $encoded = $manager->read($file->getPathname())
                ->scaleDown(width: 800)
                ->toWebp(quality: 82);

            Storage::disk('r2')->put($filename, (string) $encoded, 'public');

            return Storage::disk('r2')->url($filename);
        } catch (\Throwable $e) {
            // R2 failed — fall back to local public disk
            $path = $file->store($folder, 'public');
            return asset('storage/' . $path);
        }
    }
}
