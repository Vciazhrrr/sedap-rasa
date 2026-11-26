<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Display the single-page UMKM Sedap Rasa Nusantara storefront.
     */
    public function index(): View
    {
        $categories = Category::with('products')
            ->withCount('products')
            ->orderBy('id')
            ->get();

        $products = Product::with([
            'category',
            'testimonials' => function ($query): void {
                $query->latest();
            },
        ])
            ->withAvg('testimonials', 'rating')
            ->withCount('testimonials')
            ->orderBy('id')
            ->get();

        $testimonials = Testimonial::with('product')
            ->latest()
            ->get();

        $stats = [
            'products' => $products->count(),
            'categories' => $categories->count(),
            'testimonials' => $testimonials->count(),
            'average_rating' => $testimonials->count() > 0
                ? round((float) $testimonials->avg('rating'), 1)
                : 5.0,
        ];

        return view('home', compact('categories', 'products', 'testimonials', 'stats'));
    }

    /**
     * Validate and store a customer testimonial via Eloquent.
     */
    public function storeTestimonial(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'integer', Rule::exists('products', 'id')],
            'name' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:300'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ], [
            'product_id.required' => 'Silakan pilih produk yang diulas.',
            'product_id.exists' => 'Produk yang dipilih tidak valid.',
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 50 karakter.',
            'message.required' => 'Pesan testimoni wajib diisi.',
            'message.max' => 'Pesan testimoni maksimal 300 karakter.',
            'rating.required' => 'Rating wajib dipilih.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.between' => 'Rating harus bernilai antara 1 sampai 5.',
        ]);

        if ($validator->fails()) {
            return redirect(route('home').'#testimoni')
                ->withErrors($validator)
                ->withInput();
        }

        Testimonial::create($validator->validated());

        return redirect(route('home').'#testimoni')
            ->with('success', 'Terima kasih! Testimoni Anda berhasil dikirim.');
    }
}
