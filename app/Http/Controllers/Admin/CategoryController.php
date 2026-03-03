<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.categories2.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.categories2.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255',
        ]);

        $slug = generateUniqueSlug(Category::class, $validated['slug'] ?? $validated['title']);

        Category::create([
            'title'     => $validated['title'],
            'slug'      => $slug,
        ]);
        return redirect()->route('admin.categories.index');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::latest()->paginate(20);
        return view('admin.categories2.show', compact('category', 'categories'));
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::latest()->paginate(20);
        return view('admin.categories2.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'nullable|string|max:255',
            'is_active'  => 'nullable|boolean',
        ]);

        // If slug is changed, regenerate unique slug
        $slug = generateUniqueSlug(
            Category::class,
            $validated['slug'] ?? $validated['title'],
            $category->id // exclude current record from uniqueness check
        );

        $is_active = $validated['is_active'] ? true : false;
        $category->update([
            'title' => $validated['title'],
            'slug'  => $slug,
            'is_active'  => $is_active,
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
