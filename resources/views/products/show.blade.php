@extends('layouts.app')

@section('title', $product->name . ' - Sedap Rasa Nusantara')

@section('content')
    <section class="section">
        <div class="container">
            <p style="margin: 0 0 18px; font-size: 0.88rem; color: var(--ink-500);">
                <a href="{{ route('home') }}">Beranda</a> /
                <a href="{{ route('products.index') }}">Katalog</a> /
                <a href="{{ route('products.index', ['kategori' => $product->category?->slug]) }}">{{ $product->category?->name }}</a> /
                <strong>{{ $product->name }}</strong>
            </p>

            <div class="card" style="padding: 28px; margin-bottom: 36px;">
                <div class="grid-2" style="align-items: center;">
                    <div class="product-thumb" style="border-radius: var(--radius-md); border: 1px solid var(--border-warm);">
                        @if ($product->imageUrl())
                            <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="real-photo">
                        @else
                            <img src="{{ asset('images/logo.svg') }}" alt="{{ $product->name }}" class="placeholder-logo" style="width: 130px; height: 130px;">
                        @endif
                    </div>

                    <div>
                        <span class="badge" style="margin-bottom: 12px;">{{ $product->category?->name }}</span>
                        <h1 style="margin: 0 0 10px; font-size: 2rem; line-height: 1.2;">{{ $product->name }}</h1>
                        <div style="margin-bottom: 14px; font-size: 0.92rem; color: var(--orange-600); font-weight: 700;">
                            @if ($product->testimonials_count > 0)
                                &#9733; {{ number_format((float) $product->testimonials_avg_rating, 1) }} / 5 ({{ $product->testimonials_count }} ulasan pelanggan)
                            @else
                                Belum ada ulasan &mdash; jadilah yang pertama memberi testimoni!
                            @endif
                        </div>

                        <div style="font-size: 1.8rem; font-weight: 800; color: var(--red-700); margin-bottom: 16px;">
                            {{ $product->formattedPrice() }}
                        </div>

                        <p style="margin: 0 0 22px; color: var(--ink-700);">{{ $product->description }}</p>

                        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                            <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Sedap Rasa Nusantara, saya ingin memesan ' . $product->name . ' (' . $product->formattedPrice() . ').') }}"
                               target="_blank"
                               rel="noopener"
                               class="btn btn-primary">
                                Pesan via WhatsApp
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline">Kembali ke Katalog</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid-2" style="align-items: start; margin-bottom: 42px;">
                <div class="card card-body">
                    <h2 style="margin: 0 0 16px; font-size: 1.3rem;">Ulasan Pembeli ({{ $product->testimonials->count() }})</h2>

                    @forelse ($product->testimonials as $testimonial)
                        <div style="padding: 14px 0; border-bottom: 1px solid var(--cream-200);">
                            <div class="stars" style="margin-bottom: 4px;">
                                @for ($i = 1; $i <= 5; $i++)
                                    {{ $i <= $testimonial->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                            <p style="margin: 0 0 6px; color: var(--ink-700);">"{{ $testimonial->message }}"</p>
                            <small style="font-weight: 700; color: var(--ink-900);">{{ $testimonial->name }}</small>
                            <small style="color: var(--ink-500);"> &bull; {{ $testimonial->created_at?->format('d M Y') }}</small>
                        </div>
                    @empty
                        <p style="color: var(--ink-500); margin: 0;">Belum ada testimoni untuk produk ini.</p>
                    @endforelse
                </div>

                <div class="card card-body">
                    <h2 style="margin: 0 0 6px; font-size: 1.3rem;">Kirim Testimoni</h2>
                    <p style="margin: 0 0 18px; font-size: 0.9rem; color: var(--ink-500);">Bagikan pengalaman rasa Anda setelah mencoba {{ $product->name }}.</p>

                    <form method="POST" action="{{ route('products.testimonials.store', $product) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Anda</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" required maxlength="100" placeholder="Contoh: Andi Pratama">
                            @error('name')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rating" class="form-label">Rating (1 - 5)</label>
                            <select id="rating" name="rating" class="form-control" required>
                                @for ($r = 5; $r >= 1; $r--)
                                    <option value="{{ $r }}" @selected((int) old('rating', 5) === $r)>{{ $r }} Bintang</option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Pesan Testimoni</label>
                            <textarea id="message" name="message" rows="4" class="form-control" required minlength="5" maxlength="1000" placeholder="Ceritakan cita rasa, kemasan, atau tingkat kepedasannya...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
                    </form>
                </div>
            </div>

            @if ($relatedProducts->count() > 0)
                <div>
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">Produk Sejenis</h2>
                            <p class="section-desc">Pilihan lain dalam kategori {{ $product->category?->name }}.</p>
                        </div>
                    </div>
                    <div class="grid-3">
                        @foreach ($relatedProducts as $related)
                            <x-product-card :product="$related" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
