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
    // Route::get('/affordable-tow-truck-company-near-me-in-usa-24-7-help', [HomeController::class, 'service2'])->name('service2');
    // Route::get('/cheap-tow-truck-near-me-in-new-york-call-now', [HomeController::class, 'service3'])->name('service3');
    // Route::get('/tow-truck-service-near-me-24-7-help-across-the-usa', [HomeController::class, 'service4'])->name('service4');
    // Route::get('/best-tow-truck-companies-near-me-trusted-service-usa', [HomeController::class, 'service5'])->name('service5');
    // Route::get('/tow-truck-near-me-floridas-fastest-tow-now', [HomeController::class, 'service6'])->name('service6');
    // Route::get('/truck-towing-near-me-fast-&-affordable-usa-service', [HomeController::class, 'service7'])->name('service7');
    // Route::get('/50-tow-truck-near-me-budget-friendly-usa-towing', [HomeController::class, 'service8'])->name('service8');
    // Route::get('/tow-now-tow-truck-near-me-cheap-across-usa', [HomeController::class, 'service9'])->name('service9');
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
