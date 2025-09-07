<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    protected $type;
    protected $model;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->type = getUserType();
            return $next($request);
        });
        $this->model = new Membership();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = $this->model->where('user_id', auth()->id())->paginate(10);
        return view('profile.memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.memberships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $membership = new Membership();
        $membership->user_id = auth()->id();
        $membership->name = $validated['name'];
        $membership->save();

        return redirect()->route('profile.memberships.index')->with('success', 'Membership added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $membership = $this->model->where('user_id', auth()->id())->findOrFail($id);
        return view('profile.memberships.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $membership = Membership::where('user_id', auth()->id())->findOrFail($id);
        $membership->update($validated);

        return redirect()->route('profile.memberships.index')->with('success', 'Membership updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $membership = Membership::where('user_id', auth()->id())->findOrFail($id);
        $membership->delete();

        return redirect()->route('profile.memberships.index')->with('success', 'Membership deleted successfully.');
    }
}
