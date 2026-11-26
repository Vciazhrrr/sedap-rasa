@extends('layouts.admin')

@section('title', 'Dashboard Admin - Sedap Rasa Nusantara')
@section('heading', 'Dashboard UMKM')
@section('subheading', 'Ringkasan jumlah kategori, produk, dan testimoni pelanggan.')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="sr-card p-4 h-100">
                <div class="small fw-bold text-uppercase" style="color: var(--sr-muted);">Jumlah Kategori</div>
                <div class="display-5 fw-bold my-2" style="color: var(--sr-red);">{{ $summary['categories'] }}</div>
                <a href="{{ route('admin.categories.index') }}" class="small fw-bold text-decoration-none" style="color: var(--sr-orange);">Kelola Kategori &rarr;</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sr-card p-4 h-100">
                <div class="small fw-bold text-uppercase" style="color: var(--sr-muted);">Jumlah Produk</div>
                <div class="display-5 fw-bold my-2" style="color: var(--sr-red);">{{ $summary['products'] }}</div>
                <a href="{{ route('admin.products.index') }}" class="small fw-bold text-decoration-none" style="color: var(--sr-orange);">Kelola Produk &rarr;</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="sr-card p-4 h-100">
                <div class="small fw-bold text-uppercase" style="color: var(--sr-muted);">Jumlah Testimoni</div>
                <div class="display-5 fw-bold my-2" style="color: var(--sr-red);">{{ $summary['testimonials'] }}</div>
                <a href="{{ route('admin.testimonials.index') }}" class="small fw-bold text-decoration-none" style="color: var(--sr-orange);">Kelola Testimoni &rarr;</a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="sr-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0">Produk Terbaru</h2>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sr-primary btn-sm rounded-pill px-3">+ Tambah Produk</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestProducts as $product)
                                <tr>
                                    <td class="fw-semibold">{{ $product->name }}</td>
                                    <td><span class="badge rounded-pill sr-badge-cat">{{ $product->category?->name }}</span></td>
                                    <td>{{ $product->formattedPrice() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="sr-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h5 fw-bold mb-0">Testimoni Terbaru</h2>
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">+ Tambah Testimoni</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestTestimonials as $testimonial)
                                <tr>
                                    <td class="fw-semibold">{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->product?->name }}</td>
                                    <td><span class="fw-bold" style="color: var(--sr-orange);">{{ $testimonial->rating }} / 5</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Belum ada testimoni.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
