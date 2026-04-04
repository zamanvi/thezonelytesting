<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
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
        $this->model = new Education();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = $this->model->where('user_id', auth()->id())->paginate(10);
        return view('frontend.profile.educations.index', compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.profile.educations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        // Create and save education
        $education = new Education();
        $education->user_id = auth()->id();
        $education->degree = $validated['degree'];
        $education->institution = $validated['institution'];
        $education->passing_year = $validated['passing_year'];
        $education->save();

        return redirect()->route('user.educations.index')->with('success', 'Education added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $education = $this->model->where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.profile.educations.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'passing_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        // Find the education belonging to the logged-in user
        $education = Education::where('user_id', auth()->id())->findOrFail($id);

        // Update fields
        $education->update($validated);

        return back()->with('success', 'Education updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the education belonging to the logged-in user
        $education = Education::where('user_id', auth()->id())->findOrFail($id);
        $education->delete();
        return redirect()->route('user.educations.index')->with('success', 'Education deleted successfully.');
    }
}
