<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard(Request $request): View
    {
        $user  = $request->user();
        $layout = $user->seller_service_type ? '__prof_app' : '__app';
        $_next  = $request->_next ?? 'business';
        return view('frontend.dashboard', compact('user', 'layout', '_next'));
    }

    public function profile(): View
    {
        $user = Auth::user();
        return view('frontend.profile.edit.index', compact('user'));
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        return view('frontend.profile.edit.index', compact('user'));
    }

    public function typeProfile(Request $request, $type, $setup)
    {
        $user       = auth()->user();
        $categories = [];
        $countries  = [];

        if ($setup === 'service_location') {
            $categories = Category::all();
            $countries  = Country::all();
        }

        $view = match ($setup) {
            'account'          => 'frontend.profile.edit.account',
            'service_location' => 'frontend.profile.edit.service_location',
            'contact'          => 'frontend.profile.edit.contact',
            'profile'          => 'frontend.profile.edit.profile',
            'review'           => 'frontend.profile.edit.review',
            default            => abort(404),
        };

        return view($view, compact('user', 'type', 'categories', 'countries'));
    }

    public function typeSellerProfile(Request $request, $type, $setup)
    {
        $user = auth()->user();

        if ($setup === 'account') {
            $request->validate([
                'name'          => 'required|string|max:255',
                'phone'         => 'nullable|string|max:50',
                'business_name' => 'nullable|string|max:255',
            ]);
            $user->update($request->only(['name', 'phone', 'business_name']));
            $next = 'service_location';

        } elseif ($setup === 'service_location') {
            $next = 'contact';

        } elseif ($setup === 'contact') {
            $request->validate([
                'phone'    => 'nullable|string|max:50',
                'whatsapp' => 'nullable|string|max:50',
            ]);
            $user->update([
                'phone'      => $request->phone,
                'whatsapp'   => $request->whatsapp,
                'show_phone' => $request->boolean('show_phone'),
            ]);
            $next = 'profile';

        } elseif ($setup === 'profile') {
            $request->validate([
                'bio'           => 'nullable|string|max:2000',
                'experience'    => 'nullable|string|max:255',
                'profile_photo' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('profile_photo')) {
                $path = $request->file('profile_photo')->store('uploads', 'public');
                $user->profile_photo = 'storage/' . $path;
            }

            $user->bio        = $request->bio;
            $user->experience = $request->experience;
            $user->save();
            $next = 'review';

        } elseif ($setup === 'review') {
            return redirect()->route('seller.dashboard')->with('success', 'Profile completed!');

        } else {
            abort(404);
        }

        return redirect()->route('type.profile', [$type, $next])->with('success', 'Saved.');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile information updated');
    }

    public function profileUpdateDashboard(Request $request)
    {
        $allowed = ['name', 'phone', 'whatsapp', 'bio', 'about', 'work_address',
                    'designation', 'business_name', 'seller_service_type', 'experience',
                    'country', 'state', 'city', 'zip_code', 'tags', 'show_phone'];

        $user = auth()->user();
        $user->update($request->only($allowed));

        $_next = $request->_next;
        return redirect()->route('user.dashboard', compact('_next'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function blockedlist()
    {
        $user = Auth::user();
        return 'Dear Valued Vendor, ' . $user->name . '. You are currently blocked. Please contact your admin.';
    }
}
