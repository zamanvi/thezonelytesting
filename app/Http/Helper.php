<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if (!function_exists('getUserType')) {
    /**
     * Check if it is admin or not
     */
    function getUserType()
    {
        return Auth::user()->type;
    }
}
if (!function_exists('get_color')) {
    /**
     * Check if it is admin or not
     */
    function get_color($key)
    {
        return config('color.' . $key);
    }
}

if (!function_exists('make_slug')) {
    /**
     * Make slug from any text
     *
     * @param $slug
     */
    function make_slug($slug)
    {
        return Str::slug($slug);
    }
}
if (!function_exists('generateUniqueSlug')) {
    /**
     * Get Random Number
     *
     * @param  string  $modelClass   The model class (e.g. Category::class).
     * @param  string  $value        The base text (title or provided slug).
     * @param  string  $column       Column name to check uniqueness (default: 'slug').
     * @return string
     */
    function generateUniqueSlug(string $modelClass, string $value, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $slug     = Str::slug($value);
        $original = $slug;
        $i = 1;

        while ($modelClass::where($column, $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            
            $suffix = '-' . $i++;
            $slug   = Str::limit($original, 255 - strlen($suffix), '') . $suffix;
        }

        return $slug;
    }
}
if (!function_exists('get_random_number')) {
    /**
     * Get Random Number
     *
     * @param $length
     */
    function get_random_number($length)
    {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 5)), 0, $length);
    }
}

if (!function_exists('set_increment_slug')) {
    function set_increment_slug($target, $slug)
    {
        $max = $target
            ::where('slug', 'LIKE', "{$slug}%")
            ->latest('id')
            ->value('slug');
        if ($max) {
            $parts = explode('-', $max);
            $number = intval(end($parts));
            $slug = $slug . '-' . ($number + 1);
        } else {
            $slug = $slug . '-1';
        }
        return $slug . '-' . get_random_number(10);
    }
}

if (!function_exists('upload_file')) {
    /**
     * Upload File
     *
     * @param $imagePath
     */
    function upload_file($image)
    {
        if (config('filesystems.default') === 'public') {
            $image_name = time() . '-' . get_random_number(32) . '.' . $image->getClientOriginalExtension();
            $folder = config('app.env') === 'local' && config('app.debug') ? 'uploads/local' : 'uploads';
            $image->storeAs($folder, $image_name, 'public');
            return $image_name;
        }
    }
}
if (!function_exists('delete_file')) {
    /**
     * Delete File
     *
     * @param string|null $imagePath
     * @return bool
     */
    function delete_file($imagePath): bool
    {
        if (empty($imagePath)) {
            return false;
        }
        if (config('filesystems.default') === 'public') {
            $folder = config('app.env') === 'local' && config('app.debug') ? 'uploads/local/' : 'uploads/';
            $fullPath = $folder . $imagePath;

            if (Storage::disk('public')->exists($fullPath)) {
                return Storage::disk('public')->delete($fullPath);
            }
        }

        return false;
    }
}
if (!function_exists('get_file')) {
    /**
     * Uploaded File
     *
     * @param $imagePath
     */
    function get_file($imagePath, $for = 'default')
    {
        if (empty($imagePath)) {
            return empty_image($for);
        }

        if (config('filesystems.default') === 'public') {
            $folder = config('app.env') === 'local' && config('app.debug') ? 'uploads/local/' : 'uploads/';
            $fullPath = $folder . $imagePath;

            if (Storage::disk('public')->exists($fullPath)) {
                return Storage::disk('public')->url($fullPath);
            }
        }

        return empty_image($for);
    }
}
if (!function_exists('empty_image')) {
    function empty_image($type = 'default')
    {
        switch ($type) {
            case 'user':
                $image = asset('images/user.png');
                break;
            case 'blog':
                $image = asset('images/blog.jpg');
                break;
            case 'contest':
                $image = asset('images/contest.jpg');
                break;
            default:
                $image = asset('images/no-image.jpg');
                break;
        }
        return $image;
    }
}
