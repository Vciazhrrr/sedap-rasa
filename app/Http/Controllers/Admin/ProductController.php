<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
    {
        $search = $request->string('q')->trim()->toString();

        $products = Product::with('category')
            ->withCount('testimonials')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
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
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:120', Rule::unique('products', 'slug')],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 100 karakter.',
            'slug.unique' => 'Slug produk sudah digunakan.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.max' => 'Deskripsi produk maksimal 1000 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated['price'] = (int) round((float) $validated['price']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): RedirectResponse
    {
        return redirect()->route('admin.products.edit', $product);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $rawName = $request->string('name')->trim()->toString();
        $rawSlug = $request->string('slug')->trim()->toString();

        $request->merge([
            'name' => $rawName,
            'slug' => Str::slug($rawSlug !== '' ? $rawSlug : $rawName),
        ]);

        $validated = $request->validate([
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:120', Rule::unique('products', 'slug')->ignore($product->id)],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 100 karakter.',
            'slug.unique' => 'Slug produk sudah digunakan.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.max' => 'Deskripsi produk maksimal 1000 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated['price'] = (int) round((float) $validated['price']);

        if ($request->boolean('remove_image') && $product->image) {
            Storage::disk('public')->delete($product->image);
            $validated['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        unset($validated['remove_image']);
        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
