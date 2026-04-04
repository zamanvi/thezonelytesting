<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected $type;
    protected $model;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->type = getUserType();
            return $next($request);
        });
        $this->model = new Language();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = $this->model->where('user_id', auth()->id())->paginate(10);
        return view('frontend.profile.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.profile.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language = new Language();
        $language->user_id = auth()->id();
        $language->name = $validated['name'];
        $language->save();

        return redirect()->route('user.languages.index')->with('success', 'Language added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $language = $this->model->where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.profile.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language = Language::where('user_id', auth()->id())->findOrFail($id);
        $language->update($validated);

        return back()->with('success', 'Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $language = Language::where('user_id', auth()->id())->findOrFail($id);
        $language->delete();

        return redirect()->route('user.languages.index')->with('success', 'Language deleted successfully.');
    }
}
