<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/testimoni', [PublicController::class, 'storeTestimonial'])->name('testimonials.store');

Route::get('/produk', [CatalogController::class, 'index'])->name('products.index');
Route::get('/produk/{product:slug}', [CatalogController::class, 'show'])->name('products.show');
Route::post('/produk/{product:slug}/testimoni', [CatalogController::class, 'storeTestimonial'])->name('products.testimonials.store');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function (): void {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('testimonials', AdminTestimonialController::class);
    });
