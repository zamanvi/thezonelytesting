<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PageController extends Controller
{
    function admin_dashboard()
    {
        return view('admin.index');
    }
    // function profiles_index(Request $request)
    // {
    //     $type = $request->query('type', 'unverified');
    //     $users = User::latest()->where('status', false)->get();
    //     return view('admin.profiles.index', compact('users', 'type'));
    // }
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

        return view('admin.profiles.index', compact('users', 'status', 'type'));
    }
    function profiles_edit($id)
    {
        $user = User::find($id);
        return view('admin.profiles.edit', compact('user'));
    }
    public function profiles_update(Request $request, $id)
    {
        // Find the user
        $user = User::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'title' => 'nullable|string',
            'remark' => 'required|string',
            'status' => 'required|boolean',
        ]);

        // Update the user
        $user->update($validated);

        // Determine redirect type
        $redirectType = $user->status ? 'verified' : 'unverified';

        // Redirect back with success message
        return redirect()
            ->route('admin.profiles.index', ['status' => $redirectType])
            ->with('success', 'Profile updated successfully.');
    }
    function profiles_destroy($id)
    {
        $users = User::latest()->where('status', false)->get();
        return view('admin.profiles.unverified', compact('users'));
    }
    public function clear_cache()
    {
        Artisan::call('optimize:clear');
        return back()->with('success', 'All cache cleared successfully.');
    }
}
