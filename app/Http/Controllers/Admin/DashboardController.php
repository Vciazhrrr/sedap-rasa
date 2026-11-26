<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard overview using Eloquent models.
     */
    public function index(): View
    {
        $summary = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'testimonials' => Testimonial::count(),
            'average_rating' => round((float) (Testimonial::avg('rating') ?? 0), 1),
        ];

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $latestTestimonials = Testimonial::with('product')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('summary', 'latestProducts', 'latestTestimonials'));
    }
}
