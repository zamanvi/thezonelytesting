<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::where('user_id', auth()->id())->paginate(10);
        return view('frontend.profile.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('frontend.profile.educations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'degree'       => 'required|string|max:255',
            'institution'  => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Education::create(array_merge($validated, ['user_id' => auth()->id()]));

        return redirect()->route('user.educations.index')->with('success', 'Education added.');
    }

    public function show($id)
    {
        $education = Education::where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.profile.educations.show', compact('education'));
    }

    public function edit($id)
    {
        $education = Education::where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.profile.educations.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'degree'       => 'required|string|max:255',
            'institution'  => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Education::where('user_id', auth()->id())->findOrFail($id)->update($validated);

        return back()->with('success', 'Education updated.');
    }

    public function destroy($id)
    {
        Education::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->route('user.educations.index')->with('success', 'Education deleted.');
    }
}
