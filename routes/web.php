<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StateController;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\PostalCode;
use App\Models\State;
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
    Route::get('all-service', [HomeController::class, 'service_all'])->name('service.all');
    Route::get('search', [HomeController::class, 'service_search'])->name('service.search');
    Route::get('service/{slug}', [HomeController::class, 'service_show'])->name('service.show');
    Route::get('category/{slug}', [HomeController::class, 'category_show'])->name('category');
    Route::get('/help', [HomeController::class, 'help'])->name('help');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');
    Route::get('/terms-and-condition', [HomeController::class, 'terms_and_condition'])->name('terms-and-condition');
    Route::get('/about-us', [HomeController::class, 'about_us'])->name('about-us');
    Route::get('/about-site-author', [HomeController::class, 'about_site_author'])->name('about-site-author');
    Route::get('/tools', [HomeController::class, 'tools'])->name('tools');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
});

Route::get('/get-subcategories/{id}', function ($id) {
    return Category::where('parent_id', $id)->get();
});

Route::get('/countries', function () {
    return Country::where('status', 1)->get();
});

Route::get('/states/{country_id}', function ($country_id) {
    return State::where('country_id', $country_id)->where('status', 1)->get();
});

Route::get('/cities/{state_id}', function ($state_id) {
    return City::where('state_id', $state_id)->where('status', 1)->get();
});

Route::get('/postal-codes/{city_id}', function ($city_id) {
    return PostalCode::where('city_id', $city_id)->where('status', 1)->get();
});
Route::get('user/login', [HomeController::class, 'user_login'])->name('user.login');
Route::get('user/register', [HomeController::class, 'user_register1'])->name('user.register1');
Route::get('user/register/{type}', [HomeController::class, 'user_register2'])->name('user.register');
Route::post('user/login', [HomeController::class, 'user_submit_login'])->name('user.submit.login');
Route::post('user/register', [HomeController::class, 'user_submit_register'])->name('user.submit.register');

