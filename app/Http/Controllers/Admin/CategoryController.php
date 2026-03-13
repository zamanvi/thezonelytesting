<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $paginated = Category::whereNull('parent_id')->with('children')->paginate(20);
        $categories = flattenCategories($paginated->items());
        return view('admin.categories2.index', compact('categories', 'paginated'));
    }

    public function create()
    {
        $paginated = Category::whereNull('parent_id')->with('children')->paginate(20);
        $categories = flattenCategories($paginated->items());
        return view('admin.categories2.index', compact('categories', 'paginated'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'slug'      => 'nullable|string|max:255',
            'parent_id' => 'nullable',
        ]);

        // dd($validated);

        $slug = generateUniqueSlug(Category::class, $validated['slug'] ?? $validated['title']);

        Category::create([
            'title'     => $validated['title'],
            'slug'      => $slug,
            'parent_id' => $validated['parent_id'],
        ]);
        return redirect()->route('admin.categories.index');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $paginated = Category::whereNull('parent_id')->with('children')->paginate(20);
        $categories = flattenCategories($paginated->items());
        return view('admin.categories2.show', compact('category', 'categories', 'paginated'));
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $paginated = Category::whereNull('parent_id')->with('children')->paginate(20);
        $categories = flattenCategories($paginated->items());
        return view('admin.categories2.edit', compact('category', 'categories', 'paginated'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'nullable|string|max:255',
            'is_active'  => 'nullable|boolean',
            'parent_id' => 'nullable',
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
            'parent_id' => $validated['parent_id'],
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
