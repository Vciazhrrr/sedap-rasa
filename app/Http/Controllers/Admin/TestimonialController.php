<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index(): View
    {
        $testimonials = Testimonial::with('product')
            ->latest()
            ->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        return view('admin.testimonials.create', compact('products'));
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', Rule::exists('products', 'id')],
            'name' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:300'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ], [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk tidak valid.',
            'name.required' => 'Nama pelanggan wajib diisi.',
            'name.max' => 'Nama pelanggan maksimal 50 karakter.',
            'message.required' => 'Pesan testimoni wajib diisi.',
            'message.max' => 'Pesan testimoni maksimal 300 karakter.',
            'rating.required' => 'Rating wajib dipilih.',
            'rating.between' => 'Rating harus antara 1 sampai 5.',
        ]);

        Testimonial::create($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Display the specified testimonial.
     */
    public function show(Testimonial $testimonial): RedirectResponse
    {
        return redirect()->route('admin.testimonials.edit', $testimonial);
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial): View
    {
        $products = Product::orderBy('name')->get();

        return view('admin.testimonials.edit', compact('testimonial', 'products'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', Rule::exists('products', 'id')],
            'name' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:300'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ], [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk tidak valid.',
            'name.required' => 'Nama pelanggan wajib diisi.',
            'name.max' => 'Nama pelanggan maksimal 50 karakter.',
            'message.required' => 'Pesan testimoni wajib diisi.',
            'message.max' => 'Pesan testimoni maksimal 300 karakter.',
            'rating.required' => 'Rating wajib dipilih.',
            'rating.between' => 'Rating harus antara 1 sampai 5.',
        ]);

        $testimonial->update($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}
