<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Display the searchable and filterable product catalog.
     */
    public function index(Request $request): View
    {
        $activeCategorySlug = $request->string('kategori')->toString();
        $search = $request->string('q')->trim()->toString();

        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $products = Product::with('category')
            ->withAvg('testimonials', 'rating')
            ->withCount('testimonials')
            ->when($activeCategorySlug !== '', function ($query) use ($activeCategorySlug): void {
                $query->whereHas('category', function ($categoryQuery) use ($activeCategorySlug): void {
                    $categoryQuery->where('slug', $activeCategorySlug);
                });
            })
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($searchQuery) use ($search): void {
                    $searchQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('products.index', compact('categories', 'products', 'activeCategorySlug', 'search'));
    }

    /**
     * Display a single product with its testimonials and related items.
     */
    public function show(Product $product): View
    {
        $product->load([
            'category',
            'testimonials' => function ($query): void {
                $query->latest();
            },
        ])->loadAvg('testimonials', 'rating')->loadCount('testimonials');

        $relatedProducts = Product::with('category')
            ->withAvg('testimonials', 'rating')
            ->withCount('testimonials')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Store a customer testimonial for the given product.
     */
    public function storeTestimonial(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'message' => ['required', 'string', 'min:5', 'max:1000'],
        ]);

        $product->testimonials()->create($validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Terima kasih! Testimoni Anda berhasil ditambahkan.');
    }
}