Route::get('/blog/{slug}', [HomeController::class, 'blog_show'])->name('blog.show');
Route::get('/sitemap', [HomeController::class, 'sitemap'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| User Profile
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->type === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->type === 'seller') {
            return redirect()->route('seller.dashboard');
        }
        if ($user->type === 'user') {
            return redirect()->route('profile.edit');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    Route::get('profile/first', [ProfileController::class, 'edit'])->name('profile.first');
    Route::get('profile/{type}/{setup}', [ProfileController::class, 'typeProfile'])->name('type.profile');
    Route::post('profile/{type}/{setup}', [ProfileController::class, 'typeSellerProfile'])->name('save.seller.profile');
    Route::get('/profile/maintainance', [ProfileController::class, 'blockedlist'])->name('profile.blockedlist');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile-update', [ProfileController::class, 'profileUpdateDashboard'])->name('profile.update.dashboard');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | user Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')->name('user.')->group(function () {
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
    | Seller Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('seller')->prefix('seller')->name('seller.')->group(function () {
        Route::get('dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
        Route::get('affiliate', [SellerController::class, 'affiliate'])->name('affiliate');
        Route::get('settings', [SellerController::class, 'settings'])->name('settings');
        Route::put('settings', [SellerController::class, 'settingsUpdate'])->name('settings.update');
        Route::get('billing', [SellerController::class, 'billing'])->name('billing');
        Route::post('billing/{lead}/pay', [SellerController::class, 'payLead'])->name('billing.pay');
        Route::get('schedule', [SellerController::class, 'schedule'])->name('schedule');
        Route::post('schedule', [SellerController::class, 'scheduleUpdate'])->name('schedule.update');
        Route::get('reviews', [SellerController::class, 'reviews'])->name('reviews');
        Route::post('reviews/{id}/reply', [SellerController::class, 'reviewReply'])->name('reviews.reply');
        Route::get('notifications', [SellerController::class, 'notifications'])->name('notifications');
        Route::post('notifications/read-all', [SellerController::class, 'notificationsReadAll'])->name('notifications.read-all');
        Route::get('leads/{id}', [SellerController::class, 'leadDetail'])->name('lead.detail');
        Route::post('leads/{id}/status', [SellerController::class, 'leadStatus'])->name('lead.status');
        Route::post('leads/{id}/notes', [SellerController::class, 'leadNotes'])->name('lead.notes');
    });

    /*
    |--------------------------------------------------------------------------
    | Buyer Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('buyer')->name('buyer.')->group(function () {
        Route::get('dashboard', [BuyerController::class, 'dashboard'])->name('dashboard');
        Route::get('bookings', [BuyerController::class, 'bookings'])->name('bookings');
        Route::post('bookings/{id}/cancel', [BuyerController::class, 'cancelBooking'])->name('bookings.cancel');
        Route::get('book/{seller}', [BuyerController::class, 'book'])->name('book');
        Route::post('book', [BuyerController::class, 'bookStore'])->name('book.store');
        Route::get('review/{booking}', [BuyerController::class, 'review'])->name('review');
        Route::post('review/{booking}', [BuyerController::class, 'reviewStore'])->name('review.store');
        Route::get('profile', [BuyerController::class, 'profile'])->name('profile');
        Route::put('profile', [BuyerController::class, 'profileUpdate'])->name('profile.update');
        Route::delete('profile', [BuyerController::class, 'profileDestroy'])->name('profile.destroy');
        Route::get('booking/{id}/confirmation', [BuyerController::class, 'bookingConfirmation'])->name('booking.confirmation');
        Route::get('notifications', [BuyerController::class, 'notifications'])->name('notifications');
        Route::post('notifications/read-all', [BuyerController::class, 'notificationsReadAll'])->name('notifications.read-all');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [PageController::class, 'admin_dashboard'])->name('dashboard');
        Route::prefix('profiles')->name('profiles.')->group(function () {
            Route::get('index', [PageController::class, 'profiles_index'])->name('index');
            Route::get('edit/{id}', [PageController::class, 'profiles_edit'])->name('edit');
            Route::put('update/{id}', [PageController::class, 'profiles_update'])->name('update');
            Route::delete('destroy/{id}', [PageController::class, 'profiles_destroy'])->name('destroy');
        });

        Route::get('clear-cache', [PageController::class, 'clear_cache'])->name('clear.cache');
        Route::get('leads', [PageController::class, 'leads'])->name('leads');
        Route::post('leads/{id}/status', [PageController::class, 'leadUpdateStatus'])->name('leads.status');
        Route::post('leads/{id}/pay', [PageController::class, 'leadMarkPaid'])->name('leads.pay');
        Route::delete('leads/{id}', [PageController::class, 'leadDestroy'])->name('leads.destroy');

        Route::get('affiliate', [PageController::class, 'affiliate'])->name('affiliate');
        Route::post('affiliate/commission/{id}/pay', [PageController::class, 'affiliateCommissionPay'])->name('affiliate.commission.pay');
        Route::post('affiliate/commission/create', [PageController::class, 'affiliateCommissionCreate'])->name('affiliate.commission.create');
        Route::delete('affiliate/commission/{id}', [PageController::class, 'affiliateCommissionDestroy'])->name('affiliate.commission.destroy');

        Route::get('hierarchy', [PageController::class, 'hierarchy'])->name('hierarchy');
        Route::get('hierarchy/parents', [PageController::class, 'hierarchyParents'])->name('hierarchy.parents');
        Route::post('hierarchy', [PageController::class, 'hierarchyStore'])->name('hierarchy.store');
        Route::put('hierarchy/{id}', [PageController::class, 'hierarchyUpdate'])->name('hierarchy.update');
        Route::delete('hierarchy/{id}', [PageController::class, 'hierarchyDestroy'])->name('hierarchy.destroy');
        Route::post('hierarchy/{id}/status', [PageController::class, 'hierarchyStatusToggle'])->name('hierarchy.status');

        Route::get('locations', [PageController::class, 'locations'])->name('locations');
        Route::resource('countries', CountryController::class);
        Route::resource('countries.states', StateController::class);
        Route::resource('states.cities', CityController::class);
        Route::resource('cities.postal-codes', PostalCodeController::class);

        // Blog management
        Route::resource('blogs', BlogController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('services', ServiceController::class);
    });

});

require __DIR__ . '/auth.php';
