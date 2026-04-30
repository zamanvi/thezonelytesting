<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::where('user_id', auth()->id())->paginate(10);
        return view('frontend.profile.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('frontend.profile.languages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Language::create(array_merge($validated, ['user_id' => auth()->id()]));

        return redirect()->route('user.languages.index')->with('success', 'Language added.');
    }

    public function edit($id)
    {
        $language = Language::where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.profile.languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Language::where('user_id', auth()->id())->findOrFail($id)->update($validated);

        return back()->with('success', 'Language updated.');
    }

    public function destroy($id)
    {
        Language::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->route('user.languages.index')->with('success', 'Language deleted.');
    }
}
