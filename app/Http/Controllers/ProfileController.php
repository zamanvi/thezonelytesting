<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard(Request $request): View
    {
        $user = $request->user();
        $layout = '__app';
        if ($user->seller_service_type === 'professional') {
            $layout = '__prof_app';
        }
        if ($user->seller_service_type === 'health') {
            $layout = '__health_app';
        }
        if ($user->seller_service_type === 'home') {
            $layout = '__home_app';
        }
        if ($user->seller_service_type === 'beauty') {
            $layout = '__beauty_app';
        }
        $_next = $request->_next ?? 'business';
        return view('frontend.dashboard', compact('user', 'layout', '_next'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        return view('frontend.profile.edit.index', ['user' => $user]);
    }
    public function typeProfile(Request $request, $type, $setup)
    {
        $user = auth()->user();

        // Pass categories if needed for service_location
        $categories = [];
        $countries = [];
        if ($setup === 'service_location') {
            $categories = Category::all(); // Adjust your model
            $countries = Country::all(); // Adjust your model
        }

        $view = match ($setup) {
            'account' => 'frontend.profile.edit.account',
            'service_location' => 'frontend.profile.edit.service_location',
            'contact' => 'frontend.profile.edit.contact',
            'profile' => 'frontend.profile.edit.profile',
            'review' => 'frontend.profile.edit.review',
            default => abort(404),
        };

        return view($view, compact('user', 'type', 'categories', 'countries'));
    }
    public function typeSellerProfile(Request $request, $type, $setup)
    {
        $user = User::find(auth()->id());

        // ======================
        // Save অনুযায়ী logic
        // ======================

        if ($setup === 'account') {
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'business_name' => $request->business_name,
            ]);

            $next = 'service_location';
        } elseif ($setup === 'service_location') {
            // save category + location
            $next = 'contact';
        } elseif ($setup === 'contact') {
            $user->update([
                'phone' => $request->phone,
                'whatsapp' => $request->whatsapp,
                'show_phone' => $request->has('show_phone'),
            ]);

            $next = 'profile';
        } elseif ($setup === 'profile') {

            // image upload
            if ($request->hasFile('profile_photo')) {
                $path = $request->file('profile_photo')->store('uploads', 'public');
                $user->profile_photo = $path;
            }

            $user->bio = $request->bio;
            $user->experience = $request->experience;
            $user->save();

            $next = 'review';
        } elseif ($setup === 'review') {
            // final step
            return redirect()->route('user.dashboard')->with('success', 'Profile completed!');
        }

        // ======================
        // Redirect to next step
        // ======================
        return redirect()->route('type.profile', [$type, $next])
            ->with('success', 'Saved successfully!');
    }

    /**
     * Update the user's profile information.
     */
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
        $user = User::find(auth()->id());
        $user->update($request->except(['_token', '_next']));
        $_next = $request->_next;
        return redirect()->route('user.dashboard', compact('_next'));
    }

    /**
     * Delete the user's account.
     */
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

    function blockedlist()
    {
        $user = Auth::user();
        return 'Dear Valuade Vendor, ' . $user->name . '. Your are Currently blocked, Please contact with your admin.';
    }
}
