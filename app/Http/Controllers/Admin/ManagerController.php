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
        $managers = User::whereIn('type', ['manager', 'coo'])
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
        $isGeneral = $request->role === 'general_manager';

        if ($isGeneral && auth()->user()?->type === 'coo') {
            abort(403, 'General Manager cannot create another General Manager.');
        }

        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'city'     => 'nullable|string|max:100',
            'state'    => 'nullable|string|max:100',
            'country'  => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
        ];

        if (!$isGeneral) {
            $rules['modules']   = 'required|array|min:1';
            $rules['modules.*'] = 'in:' . implode(',', array_keys(ManagerProfile::MODULES));
        }

        $request->validate($rules);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'type'     => $isGeneral ? 'coo' : 'manager',
            'status'   => true,
            'city'     => $request->city,
            'state'    => $request->state,
            'country'  => $request->country,
            'zip_code' => $request->zip_code,
            'slug'     => generateUniqueSlug(User::class, $request->name),
        ]);

        if (!$isGeneral) {
            ManagerProfile::create([
                'user_id' => $user->id,
                'modules' => $request->modules,
                'status'  => 'active',
                'notes'   => $request->notes,
            ]);
        } else {
            ManagerProfile::create([
                'user_id' => $user->id,
                'modules' => [],
                'status'  => 'active',
                'notes'   => $request->notes,
            ]);
        }

        $role = $isGeneral ? 'General Manager' : 'Manager';
        return redirect()->route('admin.managers.index')
            ->with('success', $user->name . ' created as ' . $role . '.')
            ->with('new_credentials', [
                'name'       => $user->name,
                'email'      => $user->email,
                'password'   => $request->password,
                'role'       => $role,
                'login_url'  => route('user.login'),
                'user_id'    => $user->id,
            ]);
    }

    public function edit($id)
    {
        if (auth()->user()?->type === 'coo') abort(403, 'COO cannot edit managers.');
        $manager = User::whereIn('type', ['manager', 'coo'])->with('managerProfile')->findOrFail($id);
        $modules = ManagerProfile::MODULES;
        return view('admin.managers.edit', compact('manager', 'modules'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()?->type === 'coo') abort(403, 'COO cannot edit managers.');
        $manager = User::whereIn('type', ['manager', 'coo'])->findOrFail($id);

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
        if (auth()->user()?->type === 'coo') abort(403, 'COO cannot remove managers.');
        $manager = User::whereIn('type', ['manager', 'coo'])->findOrFail($id);
        $manager->delete();
        return redirect()->route('admin.managers.index')
            ->with('success', 'Manager removed.');
    }
}
