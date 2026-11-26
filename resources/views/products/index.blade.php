@extends('layouts.app')

@section('title', 'Katalog Produk - Sedap Rasa Nusantara')

@section('content')
    <section class="section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h1 class="section-title">Katalog Sambal &amp; Oleh-Oleh</h1>
                    <p class="section-desc">Pilih kategori atau cari produk favorit Anda dari UMKM Sedap Rasa Nusantara.</p>
                </div>
            </div>

            <div class="filter-bar">
                <div class="filter-pills">
                    <a href="{{ route('products.index', array_filter(['q' => $search])) }}"
                       class="pill {{ $activeCategorySlug === '' ? 'active' : '' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', array_filter(['kategori' => $category->slug, 'q' => $search])) }}"
                           class="pill {{ $activeCategorySlug === $category->slug ? 'active' : '' }}">
                            {{ $category->name }} ({{ $category->products_count }})
                        </a>
                    @endforeach
                </div>

                <form method="GET" action="{{ route('products.index') }}" class="search-form">
                    @if ($activeCategorySlug !== '')
                        <input type="hidden" name="kategori" value="{{ $activeCategorySlug }}">
                    @endif
                    <input type="text" name="q" value="{{ $search }}" placeholder="Cari sambal atau oleh-oleh..." class="form-control" style="width: 240px;">
                    <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                </form>
            </div>

            @if ($products->count() > 0)
                <div class="grid-3">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $products->links() }}
                </div>
            @else
                <div class="card card-body" style="text-align: center; padding: 48px 20px;">
                    <h2 style="margin: 0 0 8px;">Produk belum ditemukan</h2>
                    <p style="margin: 0 0 16px; color: var(--ink-500);">Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-outline btn-sm">Reset Filter</a>
                </div>
            @endif
        </div>
    </section>
@endsection
