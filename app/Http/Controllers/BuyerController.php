<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $stats = [
            'bookings'  => 0,
            'completed' => 0,
            'reviews'   => 0,
        ];
        $upcomingBookings = collect();
        $pendingReviews   = collect();
        return view('frontend.buyer.dashboard', compact('stats', 'upcomingBookings', 'pendingReviews'));
    }

    public function bookings()
    {
        $bookings = collect();
        return view('frontend.buyer.bookings', compact('bookings'));
    }

    public function cancelBooking(Request $request, $id)
    {
        // Find booking by id, verify ownership, update status
        return response()->json(['success' => true]);
    }

    public function book(User $seller)
    {
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

        // Create booking record here
        // Booking::create([...]);

        return redirect()->route('buyer.bookings')->with('success', 'Booking confirmed!');
    }

    public function review($bookingId)
    {
        // $booking = Booking::where('id', $bookingId)->where('buyer_id', Auth::id())->firstOrFail();
        $booking = (object)[
            'id'       => $bookingId,
            'date'     => now(),
            'slot_time'=> '10:00 AM',
            'service'  => 'Service',
            'seller'   => (object)['id' => 0, 'name' => 'Professional'],
        ];
        return view('frontend.buyer.review', compact('booking'));
    }

    public function reviewStore(Request $request, $bookingId)
    {
        $data = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'review'  => 'required|string|min:10|max:1000',
            'tags'    => 'nullable|string',
        ]);

        // Review::create([...]);

        return redirect()->route('buyer.bookings')->with('success', 'Review submitted. Thank you!');
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
        // $booking = Booking::where('id', $id)->where('buyer_id', Auth::id())->firstOrFail();
        $booking = (object)[
            'id'       => $id,
            'date'     => now()->addDays(4),
            'slot_time'=> '10:00 AM',
            'service'  => 'Service',
            'seller'   => (object)['id' => 0, 'name' => 'Professional', 'phone' => null],
        ];
        return view('frontend.buyer.booking_confirmation', compact('booking'));
    }

    public function notifications()
    {
        return view('frontend.buyer.notifications', ['notifications' => collect()]);
    }

    public function notificationsReadAll()
    {
        // Auth::user()->notifications()->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    }
}
