<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('user_id', Auth::id())->paginate(10);
        return view('frontend.profile.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('frontend.profile.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'price'       => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Service::create(array_merge($validated, ['user_id' => Auth::id()]));

        return redirect()->route('user.services.index')->with('success', 'Service added.');
    }

    public function show(string $id)
    {
        $service = Service::where('user_id', Auth::id())->findOrFail($id);
        return view('frontend.profile.services.show', compact('service'));
    }

    public function edit(string $id)
    {
        $service    = Service::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('frontend.profile.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'price'       => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Service::where('user_id', Auth::id())->findOrFail($id)->update($validated);

        return redirect()->route('user.services.index')->with('success', 'Service updated.');
    }

    public function destroy(string $id)
    {
        Service::where('user_id', Auth::id())->findOrFail($id)->delete();
        return redirect()->route('user.services.index')->with('success', 'Service deleted.');
    }
}
