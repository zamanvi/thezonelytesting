<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    function blockedlist()
    {
        $user = Auth::user();
        return 'Dear Valuade Vendor, ' . $user->name . '. Your are Currently blocked, Please contact with your admin.';
    }
    function dashboard()
    {
        return view('vendor.index');
    }
    function profile()
    {
        $user = Auth::user();
        return view('vendor.profile.edit', compact('user'));
    }
    function profile_first()
    {
        $user = Auth::user();
        return view('vendor.profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // Validate input
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'shop_name' => ['nullable', 'string', 'max:255'],
        ]);

        // Fill and save
        $user->status = false;
        $user->fill($validatedData);
        $user->save();

        return redirect()->route('vendor.profile.first')->with('status', 'profile-updated');
    }
}
