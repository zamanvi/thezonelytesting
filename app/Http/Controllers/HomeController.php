<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Lead;
use App\Models\User;
use App\Models\AffiliateCommission;
use App\Services\Sms\SmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
    function user_register_category()
    {
        $categories = Category::where('is_active', true)->whereNull('parent_id')->with('children')->get();
        return view('frontend.auth.register_category', compact('categories'));
    }

    function user_save_category(Request $request)
    {
        $categoryId = ($request->category_id && $request->category_id !== 'other')
            ? (int) $request->category_id
            : null;

        auth()->user()->update(['category_id' => $categoryId]);

        return redirect()->route('seller.onboarding')->with('success', 'Category saved! Now complete your business profile.');
    }

    function user_register2($type)
    {
        $categories = Category::where('is_active', true)->whereNull('parent_id')->get();
        return view('frontend.auth.register', compact('type', 'categories'));
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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'type'     => ['required', 'in:seller,user'],
        ]);

        $referrer = null;
        if ($request->filled('ref')) {
            $referrer = User::where('slug', $request->ref)
                ->orWhere('id', $request->ref)
                ->first();
        }

        $user = User::create([
            'name'          => $validated['name'],
            'email'         => $validated['email'],
            'phone'         => $request->phone ?? null,
            'type'          => $validated['type'],
            'business_name' => $request->business_name ?? '',
            'password'      => Hash::make($validated['password']),
            'slug'          => generateUniqueSlug(User::class, $validated['name']),
            'referred_by'   => $referrer?->id,
        ]);
        Auth::login($user);
        if ($user->type === 'user') {
            return redirect()->route('buyer.dashboard')->with('success', 'Welcome to Zonely! Find local experts near you.');
        }
        if ($user->type === 'seller') {
            return redirect()->route('user.register.category')->with('success', 'Account created! Now select your business category.');
        }
        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome, ' . $user->name);
    }
    function home()
    {
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        $users = User::activeSellers()->with('reviews')->latest()->take(8)->get();
        $stats = [
            'pros'   => User::activeSellers()->count(),
            'cities' => User::activeSellers()->whereNotNull('city')->distinct('city')->count('city'),
            'reviews'=> \App\Models\Review::count(),
        ];
        $categories = Category::where('is_active', true)->whereNull('parent_id')->withCount('children')->take(8)->get();
        $featuredReviews = \App\Models\Review::with('reviewer:id,name,profile_photo', 'seller:id,name,slug,title,designation')
            ->where('rating', '>=', 4)
            ->latest()
            ->take(6)
            ->get();
        return view('frontend.home', compact('users', 'meta_title', 'meta_description', 'meta_keywords', 'stats', 'categories', 'featuredReviews'));
    }
    function service_all()
    {
        $users = User::activeSellers()->latest()->paginate(12);
        $isSearch = false;
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.service_all', compact('users', 'isSearch', 'meta_title', 'meta_description', 'meta_keywords'));
    }
    function service_search(Request $request)
    {
        $query = $request->input('q');
        $city  = $request->input('city');
        $users = User::activeSellers()
            ->when($city, fn($q) => $q->where(function($q) use ($city) {
                $q->where('city', 'like', '%' . $city . '%')
                  ->orWhere('state', 'like', '%' . $city . '%')
                  ->orWhere('zip_code', 'like', '%' . $city . '%');
            }))
            ->when($query, fn($q) => $q->where(function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%')
                    ->orWhere('designation', 'like', '%' . $query . '%')
                    ->orWhere('work_address', 'like', '%' . $query . '%')
                    ->orWhere('about', 'like', '%' . $query . '%')
                    ->orWhere('tags', 'like', '%' . $query . '%')
                    ->orWhere('remark', 'like', '%' . $query . '%');
            }))
            ->paginate(12)
            ->appends(['q' => $query, 'city' => $city]);
        $isSearch = true;
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.service_all', compact('users', 'isSearch', 'query', 'city', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    function category_show($slug)
    {
        $category = Category::where('slug', $slug)->with('children')->firstOrFail();
        $categoryIds = $category->children->pluck('id')->prepend($category->id);
        $users = User::activeSellers()
            ->whereIn('category_id', $categoryIds)
            ->latest()
            ->paginate(12);
        $meta_title = $category->name . ' — Zonely';
        $meta_description = 'Find trusted local ' . $category->name . ' experts near you with Zonely.';
        $meta_keywords = $category->name . ' near me;';
        return view('frontend.service_all', compact('users', 'category', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    function service_show($slug)
    {
        $user = User::activeSellers()->where('slug', $slug)
            ->with(['contacts','languages','educations','certifications','experiences','memberships','services.category','reviews.reviewer','category','twilioNumber','faqs'])
            ->firstOrFail();
        $view = $user->seller_service_type === 'professional'
            ? 'frontend.service_details_professional'
            : 'frontend.service_details';
        return view($view, compact('user'));
    }

    function shareCard($slug)
    {
        $user = User::activeSellers()->where('slug', $slug)
            ->with(['services', 'category'])
            ->firstOrFail();
        return view('frontend.share_card', compact('user'));
    }

    function ogImage($slug)
    {
        $user = User::activeSellers()
            ->where('slug', $slug)
            ->with(['services', 'category', 'reviews'])
            ->firstOrFail();

        $W = 1200; $H = 630;
        $img = imagecreatetruecolor($W, $H);

        // Colors
        $cBg     = imagecolorallocate($img, 10,  17,  35);
        $cTeal   = imagecolorallocate($img, 15,  118, 110); // teal-700 #0F766E
        $cWhite  = imagecolorallocate($img, 255, 255, 255);
        $cSlate4 = imagecolorallocate($img, 148, 163, 184);
        $cSlate5 = imagecolorallocate($img, 100, 116, 139);
        $cEmerald= imagecolorallocate($img, 16,  185, 129);
        $cAmber  = imagecolorallocate($img, 245, 158, 11);

        // Background
        imagefilledrectangle($img, 0, 0, $W, $H, $cBg);

        // Subtle top-right teal glow
        for ($r = 280; $r >= 0; $r -= 2) {
            $a = (int)(127 - ($r / 280) * 100);
            $c = imagecolorallocatealpha($img, 15, 118, 110, $a);
            imagefilledellipse($img, $W, 0, $r * 2, $r * 2, $c);
        }

        // Teal left accent bar
        imagefilledrectangle($img, 0, 0, 6, $H, $cTeal);

        // --- PHOTO (left 420px) ---
        $photoW = 420;
        $photoLoaded = false;

        if ($user->profile_photo) {
            // Try filesystem first, then URL fallback (handles Railway storage symlink issues)
            $path = public_path($user->profile_photo);
            $src  = false;
            if (file_exists($path)) {
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $src = match($ext) {
                    'jpg','jpeg' => @imagecreatefromjpeg($path),
                    'png'        => @imagecreatefrompng($path),
                    'webp'       => @imagecreatefromwebp($path),
                    default      => false,
                };
            }
            if (!$src) {
                $photoUrl  = url($user->profile_photo);
                $photoData = @file_get_contents($photoUrl);
                if ($photoData) $src = @imagecreatefromstring($photoData);
            }
            if ($src) {
                $sw = imagesx($src); $sh = imagesy($src);
                $targetRatio = $photoW / $H;
                $srcRatio    = $sw / $sh;
                if ($srcRatio > $targetRatio) {
                    $cropH = $sh; $cropW = (int)($sh * $targetRatio);
                    $srcX  = (int)(($sw - $cropW) / 2); $srcY = 0;
                } else {
                    $cropW = $sw; $cropH = (int)($sw / $targetRatio);
                    $srcX  = 0;   $srcY  = 0;
                }
                imagecopyresampled($img, $src, 0, 0, $srcX, $srcY, $photoW, $H, $cropW, $cropH);
                imagedestroy($src);
                $photoLoaded = true;
            }
        }

        if (!$photoLoaded) {
            imagefilledrectangle($img, 0, 0, $photoW, $H, $cTeal);
            $ini = strtoupper(substr($user->name, 0, 2));
            imagestring($img, 5, (int)($photoW/2 - 20), (int)($H/2 - 10), $ini, $cWhite);
        }

        // Photo → dark fade (right edge of photo)
        imagealphablending($img, true);
        for ($i = 0; $i <= 180; $i++) {
            $alpha = (int)(127 * ($i / 180));
            $c = imagecolorallocatealpha($img, 10, 17, 35, 127 - $alpha);
            imageline($img, $photoW - 180 + $i, 0, $photoW - 180 + $i, $H, $c);
        }

        // --- FONTS ---
        $fontPaths = [
            '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
            '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf',
            '/usr/share/fonts/truetype/freefont/FreeSansBold.ttf',
        ];
        $fontRegPaths = [
            '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
            '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf',
            '/usr/share/fonts/truetype/freefont/FreeSans.ttf',
        ];
        $fontB = collect($fontPaths)->first(fn($p) => file_exists($p));
        $fontR = collect($fontRegPaths)->first(fn($p) => file_exists($p));
        $ttf   = $fontB && $fontR;

        // --- RIGHT CONTENT ---
        $cx = 460; $cy = 72;

        // Brand
        if ($ttf) imagettftext($img, 13, 0, $cx, $cy, $cTeal, $fontB, 'ZONELY.');
        $cy += 58;

        // Name
        $name = $user->name;
        if ($ttf) {
            $bbox = imagettfbbox(36, 0, $fontB, $name);
            $fs   = abs($bbox[4] - $bbox[0]) > ($W - $cx - 40) ? 26 : 36;
            imagettftext($img, $fs, 0, $cx, $cy, $cWhite, $fontB, $name);
        }
        $cy += 48;

        // Verified badge
        if ($user->status && $ttf) {
            imagefilledrectangle($img, $cx, $cy - 18, $cx + 128, $cy + 7, $cEmerald);
            imagettftext($img, 11, 0, $cx + 10, $cy, $cWhite, $fontB, 'VERIFIED');
            $cy += 38;
        }

        // Specialty
        $specialty = Str::before($user->title ?? $user->designation ?? $user->category?->title ?? '', '|');
        $specialty = Str::limit(trim($specialty), 48);
        if ($ttf && $specialty) {
            imagettftext($img, 15, 0, $cx, $cy, $cSlate4, $fontR, $specialty);
            $cy += 34;
        }

        // Services (first 3)
        $cy += 6;
        foreach ($user->services->take(3) as $svc) {
            $t = Str::limit($svc->title ?? '', 40);
            if ($ttf && $t) {
                imagettftext($img, 12, 0, $cx, $cy, $cSlate5, $fontR, '– ' . $t);
                $cy += 24;
            }
        }
        $cy += 10;

        // Location
        if ($user->city && $ttf) {
            $loc = $user->city . ($user->state ? ', ' . $user->state : '');
            imagettftext($img, 13, 0, $cx, $cy, $cSlate4, $fontR, $loc);
            $cy += 30;
        }

        // Stars
        $rCount = $user->reviews->count();
        $rAvg   = $rCount ? round($user->reviews->avg('rating'), 1) : null;
        if ($ttf && $rAvg) {
            $stars = str_repeat('★', (int)round($rAvg)) . str_repeat('☆', 5 - (int)round($rAvg));
            imagettftext($img, 16, 0, $cx, $cy, $cAmber, $fontB, $stars . '  ' . $rAvg . ' (' . $rCount . ' reviews)');
        }

        // Domain
        $domain = parse_url(config('app.url'), PHP_URL_HOST) ?: 'zonely.app';
        if ($ttf) imagettftext($img, 11, 0, $cx, $H - 32, $cSlate5, $fontR, $domain);

        // Output
        header('Content-Type: image/png');
        header('Cache-Control: public, max-age=86400');
        imagepng($img, null, 6);
        imagedestroy($img);
        exit;
    }

    function serviceInquiry(Request $request, $slug)
    {
        $seller = User::activeSellers()->where('slug', $slug)->firstOrFail();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
        ]);

        $lead = Lead::create([
            'seller_id' => $seller->id,
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'service'   => $request->service ?? 'General Inquiry',
            'message'   => $request->message ?? null,
            'status'    => 'new',
            'fee'       => 68,
        ]);

        // Auto-create affiliate commission on seller's FIRST lead
        if ($seller->referred_by && $lead && $seller->leads()->count() === 1) {
            AffiliateCommission::firstOrCreate(
                ['referrer_id' => $seller->referred_by, 'referred_user_id' => $seller->id],
                ['amount' => 10, 'status' => 'pending']
            );
        }

        if ($seller->twilio_enabled && $seller->phone) {
            $msg = "🔔 New Zonely Lead!\n"
                 . "Name: {$lead->name}\n"
                 . "Phone: {$lead->phone}\n"
                 . "Service: {$lead->service}\n"
                 . ($lead->message ? "Message: " . Str::limit($lead->message, 80) . "\n" : '')
                 . "View: " . route('seller.dashboard');
            (new SmsService())->send($seller->phone, $msg);
        }

        return back()->with('inquiry_success', 'Your request has been sent! ' . $seller->name . ' will contact you shortly.');
    }

    function waClick(Request $request, $slug)
    {
        $seller = User::activeSellers()->where('slug', $slug)->firstOrFail();

        $waNumber = $seller->contacts()->where('type', 'whatsapp')->value('value')
            ?? $seller->whatsapp;

        $lead = Lead::create([
            'seller_id' => $seller->id,
            'name'      => 'WhatsApp Lead',
            'phone'     => '',
            'email'     => '',
            'service'   => 'WhatsApp Click',
            'message'   => 'Client clicked WhatsApp from Zonely profile.',
            'status'    => 'new',
            'fee'       => 68,
        ]);

        if ($seller->twilio_enabled && $seller->phone) {
            $msg = "💬 New WhatsApp Lead!\nClient clicked your WhatsApp button on Zonely.\nView: " . route('seller.dashboard');
            (new SmsService())->send($seller->phone, $msg);
        }

        $clean = preg_replace('/[^0-9]/', '', $waNumber ?? '');
        return response()->json(['url' => 'https://wa.me/' . $clean]);
    }

    function termsAgree()
    {
        if (auth()->user()?->agreed_terms_at) {
            return redirect()->route('dashboard');
        }
        return view('frontend.terms_agree');
    }

    function termsStore(Request $request)
    {
        $request->validate([
            'agree' => 'accepted',
        ]);

        auth()->user()->update(['agreed_terms_at' => now()]);

        return redirect()->route('dashboard')->with('success', 'Thank you for agreeing to our Terms & Conditions.');
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
        $featuredBlog = Blog::latest()->first();
        $blogs        = $this->sideBlogs($featuredBlog?->id);
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.blog', compact('featuredBlog', 'blogs', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    function blog_show($slug)
    {
        $blog  = Blog::where('slug', $slug)->firstOrFail();
        $blog->increment('pageview');
        $blogs = $this->sideBlogs($blog->id);
        $meta_title = 'Zonely - Discover & Hire Local Experts Near Me';
        $meta_description = 'Find trusted local experts near you with Zonely. Compare lawyers, consultants, and more professionals. Read reviews and contact verified pros instantly';
        $meta_keywords = 'Lawyers near me; Insurance agents near me; Consultants near me; Real estate agents near me; Local health professionals near me;';
        return view('frontend.blog_details', compact('blog', 'meta_title', 'meta_description', 'meta_keywords'));
    }

    private function sideBlogs(?int $excludeId)
    {
        return Blog::when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->latest()
            ->take(10)
            ->get();
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
