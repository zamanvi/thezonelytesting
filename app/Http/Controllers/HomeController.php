<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class HomeController extends Controller
{
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
    function service2()
    {
        $data = [
            'sub_title' => 'Affordable Tow Truck Company Near Me in USA | 24/7 Help',
            'marque' => 'Looking for a cheap tow truck company near you in the USA? Tow Now offers affordable, fast, and reliable towing services 24/7. Call now for immediate help!',
            'que' => 'Looking for a reliable tow truck company near you?',
            'answer' => 'Tow Now is the top choice for towing services across the USA. Whether it’s local towing, long-distance transport, or emergency assistance, our skilled team ensures your vehicle is handled with care. Choose Tow Now for efficient and affordable towing.',
            'is_img' => true,
            'link' => asset('frontend/img/tow_truck_company_near_me.jpg'),
            'img2_link' => asset('frontend/img/tow_truck_company_near_me2.jpg'),
            'description' => true,
            'page' => '02',
        ];

        return view('frontend.home', compact('data'));
    }
    function service3()
    {
        $data = [
            'sub_title' => 'Cheap Tow Truck Near Me in New York - Call Now',
            'marque' => 'Looking for a cheap tow truck in New York? Tow Now offers fast, reliable, and affordable towing services. Call now for immediate assistance, 24/7!',
            'que' => 'Need a cheap tow truck near you?',
            'answer' => 'Tow Now offers cost-effective towing solutions nationwide. Our affordable services come with professional care and reliability, ensuring your vehicle is safely towed. Call Tow Now today for budget-friendly and fast assistance across the USA.',
            'is_img' => true,
            'link' => asset('frontend/img/cheap_tow_truck_near_me.jpg'),
            'img2_link' => asset('frontend/img/cheap_tow_truck_near_me2.jpg'),
            'description' => true,
            'page' => '03',
        ];

        return view('frontend.home', compact('data'));
    }
    function service4()
    {
        $data = [
            'sub_title' => 'Tow Truck Service Near Me | 24/7 Help Across the USA',
            'marque' => 'Tow Now - offers reliable tow truck service near you, available 24/7 for roadside emergencies, breakdowns, accidents, flat tires, and more across the USA.',
            'que' => 'Searching for a dependable tow truck service near you?',
            'answer' => 'Tow Now provides 24/7 assistance across the USA for all your towing needs. Whether you need emergency roadside help, vehicle recovery, or scheduled towing, our professional team is here to assist. Choose Tow Now for prompt and affordable services anytime, anywhere.',
            'is_img' => true,
            'link' => asset('frontend/img/tow_truck_service_near_me.jpg'),
            'img2_link' => asset('frontend/img/tow_truck_service_near_me2.jpg'),
            'description' => true,
            'page' => '04',
        ];

        return view('frontend.home', compact('data'));
    }
    function service5()
    {
        $data = [
            'sub_title' => 'Best Tow Truck Companies Near Me | Trusted Service USA',
            'marque' => 'Tow Now stands out among tow truck companies near you, offering professional towing services nationwide with fast response times and affordable rates.',
            'que' => 'Need trusted tow truck companies near you?',
            'answer' => 'Tow Now provides reliable and professional towing services across the USA. Whether you’re stranded on the road or require scheduled vehicle transport, our team is here to help. Tow Now offers unmatched expertise, affordable rates, and 24/7 service.',
            'is_img' => true,
            'link' => asset('frontend/img/tow-truck-companies-near-me2.jpg'),
            'img2_link' => asset('frontend/img/tow-truck-companies-near-me2.jpg'),
            'description' => true,
            'page' => '05',
        ];

        return view('frontend.home', compact('data'));
    }
    function service6()
    {
        $data = [
            'sub_title' => 'Tow Truck Near Me | Florida’s Fastest - Tow Now-',
            'marque' => 'Looking for a reliable tow truck near you in Florida? Tow Now offers the fastest, most affordable towing services available 24/7. Call us for immediate assistance!',
            'que' => 'Tow Now is a leading tow truck company near you?',
            'answer' => 'Tow Now is a leading tow truck company near you, offering affordable, professional towing solutions nationwide. Our 24/7 availability ensures help is always at hand for emergencies, breakdowns, or vehicle transport. With Tow Now, you can expect fast, reliable service from experienced professionals.',
            'is_img' => true,
            'link' => asset('frontend/img/tow-truck-company-near-me2.webp'),
            'img2_link' => asset('frontend/img/tow-truck-company-near-me22.webp'),
            'description' => true,
            'page' => '06',
        ];
        return view('frontend.home', compact('data'));
    }
    function service7()
    {
        $data = [
            'sub_title' => 'Truck Towing Near Me | Fast & Affordable USA Service',
            'marque' => 'Tow Now specializes in truck towing near you. Affordable, professional, and available 24/7 to assist across the USA.',
            'que' => 'Searching for truck towing near you?',
            'answer' => 'Tow Now offers reliable and affordable towing for trucks of all sizes, anywhere in the USA. Our experienced team is available 24/7 to handle emergency towing or scheduled transport with safety and efficiency. Choose Tow Now for expert truck towing services nationwide.',
            'is_img' => true,
            'link' => asset('frontend/img/truck-towing-near-me.webp'),
            'img2_link' => asset('frontend/img/truck-towing-near-me2.webp'),
            'description' => true,
            'page' => '07',
        ];

        return view('frontend.home', compact('data'));
    }
    function service8()
    {
        $data = [
            'sub_title' => '$50 Tow Truck Near Me | Budget-Friendly USA Towing',
            'marque' => 'Find a $50 tow truck near you with Tow Now. Affordable towing solutions without sacrificing quality—available across the USA.',
            'que' => 'Searching for a $50 tow truck near you?',
            'answer' => 'Tow Now offers budget-friendly towing services across the USA, ensuring top-notch service without breaking the bank. Whether it’s an emergency or scheduled towing, our professional team is here to help. Call Tow Now for affordable towing solutions today!',
            'is_img' => true,
            'link' => asset('frontend/img/50-tow-truck-near-me.webp'),
            'img2_link' => asset('frontend/img/50-tow-truck-near-me2.webp'),
            'description' => true,
            'page' => '08',
        ];

        return view('frontend.home', compact('data'));
    }
    function service9()
    {
        $data = [
            'sub_title' => 'Tow Now: Tow Truck Near Me cheap Across USA',
            'marque' => 'Tow Now provides cheap tow truck services near you with unmatched quality. Affordable and reliable towing across all USA cities.',
            'que' => 'Looking for a cheap tow truck near you?',
            'answer' => 'Tow Now is your answer. We offer reliable and affordable towing services across the USA, ensuring your vehicle’s safety and prompt assistance. Choose Tow Now for budget-friendly towing solutions that don’t compromise on quality.',
            'is_img' => true,
            'link' => asset('frontend/img/tow-truck-near-me-cheap.webp'),
            'img2_link' => asset('frontend/img/tow-truck-near-me-cheap2.webp'),
            'description' => true,
            'page' => '09',
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
        $blogs = Blog::select('slug', 'updated_at')->get()->map(function ($blog) {
            return [
                'loc' => route('blog.show', $blog->slug),
                'lastmod' => optional($blog->updated_at)->toAtomString() ?? Carbon::now()->toAtomString(),
            ];
        });
        $sitemapEntries = $frontendRoutes->merge($blogs);
        return response()->view('frontend.sitemap', compact('sitemapEntries'))->header('Content-Type', 'application/xml');
    }
}
