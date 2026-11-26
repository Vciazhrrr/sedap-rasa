@props(['product'])

<article class="card card-hover product-card">
    <a href="{{ route('products.show', $product) }}" class="product-thumb">
        @if ($product->imageUrl())
            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="real-photo">
        @else
            <img src="{{ asset('images/logo.svg') }}" alt="{{ $product->name }}" class="placeholder-logo">
        @endif
    </a>

    <div class="card-body" style="display: flex; flex-direction: column; flex-grow: 1;">
        <div class="product-meta">
            <span class="badge">{{ $product->category?->name ?? 'Produk' }}</span>
            @php
                $avg = $product->testimonials_avg_rating ?? null;
                $count = $product->testimonials_count ?? 0;
            @endphp
            @if ($count > 0)
                <span class="rating-inline">&#9733; {{ number_format((float) $avg, 1) }} ({{ $count }})</span>
            @else
                <span class="rating-inline" style="color: var(--ink-500);">Baru</span>
            @endif
        </div>

        <h3 class="product-title">
            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        </h3>

        <p class="product-excerpt">{{ \Illuminate\Support\Str::limit($product->description, 95) }}</p>

        <div class="product-footer">
            <span class="price-tag">{{ $product->formattedPrice() }}</span>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline btn-sm">Detail</a>
        </div>
    </div>
</article>
