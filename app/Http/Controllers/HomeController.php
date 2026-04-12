<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\PostalCode;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function user_login()
    {
        return view('frontend.auth.login');
    }
    function user_register1()
    {
        return view('frontend.auth.register1');
    }
    function user_register2($type)
    {
        $categories = Category::where('is_active', true)->whereNull('parent_id')->get();
        return view('frontend.auth.register', compact('type', 'categories'));
        // return view('frontend.auth.register', compact('type'));
    }
    function user_submit_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->filled('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->route('dashboard')->with('success', 'Welcome back, ' . $user->name);
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.',])->onlyInput('email');
    }
    function user_submit_register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        $type = $request->type;

        if ($type === 'buyer') {
            $type = 'user';
            $slug = Str::slug($validated['name']);
        }
        // Generate slug

        if ($request->has('category_id') && is_array($request->category_id)) {
            $category = Category::find(collect($request->category_id)->last());
            if ($category) {
                $slug = Str::slug($category->name);
            }
        }
        $countryName = '';
        $stateName = '';
        $cityName = '';
        $zipCodeName = '';
        if ($request->has('country') && !empty($request->country)) {
            $country = Country::find($request->country);
            $countryName = $country ? $country->name : '';
        }
        if ($request->has('state') && !empty($request->state)) {
            $state = State::find($request->state);
            $stateName = $state ? $state->name : '';
        }
        if ($request->has('zip_code') && !empty($request->zip_code)) {
            $zipCode = PostalCode::find($request->zip_code);
            $zipCodeName = $zipCode ? $zipCode->name : '';
        }
        if ($request->has('city') && !empty($request->city)) {
            $city = City::find($request->city);
            $cityName = $city ? $city->name : '';
            if ($city) {
                $slug .= '-' . $city->slug;
            }
        } 
        
        if ($request->has('business_name') && !empty($request->business_name)) {
            $slug .= '-' . Str::slug($request->business_name);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $request->phone ?? null,
            'whatsapp' => $request->whatsapp ?? null,
            'type' => $type ,
            'business_name' => $request->business_name ?? '',
            'password' => Hash::make($validated['password']),
            'slug' => $slug,
            'tags' => $request->tags,
            'category_id' => collect($request->category_id)->last() ?? null,
            'country' => $countryName,
            'state' => $stateName,
            'city' => $cityName,
            'zip_code' => $zipCodeName,
            'additional_details' => $request->additional_details ?? 'null',
            'bio' => $request->bio ?? '',
            'experience' => $request->experience ?? '',
        ]);
        Auth::login($user);
        if ($user->type === 'user') {
            return redirect()->route('frontend.home')->with('success', 'Please complete your profile.');
        }
        if ($user->type === 'seller') {
            return redirect()->route('profile.first')->with('success', 'Please complete your profile.');
        }
        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome, ' . $user->name);
    }
    function home()
    {
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        $users = User::where('type', 'seller')->where('status', true)->latest()->take(2)->get();
        return view('frontend.home', compact('users', 'meta_title', 'meta_description', 'meta_keywords'));
    }
    function service_all()
    {
        $users = User::where('type', 'seller')->where('status', true)->latest()->paginate(4);
        $isSearch = false;
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.service_all', compact('users', 'isSearch', 'meta_title', 'meta_description', 'meta_keywords'));
    }
    function service_search(Request $request)
    {
        $query = $request->input('q');
        $users = User::where('type', 'seller')
            ->where('status', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%')
                    ->orWhere('designation', 'like', '%' . $query . '%')
                    ->orWhere('work_address', 'like', '%' . $query . '%')
                    ->orWhere('about', 'like', '%' . $query . '%')
                    ->orWhere('remark', 'like', '%' . $query . '%');
            })
            ->orWhereHas('educations', function ($q) use ($query) {
                $q->where('degree', 'like', '%' . $query . '%')
                    ->orWhere('institution', 'like', '%' . $query . '%')
                    ->orWhere('passing_year', 'like', '%' . $query . '%');
            })
            ->orWhereHas('contacts', function ($q) use ($query) {
                $q->where('type', 'like', '%' . $query . '%')->orWhere('value', 'like', '%' . $query . '%');
            })
            ->orWhereHas('languages', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->orWhereHas('memberships', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->paginate(12)
            ->appends(['q' => $query]);
        $isSearch = true;
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.service_all', compact('users', 'isSearch', 'query', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    function service_show($slug)
    {
        $user = User::where('slug', $slug)->where('type', 'seller')->where('status', true)->firstOrFail();
        return view('frontend.service_details', compact('user'));
    }
    function search(Request $request)
    {
        $query = $request->input('q');
        $users = User::where('type', 'seller')
            ->where('status', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%')
                    ->orWhere('designation', 'like', '%' . $query . '%')
                    ->orWhere('work_address', 'like', '%' . $query . '%')
                    ->orWhere('about', 'like', '%' . $query . '%')
                    ->orWhere('remark', 'like', '%' . $query . '%');
            })
            ->orWhereHas('educations', function ($q) use ($query) {
                $q->where('degree', 'like', '%' . $query . '%')
                    ->orWhere('institution', 'like', '%' . $query . '%')
                    ->orWhere('passing_year', 'like', '%' . $query . '%');
            })
            ->orWhereHas('contacts', function ($q) use ($query) {
                $q->where('type', 'like', '%' . $query . '%')->orWhere('value', 'like', '%' . $query . '%');
            })
            ->orWhereHas('languages', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->orWhereHas('memberships', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->paginate(12)
            ->appends(['q' => $query]);
        $isSearch = true;
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.search', compact('users', 'query', 'meta_title', 'meta_description', 'meta_keywords'));
    }
    function service1()
    {
        $data = [
            'sub_title' => 'Fast Tow Trucks Near Me | Reliable Towing in the USA',
            'marque' => 'Looking for tow trucks near you? Tow Now provides fast, professional towing services across the USA at competitive prices. Call us now!',
            'que' => 'Searching for tow trucks near you?',
            'answer' => 'Tow Now delivers top-notch towing services 24/7 in every corner of the USA. From emergency roadside assistance to vehicle transport, we prioritize safety, reliability, and affordability. Call Tow Now today to get back on the road without hassle!',
            'is_img' => false,
            'link' => asset('frontend/video/tow_trucks_near_me.mp4'),
            'img2_link' => asset('frontend/img/tow_trucks_near_me2.jpg'),
            'description' => true,
            'page' => '01',
        ];

        return view('frontend.home', compact('data'));
    }
    function help()
    {
        return view('frontend.help');
    }
    function contact()
    {
        return view('frontend.contact');
    }
    function privacy_policy()
    {
        return view('frontend.privacy_policy');
    }
    function terms_and_condition()
    {
        return view('frontend.terms_and_condition');
    }
    function about_us()
    {
        return view('frontend.about_us');
    }
    function about_site_author()
    {
        return view('frontend.about_site_author');
    }
    function tools()
    {
        $meta_title = 'Free Car Insurance Calculator for NYC, USA';
        $meta_description = 'Use our Free Car Insurance Calculator for NYC, USA to instantly estimate your monthly and yearly auto insurance costs. Compare rates, save money, and get accurate results fast.';
        $meta_keywords = 'NYC Car Insurance Calculator; Free Auto Insurance Quote NYC; Compare Car Insurance Rates NYC; NYC Vehicle Insurance Estimator; Cheap Car Insurance NYC;';
        return view('frontend.tools', compact('meta_title', 'meta_description', 'meta_keywords'));
    }
    function blog()
    {
        // Get latest blog as featured
        $featuredBlog = Blog::latest()->first();

        // Get next 10 blogs excluding featured one
        $blogs = Blog::where('id', '!=', optional($featuredBlog)->id)
            ->latest()
            ->take(10)
            ->get();
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.blog', compact('featuredBlog', 'blogs', 'meta_title', 'meta_description', 'meta_keywords'));
    }
    function blog_show($slug)
    {
        $featuredBlog = Blog::where('slug', $slug)->firstOrFail();
        $featuredBlog->increment('pageview');

        $blogs = Blog::where('id', '!=', optional($featuredBlog)->id)
            ->latest()
            ->take(10)
            ->get(); 
        
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';

        return view('frontend.blog', compact('featuredBlog', 'blogs', 'meta_title', 'meta_description', 'meta_keywords'));
    }
    function sitemap()
    {
        $frontendRoutes = collect(Route::getRoutes())
            ->filter(function ($route) {
                return $route->getName() && str_starts_with($route->getName(), 'frontend.');
            })
            ->map(function ($route) {
                return [
                    'loc' => url($route->uri()),
                    'lastmod' => Carbon::now()->toAtomString(),
                ];
            });
        $blogs = Blog::select('slug', 'updated_at')
            ->get()
            ->map(function ($blog) {
                return [
                    'loc' => route('blog.show', $blog->slug),
                    'lastmod' => optional($blog->updated_at)->toAtomString() ?? Carbon::now()->toAtomString(),
                ];
            });
        $sitemapEntries = $frontendRoutes->merge($blogs);
        return response()->view('frontend.sitemap', compact('sitemapEntries'))->header('Content-Type', 'application/xml');
    }
}
