@extends('layouts.admin')

@section('title', 'Edit Testimoni - Sedap Rasa Nusantara')
@section('heading', 'Edit Testimoni')
@section('subheading', 'Perbarui isi atau rating testimoni pelanggan.')

@section('topbar_actions')
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Kembali</a>
@endsection

@section('content')
    <div class="sr-card p-4" style="max-width: 640px;">
        <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="product_id" class="form-label fw-semibold">Produk</label>
                <select id="product_id" name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @selected((int) old('product_id', $testimonial->product_id) === $product->id)>{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Pelanggan (maks. 50 karakter)</label>
                <input id="name" type="text" name="name" value="{{ old('name', $testimonial->name) }}" maxlength="50" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label fw-semibold">Rating (1 - 5)</label>
                <select id="rating" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                    @for ($r = 5; $r >= 1; $r--)
                        <option value="{{ $r }}" @selected((int) old('rating', $testimonial->rating) === $r)>{{ $r }} Bintang</option>
                    @endfor
                </select>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="form-label fw-semibold">Pesan Testimoni (maks. 300 karakter)</label>
                <textarea id="message" name="message" rows="4" maxlength="300" class="form-control @error('message') is-invalid @enderror" required>{{ old('message', $testimonial->message) }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-sr-primary rounded-pill px-4">Perbarui Testimoni</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light border rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>
@endsection
