<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
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
    function user_register()
    {
        return view('frontend.auth.register');
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
            if ($user->type === 'vendor') {
                return redirect()->route('vendor.dashboard')->with('success', 'Welcome back, Vendor!');
            }
            dd($user->type);
            return redirect()->route('dashboard')->with('success', 'Welcome back, '.$user->name);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    function user_submit_register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type' => ['required', 'in:user,vendor'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'type' => $validated['type'],
            'password' => Hash::make($validated['password']),
        ]);
        Auth::login($user);
        if ($user->type === 'vendor') {
            return redirect()->route('vendor.profile.first')->with('success', 'Please complete your vendor profile.');
        }

        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome, ' . $user->name);
    }
    function home()
    {
        // $data = [
        //     'sub_title' => 'Tow Truck Near Me | Fast & Affordable Towing USA',
        //     'marque' => 'Tow Now offers reliable tow truck services near you. Affordable rates, 24/7 availability, and fast roadside assistance in the USA.',
        //     'que' => 'Need a tow truck near you?',
        //     'answer' => 'Tow Now is your trusted partner for 24/7 towing services across the USA. Whether you’re dealing with a breakdown, accident, or other roadside emergency, our professional team is here to help. With competitive pricing and fast response times, Tow Now ensures a stress-free towing experience.',
        //     'is_img' => false,
        //     'link' => asset('frontend/video/tow_truck_near_me.mp4'),
        //     'img2_link' => asset('frontend/img/tow-truck-near-me.jpg'),
        //     'description' => true,
        //     'page' => '00',
        // ];

        // return view('frontend.home', compact('data'));
        $blogs = Blog::latest()->paginate(20);
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.blog', compact('blogs', 'meta_title', 'meta_description', 'meta_keywords'));
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
    function blog()
    {
        $blogs = Blog::latest()->paginate(20);
        return view('frontend.blog', compact('blogs'));
    }
    function blog_show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->increment('pageview');
        return view('frontend.blog_details2', compact('blog'));
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
