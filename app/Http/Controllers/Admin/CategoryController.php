<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->latest()
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $rawName = $request->string('name')->trim()->toString();
        $rawSlug = $request->string('slug')->trim()->toString();

        $request->merge([
            'name' => $rawName,
            'slug' => Str::slug($rawSlug !== '' ? $rawSlug : $rawName),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('categories', 'name')],
            'slug' => ['required', 'string', 'max:70', Rule::unique('categories', 'slug')],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max' => 'Nama kategori maksimal 50 karakter.',
            'name.unique' => 'Nama kategori sudah terdaftar.',
            'slug.required' => 'Slug kategori wajib diisi.',
            'slug.unique' => 'Slug kategori sudah digunakan.',
        ]);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category): RedirectResponse
    {
        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $rawName = $request->string('name')->trim()->toString();
        $rawSlug = $request->string('slug')->trim()->toString();

        $request->merge([
            'name' => $rawName,
            'slug' => Str::slug($rawSlug !== '' ? $rawSlug : $rawName),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('categories', 'name')->ignore($category->id)],
            'slug' => ['required', 'string', 'max:70', Rule::unique('categories', 'slug')->ignore($category->id)],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.max' => 'Nama kategori maksimal 50 karakter.',
            'name.unique' => 'Nama kategori sudah terdaftar.',
            'slug.required' => 'Slug kategori wajib diisi.',
            'slug.unique' => 'Slug kategori sudah digunakan.',
        ]);

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori beserta produk terkait berhasil dihapus.');
    }
}
