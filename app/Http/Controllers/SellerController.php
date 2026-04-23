<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function dashboard()
    {
        $user  = Auth::user();
        $leads = $user->leads()->latest()->get();

        $stats = [
            'total'   => $leads->count(),
            'won'     => $leads->where('status', 'won')->count(),
            'pending' => $leads->where('status', 'pending')->count(),
            'unpaid'  => $leads->whereNull('paid_at')->count(),
        ];

        return view('frontend.seller.dashboard', compact('user', 'leads', 'stats'));
    }

    public function affiliate()
    {
        $user        = Auth::user();
        $commissions = $user->commissionsEarned()->with('referredUser')->latest()->get();

        $stats = [
            'referrals' => $user->referrals()->count(),
            'earned'    => $commissions->sum('amount'),
            'pending'   => $commissions->where('status', 'pending')->sum('amount'),
            'paid_out'  => $commissions->where('status', 'paid')->sum('amount'),
        ];

        return view('frontend.seller.affiliate', compact('user', 'commissions', 'stats'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('frontend.seller.settings', compact('user'));
    }

    public function settingsUpdate(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'phone'         => 'nullable|string|max:50',
            'whatsapp'      => 'nullable|string|max:50',
            'title'         => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $data['profile_photo'] = 'storage/' . $path;
        }

        $user->update($data);

        if ($request->filled('password')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password'         => ['required', 'confirmed', 'min:8'],
            ]);
            $user->update(['password' => bcrypt($request->password)]);
        }

        return back()->with('success', 'Settings saved.');
    }

    public function billing()
    {
        $user        = Auth::user();
        $unpaidLeads = $user->leads()->whereNull('paid_at')->latest()->get();
        $paidLeads   = $user->leads()->whereNotNull('paid_at')->latest()->get();

        $now = now();
        $balance = [
            'unpaid'       => $unpaidLeads->sum('fee'),
            'unpaid_count' => $unpaidLeads->count(),
            'paid_month'   => $paidLeads->filter(fn($l) => $l->paid_at && $l->paid_at->month === $now->month && $l->paid_at->year === $now->year)->sum('fee'),
            'paid_count'   => $paidLeads->count(),
            'total_paid'   => $paidLeads->sum('fee'),
        ];

        return view('frontend.seller.billing', compact('unpaidLeads', 'paidLeads', 'balance'));
    }

    public function payLead(Request $request, $id)
    {
        $lead = Lead::where('id', $id)->where('seller_id', Auth::id())->firstOrFail();
        $lead->update(['paid_at' => now()]);
        return back()->with('success', 'Lead marked as paid.');
    }

    public function schedule()
    {
        $user     = Auth::user();
        $schedule = $user->schedule ?? null;
        return view('frontend.seller.schedule', compact('user', 'schedule'));
    }

    public function scheduleUpdate(Request $request)
    {
        $data = $request->validate([
            'working_days'     => 'nullable|array',
            'working_days.*'   => 'string',
            'periods'          => 'nullable|array',
            'periods.*.label'  => 'nullable|string|max:50',
            'periods.*.from'   => 'nullable|string',
            'periods.*.to'     => 'nullable|string',
            'periods.*.duration' => 'nullable|integer',
            'periods.*.buffer'   => 'nullable|integer',
            'max_per_day'      => 'nullable|integer',
            'advance_days'     => 'nullable|integer',
            'min_notice_hours' => 'nullable|integer',
            'booking_type'     => 'nullable|in:instant,manual',
        ]);

        Auth::user()->update(['schedule' => $data]);
        return back()->with('success', 'Schedule saved.');
    }

    public function reviews()
    {
        $user = Auth::user();
        return view('frontend.seller.reviews', [
            'reviews'         => collect(),
            'avgRating'       => 0,
            'totalReviews'    => 0,
            'ratingBreakdown' => [],
        ]);
    }

    public function reviewReply(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string|max:500']);
        return response()->json(['success' => true]);
    }

    public function notifications()
    {
        return view('frontend.seller.notifications', ['notifications' => collect()]);
    }

    public function notificationsReadAll()
    {
        return response()->json(['success' => true]);
    }

    public function leadDetail($id)
    {
        $lead = Lead::where('id', $id)->where('seller_id', Auth::id())->firstOrFail();
        return view('frontend.seller.lead_detail', compact('lead'));
    }

    public function leadStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:won,lost,pending,new']);
        Lead::where('id', $id)->where('seller_id', Auth::id())->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function leadNotes(Request $request, $id)
    {
        $request->validate(['notes' => 'nullable|string|max:1000']);
        Lead::where('id', $id)->where('seller_id', Auth::id())->update(['notes' => $request->notes]);
        return response()->json(['success' => true]);
    }
}
