<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('frontend.')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    // Route::get('/fast-tow-trucks-near-me-reliable-towing-in-the-USA', [HomeController::class, 'service1'])->name('service1');
    Route::get('/help', [HomeController::class, 'help'])->name('help');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');
    Route::get('/terms-and-condition', [HomeController::class, 'terms_and_condition'])->name('terms-and-condition');
    Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
    Route::get('/about-site-author', [HomeController::class, 'about_site_author'])->name('about-site-author');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
});
Route::get('/blog/{slug}', [HomeController::class, 'blog_show'])->name('blog.show');
Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('sitemap');

Route::middleware(['auth', 'verified'])
    ->get('/dashboard', function () {
        if (Auth::user()->type === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
            Route::get('clear-cash', [PageController::class, 'clear_cash'])->name('clear.cash');

            Route::resource('blogs', BlogController::class);
        });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
