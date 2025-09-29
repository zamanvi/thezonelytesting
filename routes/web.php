<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
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
    Route::get('attorney/{slug}', [HomeController::class, 'attorney_show'])->name('attorney.show');
    // Route::get('/fast-tow-trucks-near-me-reliable-towing-in-the-USA', [HomeController::class, 'service1'])->name('service1');
    Route::get('/help', [HomeController::class, 'help'])->name('help');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');
    Route::get('/terms-and-condition', [HomeController::class, 'terms_and_condition'])->name('terms-and-condition');
    Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
    Route::get('/about-site-author', [HomeController::class, 'about_site_author'])->name('about-site-author');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
});

Route::get('user/login', [HomeController::class, 'user_login'])->name('user.login');
Route::get('user/register', [HomeController::class, 'user_register1'])->name('user.register');
Route::get('user/register/{slug}', [HomeController::class, 'user_register2'])->name('user.register');
Route::post('user/login', [HomeController::class, 'user_submit_login'])->name('user.submit.login');
Route::post('user/register', [HomeController::class, 'user_submit_register'])->name('user.submit.register');

Route::get('/blog/{slug}', [HomeController::class, 'blog_show'])->name('blog.show');
Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $user = Auth::user();
    if ($user->type === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if ($user->type === 'profile') {
        if ($user->work_address === null || $user->phone === null) {
            return redirect()->route('profile.edit')->with('warning', 'Please complete your profile before proceeding.');
        }
        return redirect()->route('profile.dashboard');
    }
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [PageController::class, 'admin_dashboard'])->name('dashboard');
    Route::prefix('profiles')->name('profiles.')->group(function () {
        Route::get('index', [PageController::class, 'profiles_index'])->name('index');
        Route::get('edit/{id}', [PageController::class, 'profiles_edit'])->name('edit');
        Route::put('update/{id}', [PageController::class, 'profiles_update'])->name('update');
        Route::delete('destroy/{id}', [PageController::class, 'profiles_destroy'])->name('destroy');
    });
    Route::get('clear-cache', [PageController::class, 'clear_cache'])->name('clear.cache');

    // Blog management
    Route::resource('blogs', BlogController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('services', ServiceController::class);
});

/*
|--------------------------------------------------------------------------
| profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'profile'])->prefix('profile-base')->name('profile.')->group(function () {
    Route::get('dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::resource('services', ServiceController::class);
    Route::resource('educations', EducationController::class);
    Route::resource('memberships', MembershipController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('contacts', ContactController::class);
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
});

/*
|--------------------------------------------------------------------------
| User Profile
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () { 
    
    Route::get('profile/first', [ProfileController::class, 'edit'])->name('profile.first');
    Route::get('/profile/maintainance', [ProfileController::class, 'blockedlist'])->name('profile.blockedlist');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
