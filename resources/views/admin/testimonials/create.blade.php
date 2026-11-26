@extends('layouts.admin')

@section('title', 'Tambah Testimoni - Sedap Rasa Nusantara')
@section('heading', 'Tambah Testimoni')
@section('subheading', 'Tambahkan testimoni pelanggan untuk salah satu produk.')

@section('topbar_actions')
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Kembali</a>
@endsection

@section('content')
    <div class="sr-card p-4" style="max-width: 640px;">
        <form method="POST" action="{{ route('admin.testimonials.store') }}">
            @csrf
            <div class="mb-3">
                <label for="product_id" class="form-label fw-semibold">Produk</label>
                <select id="product_id" name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @selected((int) old('product_id') === $product->id)>{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Pelanggan (maks. 50 karakter)</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" maxlength="50" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label fw-semibold">Rating (1 - 5)</label>
                <select id="rating" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                    @for ($r = 5; $r >= 1; $r--)
                        <option value="{{ $r }}" @selected((int) old('rating', 5) === $r)>{{ $r }} Bintang</option>
                    @endfor
                </select>
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="form-label fw-semibold">Pesan Testimoni (maks. 300 karakter)</label>
                <textarea id="message" name="message" rows="4" maxlength="300" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-sr-primary rounded-pill px-4">Simpan Testimoni</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light border rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>
@endsection
