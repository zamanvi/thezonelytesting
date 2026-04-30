<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        try {
            View::share('allMenuCategories', Category::with('children')->whereNull('parent_id')->get());
        } catch (\Exception $e) {
            View::share('allMenuCategories', collect());
        }
    }
}
