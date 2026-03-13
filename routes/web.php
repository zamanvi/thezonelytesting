<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StateController;
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
    Route::get('all-attorney', [HomeController::class, 'attorney_all'])->name('attorney.all');
    Route::get('search', [HomeController::class, 'attorney_search'])->name('attorney.search');
    Route::get('attorney/{slug}', [HomeController::class, 'attorney_show'])->name('attorney.show');
    // Route::get('/fast-tow-trucks-near-me-reliable-towing-in-the-USA', [HomeController::class, 'service1'])->name('service1');
    Route::get('/help', [HomeController::class, 'help'])->name('help');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');
    Route::get('/terms-and-condition', [HomeController::class, 'terms_and_condition'])->name('terms-and-condition');
    Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
    Route::get('/about-site-author', [HomeController::class, 'about_site_author'])->name('about-site-author');
    Route::get('/tools', [HomeController::class, 'tools'])->name('tools');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    // Route::get('/search', [HomeController::class, 'search'])->name('search');
});

Route::get('user/login', [HomeController::class, 'user_login'])->name('user.login');
Route::get('user/register', [HomeController::class, 'user_register1'])->name('user.register1');
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
    if ($user->type === 'user') {
        return redirect()->route('user.dashboard');
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

    Route::resource('vehicles', VehicleController::class);
    Route::prefix('vehicles/{vehicle}')->group(function () {
        Route::get('policies/create', [PolicyController::class, 'create'])->name('policies.create');
        Route::post('policies', [PolicyController::class, 'store'])->name('policies.store');
        Route::get('policies/{policy}', [PolicyController::class, 'show'])->name('policies.show');
        Route::get('policies/{policy}/edit', [PolicyController::class, 'edit'])->name('policies.edit');
        Route::put('policies/{policy}', [PolicyController::class, 'update'])->name('policies.update');
        Route::delete('policies/{policy}', [PolicyController::class, 'destroy'])->name('policies.destroy');
    });
    Route::prefix('vehicles/{vehicle}/policies/{policy}')->group(function () {
        Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
        Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
        Route::put('payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
        Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    });

    Route::get('clear-cache', [PageController::class, 'clear_cache'])->name('clear.cache');

    Route::resource('countries', CountryController::class);
    Route::resource('countries.states', StateController::class);
    Route::resource('states.cities', CityController::class);

    // Blog management
    Route::resource('blogs', BlogController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('services', ServiceController::class);
});

/*
|--------------------------------------------------------------------------
| user Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
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
