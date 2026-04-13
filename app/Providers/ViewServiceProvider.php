<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
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
            $route = Route::current();

            if (!$route) {
                return;
            }

            $routeName = $route->getName();

            // Ensure it's a string
            if (!is_string($routeName)) {
                return;
            }

            // ADMIN
            if (str_starts_with($routeName, 'admin.')) {
                $view->with([
                    'blogCount' => Blog::count(),
                    'categoryCount' => Category::count(),
                    'userCount' => User::where('type', 'profile')->count(),
                ]);
            }

            // FRONTEND
            if (str_starts_with($routeName, 'frontend.')) {

                $allMenuCategories = Category::whereNull('parent_id')
                    ->where('is_active', 1)
                    ->with(['children' => function ($q) {
                        $q->where('is_active', 1);
                    }])
                    ->get();

                $view->with('allMenuCategories', $allMenuCategories);
            }
        });
    }
}
