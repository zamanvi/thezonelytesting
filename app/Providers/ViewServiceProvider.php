<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $currentRoute = Route::current();

            if ($currentRoute && str_starts_with($currentRoute->getName(), 'admin.')) {
                $view->with(['blogCount' => Blog::count(), 'categoryCount' => Category::count()]);
            }
        });
    }
}
