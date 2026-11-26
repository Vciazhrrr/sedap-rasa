<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the UMKM Sedap Rasa Nusantara landing page.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::with('category')
            ->withAvg('testimonials', 'rating')
            ->withCount('testimonials')
            ->latest()
            ->take(8)
            ->get();

        $testimonials = Testimonial::with('product')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'testimonials' => Testimonial::count(),
            'average_rating' => round((float) (Testimonial::avg('rating') ?? 5), 1),
        ];

        return view('home', compact('categories', 'featuredProducts', 'testimonials', 'stats'));
    }
}
