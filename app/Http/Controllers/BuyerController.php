<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Review;
use App\Models\User;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $myLeads = Lead::where('email', $user->email)
            ->with('seller')
            ->latest()
            ->get();

        $activeLeads    = $myLeads->whereIn('status', ['new', 'pending']);
        $resolvedLeads  = $myLeads->whereIn('status', ['won', 'lost', 'closed']);

        $stats = [
            'bookings'  => $myLeads->count(),
            'active'    => $activeLeads->count(),
            'resolved'  => $resolvedLeads->count(),
        ];

        $pendingReviews = collect();

        return view('frontend.buyer.dashboard', compact(
            'stats', 'pendingReviews', 'activeLeads', 'resolvedLeads'
        ));
    }

    public function bookings()
    {
        $bookings = collect();
        return view('frontend.buyer.bookings', compact('bookings'));
    }

    public function cancelBooking(Request $request, $id)
    {
        return response()->json(['success' => true]);
    }

    public function book(User $seller)
    {
        abort_unless($seller->type === 'seller' && $seller->status, 404);

        $schedule    = $seller->schedule ?? [
            'working_days' => ['mon', 'tue', 'wed', 'thu', 'fri'],
            'periods'      => [
                ['label' => 'Morning',   'from' => '09:00', 'to' => '12:00', 'duration' => 60],
                ['label' => 'Afternoon', 'from' => '13:00', 'to' => '17:00', 'duration' => 60],
            ],
        ];
        $bookedSlots = [];
        return view('frontend.buyer.book', compact('seller', 'schedule', 'bookedSlots'));
    }

    public function bookStore(Request $request)
    {
        $data = $request->validate([
            'seller_id'     => 'required|exists:users,id',
            'selected_date' => 'required|date',
            'selected_slot' => 'required|string',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:50',
            'email'         => 'nullable|email',
            'message'       => 'nullable|string|max:1000',
        ]);

        return redirect()->route('buyer.bookings')->with('success', 'Booking confirmed!');
    }

    public function review($sellerId)
    {
        $seller  = User::where('id', $sellerId)->where('type', 'seller')->firstOrFail();
        $booking = (object)[
            'id'       => $sellerId,
            'date'     => now(),
            'slot_time'=> null,
            'service'  => $seller->title ?? 'Service',
            'seller'   => $seller,
        ];
        return view('frontend.buyer.review', compact('booking'));
    }

    public function reviewStore(Request $request, $sellerId)
    {
        $seller = User::where('id', $sellerId)->where('type', 'seller')->firstOrFail();

        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'review'  => 'required|string|min:10|max:1000',
            'tags'    => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Prevent duplicate reviews
        Review::updateOrCreate(
            ['seller_id' => $seller->id, 'reviewer_id' => $user->id],
            [
                'reviewer_name' => $user->name,
                'rating'        => $data['rating'],
                'review'        => $data['review'],
                'tags'          => $data['tags'] ?? null,
            ]
        );

        return redirect()->route('frontend.service.show', $seller->slug)
            ->with('success', 'Review submitted. Thank you!');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.buyer.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'phone'         => 'nullable|string|max:50',
            'city'          => 'nullable|string|max:100',
            'state'         => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = ImageOptimizer::saveProfilePhoto($request->file('profile_photo'));
        }

        $user->update($data);

        if ($request->filled('password')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password'         => ['required', 'confirmed', 'min:8'],
            ]);
            $user->update(['password' => bcrypt($request->password)]);
        }

        return back()->with('success', 'Profile updated.');
    }

    public function profileDestroy(Request $request)
    {
        $request->validate(['password' => 'required']);
        $user = Auth::user();
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }
        Auth::logout();
        $user->delete();
        return redirect('/')->with('success', 'Account deleted.');
    }

    public function bookingConfirmation($id)
    {
        $booking = (object)[
            'id'       => $id,
            'date'     => now()->addDays(4),
            'slot_time'=> '10:00 AM',
            'service'  => 'Service',
            'seller'   => (object)['id' => 0, 'name' => 'Professional', 'phone' => null],
        ];
        return view('frontend.buyer.booking_confirmation', compact('booking'));
    }

    public function affiliate()
    {
        $user        = Auth::user();
        $commissions = $user->commissionsEarned()->with('referredUser')->latest()->get();

        $stats = [
            'referrals' => $user->referrals()->where('type', 'seller')->count(),
            'earned'    => $commissions->sum('amount'),
            'pending'   => $commissions->where('status', 'pending')->sum('amount'),
            'paid_out'  => $commissions->where('status', 'paid')->sum('amount'),
        ];

        return view('frontend.buyer.affiliate', compact('user', 'commissions', 'stats'));
    }

    public function notifications()
    {
        return view('frontend.buyer.notifications', ['notifications' => collect()]);
    }

    public function notificationsReadAll()
    {
        return response()->json(['success' => true]);
    }
}
