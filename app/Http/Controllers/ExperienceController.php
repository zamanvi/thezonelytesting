<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Auth::user()->experiences()->get();
        return view('frontend.profile.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('frontend.profile.experiences.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'nullable|string|max:255',
            'start_date'  => 'nullable|string|max:20',
            'end_date'    => 'nullable|string|max:20',
            'is_current'  => 'nullable|boolean',
            'description' => 'nullable|string|max:1000',
        ]);
        $data['is_current'] = $request->boolean('is_current');
        if ($data['is_current']) {
            $data['end_date'] = null;
        }
        $data['user_id'] = Auth::id();
        Experience::create($data);
        return redirect()->route('user.experiences.index')->with('success', 'Experience added.');
    }

    public function edit($id)
    {
        $experience = Experience::where('user_id', Auth::id())->findOrFail($id);
        return view('frontend.profile.experiences.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::where('user_id', Auth::id())->findOrFail($id);
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'nullable|string|max:255',
            'start_date'  => 'nullable|string|max:20',
            'end_date'    => 'nullable|string|max:20',
            'is_current'  => 'nullable|boolean',
            'description' => 'nullable|string|max:1000',
        ]);
        $data['is_current'] = $request->boolean('is_current');
        if ($data['is_current']) {
            $data['end_date'] = null;
        }
        $experience->update($data);
        return redirect()->route('user.experiences.index')->with('success', 'Experience updated.');
    }

    public function destroy($id)
    {
        Experience::where('user_id', Auth::id())->findOrFail($id)->delete();
        return back()->with('success', 'Experience deleted.');
    }
}
