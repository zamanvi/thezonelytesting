<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManagerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = User::where('type', 'manager')
            ->with('managerProfile')
            ->latest()
            ->paginate(20);

        return view('admin.managers.index', compact('managers'));
    }

    public function create()
    {
        $modules = ManagerProfile::MODULES;
        return view('admin.managers.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'modules'  => 'required|array|min:1',
            'modules.*'=> 'in:' . implode(',', array_keys(ManagerProfile::MODULES)),
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'type'     => 'manager',
            'status'   => true,
            'slug'     => generateUniqueSlug(User::class, $request->name),
        ]);

        ManagerProfile::create([
            'user_id' => $user->id,
            'modules' => $request->modules,
            'status'  => 'active',
            'notes'   => $request->notes,
        ]);

        return redirect()->route('admin.managers.index')
            ->with('success', $user->name . ' created with access to: ' . implode(', ', $request->modules));
    }

    public function edit($id)
    {
        $manager = User::where('type', 'manager')->with('managerProfile')->findOrFail($id);
        $modules = ManagerProfile::MODULES;
        return view('admin.managers.edit', compact('manager', 'modules'));
    }

    public function update(Request $request, $id)
    {
        $manager = User::where('type', 'manager')->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $manager->id,
            'modules'  => 'required|array|min:1',
            'modules.*'=> 'in:' . implode(',', array_keys(ManagerProfile::MODULES)),
        ]);

        $manager->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $manager->update(['password' => Hash::make($request->password)]);
        }

        $manager->managerProfile()->updateOrCreate(
            ['user_id' => $manager->id],
            [
                'modules' => $request->modules,
                'status'  => $request->status ?? 'active',
                'notes'   => $request->notes,
            ]
        );

        return redirect()->route('admin.managers.index')
            ->with('success', $manager->name . ' updated.');
    }

    public function destroy($id)
    {
        $manager = User::where('type', 'manager')->findOrFail($id);
        $manager->delete();
        return redirect()->route('admin.managers.index')
            ->with('success', 'Manager removed.');
    }
}
