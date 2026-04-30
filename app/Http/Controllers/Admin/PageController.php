<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateCommission;
use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Lead;
use App\Models\PostalCode;
use App\Models\State;
use App\Models\StaffProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PageController extends Controller
{
    function admin_dashboard()
    {
        // Users
        $sellers    = User::where('type', 'seller')->count();
        $buyers     = User::where('type', 'user')->count();
        $unverified = User::where('type', 'seller')->where('status', false)->count();
        $staffCount = StaffProfile::count();

        // Leads
        $totalLeads   = Lead::count();
        $newLeads     = Lead::where('status', 'new')->count();
        $wonLeads     = Lead::where('status', 'won')->count();
        $revenue      = Lead::paid()->sum('fee');
        $pendingRev   = Lead::unpaid()->sum('fee');

        // Affiliate
        $pendingComm  = AffiliateCommission::pending()->sum('amount');
        $paidComm     = AffiliateCommission::paid()->sum('amount');

        $blogCount    = Blog::count();
        $catCount     = Category::count();
        $cityCount    = City::count();

        // Monthly lead counts for chart (last 6 months)
        $leadMonths = [];
        $leadCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $leadMonths[] = $month->format('M');
            $leadCounts[] = Lead::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // User registration last 6 months
        $userMonths = [];
        $userCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $userMonths[] = $month->format('M');
            $userCounts[] = User::whereIn('type', ['seller','user'])
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        $recentSellers    = User::where('type', 'seller')->latest()->take(5)->get();
        $pendingVerify    = User::where('type', 'seller')->where('status', false)->latest()->take(5)->get();
        $recentLeads      = Lead::with('seller:id,name')->latest()->take(5)->get();
        $recentCommissions= AffiliateCommission::with('referrer:id,name')->latest()->take(5)->get();

        // Lead status breakdown for doughnut
        $leadStatusData = [
            'new'     => Lead::where('status','new')->count(),
            'pending' => Lead::where('status','pending')->count(),
            'won'     => Lead::where('status','won')->count(),
            'lost'    => Lead::where('status','lost')->count(),
        ];

        return view('admin.index2', compact(
            'sellers', 'buyers', 'unverified', 'staffCount',
            'totalLeads', 'newLeads', 'wonLeads', 'revenue', 'pendingRev',
            'pendingComm', 'paidComm', 'blogCount', 'catCount', 'cityCount',
            'leadMonths', 'leadCounts', 'userMonths', 'userCounts',
            'recentSellers', 'pendingVerify', 'recentLeads', 'recentCommissions',
            'leadStatusData'
        ));
    }
    public function profiles_index(Request $request)
    {
        $status = $request->query('status'); // 'verified', 'unverified', or null
        $type = $request->query('type');     // 'admin', 'profile', 'staff', or null

        $query = User::latest();

        if ($status === 'verified') {
            $query->where('status', true);
        } elseif ($status === 'unverified') {
            $query->where('status', false);
        }

        if ($type && $type !== 'all') {
            $query->where('type', $type);
        }

        $users = $query->get();

        return view('admin.profiles2.index', compact('users', 'status', 'type'));
    }
    function profiles_edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profiles2.edit', compact('user'));
    }
    public function profiles_update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|unique:users,email,'.$id,
            'phone'               => 'nullable|string|max:50',
            'whatsapp'            => 'nullable|string|max:50',
            'designation'         => 'nullable|string|max:255',
            'title'               => 'nullable|string|max:255',
            'type'                => 'required|in:admin,staff,manager,seller,user',
            'status'              => 'required|boolean',
            'remark'              => 'nullable|string',
            'bio'                 => 'nullable|string',
            'about'               => 'nullable|string',
            'work_address'        => 'nullable|string|max:500',
            'business_name'       => 'nullable|string|max:255',
            'seller_service_type' => 'nullable|string|max:255',
            'experience'          => 'nullable|string|max:255',
            'city'                => 'nullable|string|max:255',
            'state'               => 'nullable|string|max:255',
            'country'             => 'nullable|string|max:255',
            'zip_code'            => 'nullable|string|max:20',
            'tags'                => 'nullable|string',
            'category_id'         => 'nullable|exists:categories,id',
            'twilio_enabled'      => 'nullable|boolean',
        ]);

        $validated['twilio_enabled'] = $request->boolean('twilio_enabled');
        $user->update($validated);

        return redirect()
            ->route('admin.profiles.index', ['status' => $user->status ? 'verified' : 'unverified'])
            ->with('success', 'Profile updated successfully.');
    }
    function profiles_destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.profiles.index')->with('success', 'User deleted.');
    }
    public function leads()
    {
        $stats = [
            'total'    => Lead::count(),
            'new'      => Lead::where('status', 'new')->count(),
            'won'      => Lead::where('status', 'won')->count(),
            'lost'     => Lead::where('status', 'lost')->count(),
            'paid'     => Lead::paid()->count(),
            'unpaid'   => Lead::unpaid()->count(),
            'revenue'  => Lead::paid()->sum('fee'),
            'pending_revenue' => Lead::unpaid()->sum('fee'),
        ];
        $status = request('status');
        $leads = Lead::with('seller:id,name,profile_photo,slug')
            ->when($status, fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(25);
        return view('admin.leads.index', compact('stats', 'leads'));
    }

    public function leadUpdateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:new,pending,won,lost']);
        Lead::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Lead status updated.');
    }

    public function leadMarkPaid($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update(['paid_at' => $lead->paid_at ? null : now()]);
        return back()->with('success', $lead->paid_at ? 'Lead marked as paid.' : 'Lead marked as unpaid.');
    }

    public function leadDestroy($id)
    {
        Lead::findOrFail($id)->delete();
        return back()->with('success', 'Lead deleted.');
    }

    public function affiliate()
    {
        $stats = [
            'total_referrers'   => User::where('type', 'seller')->whereHas('referrals')->count(),
            'total_referrals'   => User::whereNotNull('referred_by')->count(),
            'pending_amount'    => AffiliateCommission::pending()->sum('amount'),
            'paid_amount'       => AffiliateCommission::paid()->sum('amount'),
            'pending_count'     => AffiliateCommission::pending()->count(),
            'paid_count'        => AffiliateCommission::paid()->count(),
        ];

        $filter = request('filter');
        $commissions = AffiliateCommission::with([
                'referrer:id,name,email,slug,profile_photo',
                'referredUser:id,name,email,slug,status,created_at',
            ])
            ->when($filter === 'pending', fn($q) => $q->pending())
            ->when($filter === 'paid',    fn($q) => $q->paid())
            ->latest()
            ->paginate(25);

        $topReferrers = User::where('type', 'seller')
            ->withCount('referrals')
            ->withSum(['commissionsEarned as earned_total' => function($q){ $q->where('status','paid'); }], 'amount')
            ->withSum(['commissionsEarned as pending_total' => function($q){ $q->where('status','pending'); }], 'amount')
            ->having('referrals_count', '>', 0)
            ->orderByDesc('referrals_count')
            ->get();

        return view('admin.affiliate.index', compact('stats', 'commissions', 'topReferrers'));
    }

    public function affiliateCommissionPay($id)
    {
        $commission = AffiliateCommission::findOrFail($id);
        $commission->update(['status' => 'paid', 'paid_at' => now()]);
        return back()->with('success', 'Commission marked as paid.');
    }

    public function affiliateCommissionCreate(Request $request)
    {
        $request->validate([
            'referrer_id'      => 'required|exists:users,id',
            'referred_user_id' => 'required|exists:users,id',
            'amount'           => 'required|numeric|min:0',
        ]);
        AffiliateCommission::create($request->only('referrer_id', 'referred_user_id', 'amount'));
        return back()->with('success', 'Commission created.');
    }

    public function affiliateCommissionDestroy($id)
    {
        AffiliateCommission::findOrFail($id)->delete();
        return back()->with('success', 'Commission deleted.');
    }

    public function locations(Request $request)
    {
        $tab = $request->query('tab', 'countries');

        $countries = Country::withCount('states')->orderBy('title')->get();
        $states    = State::with('country')->withCount('cities')->orderBy('title')->get();
        $cities    = City::with('state')->withCount('postalCodes')->orderBy('title')->get();
        $zips      = PostalCode::with('city')->orderBy('title')->get();

        $stats = [
            'countries' => $countries->count(),
            'states'    => $states->count(),
            'cities'    => $cities->count(),
            'zips'      => $zips->count(),
        ];

        return view('admin.locations.index', compact('tab', 'countries', 'states', 'cities', 'zips', 'stats'));
    }

    public function clear_cache()
    {
        Artisan::call('optimize:clear');
        return back()->with('success', 'All cache cleared successfully.');
    }

    public function hierarchy(Request $request)
    {
        $role = $request->query('role', 'area_manager');

        $counts = [];
        foreach (array_keys(StaffProfile::ROLES) as $r) {
            $counts[$r] = StaffProfile::where('role', $r)->count();
        }

        $staff = StaffProfile::with(['user', 'parent.user'])
            ->where('role', $role)
            ->latest()
            ->get();

        // For parent select in modals: managers one level up
        $parentRole = StaffProfile::ROLE_REPORTS_TO[$role] ?? null;
        $potentialParents = $parentRole
            ? StaffProfile::with('user')->where('role', $parentRole)->where('status', 'active')->get()
            : collect();

        // All users that don't yet have a staff profile (for assign-user select)
        $availableUsers = User::whereNotIn('id', StaffProfile::pluck('user_id'))
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        $totalRevenue = StaffProfile::sum('revenue_generated');
        $totalActive  = StaffProfile::where('status', 'active')->count();

        return view('admin.hierarchy.index', compact(
            'role', 'counts', 'staff', 'potentialParents', 'availableUsers', 'totalRevenue', 'totalActive'
        ));
    }

    public function hierarchyParents(Request $request)
    {
        $role = $request->query('role');
        $managers = StaffProfile::with('user')
            ->where('role', $role)
            ->where('status', 'active')
            ->get()
            ->map(fn($p) => [
                'id'            => $p->id,
                'user_name'     => $p->user?->name ?? '—',
                'assigned_area' => $p->assigned_area,
                'assigned_state'=> $p->assigned_state,
            ]);
        return response()->json($managers);
    }

    public function hierarchyStore(Request $request)
    {
        $request->validate([
            'user_id'         => 'required|exists:users,id|unique:staff_profiles,user_id',
            'role'            => 'required|in:area_manager,city_manager,district_manager,country_manager',
            'assigned_area'   => 'nullable|string|max:255',
            'assigned_state'  => 'nullable|string|max:255',
            'parent_id'       => 'nullable|exists:staff_profiles,id',
            'base_salary'     => 'nullable|numeric|min:0',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'joined_at'       => 'nullable|date',
            'notes'           => 'nullable|string',
        ]);

        StaffProfile::create($request->only([
            'user_id', 'role', 'assigned_area', 'assigned_state',
            'parent_id', 'base_salary', 'commission_rate', 'joined_at', 'notes',
        ]));

        User::find($request->user_id)?->update(['type' => 'staff']);

        return back()->with('success', 'Staff member added.');
    }

    public function hierarchyUpdate(Request $request, $id)
    {
        $profile = StaffProfile::findOrFail($id);

        $request->validate([
            'assigned_area'   => 'nullable|string|max:255',
            'assigned_state'  => 'nullable|string|max:255',
            'parent_id'       => 'nullable|exists:staff_profiles,id',
            'base_salary'     => 'nullable|numeric|min:0',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'joined_at'       => 'nullable|date',
            'notes'           => 'nullable|string',
            'sellers_onboarded' => 'nullable|integer|min:0',
            'active_sellers'  => 'nullable|integer|min:0',
            'dispute_rate'    => 'nullable|numeric|min:0|max:100',
            'revenue_generated' => 'nullable|numeric|min:0',
        ]);

        $profile->update($request->only([
            'assigned_area', 'assigned_state', 'parent_id',
            'base_salary', 'commission_rate', 'joined_at', 'notes',
            'sellers_onboarded', 'active_sellers', 'dispute_rate', 'revenue_generated',
        ]));

        return back()->with('success', 'Staff profile updated.');
    }

    public function hierarchyDestroy($id)
    {
        $profile = StaffProfile::findOrFail($id);
        $userId  = $profile->user_id;
        $profile->delete();
        User::find($userId)?->update(['type' => 'seller']);
        return back()->with('success', 'Staff member removed.');
    }

    public function hierarchyStatusToggle($id)
    {
        $profile = StaffProfile::findOrFail($id);
        $next    = match ($profile->status) {
            'active'    => 'inactive',
            'inactive'  => 'active',
            'probation' => 'active',
            default     => 'active',
        };
        $profile->update(['status' => $next]);
        return back()->with('success', 'Status updated to ' . $next . '.');
    }
}
