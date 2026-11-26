@extends('layouts.admin')

@section('title', 'Tambah Produk - Sedap Rasa Nusantara')
@section('heading', 'Tambah Produk')
@section('subheading', 'Tambahkan produk sambal atau oleh-oleh baru ke katalog.')

@section('topbar_actions')
    <a href="{{ route('admin.products.index') }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Kembali</a>
@endsection

@section('content')
    <div class="sr-card p-4" style="max-width: 720px;">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="category_id" class="form-label fw-semibold">Kategori</label>
                <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('category_id') === $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Produk (maks. 100 karakter)</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" maxlength="100" class="form-control @error('name') is-invalid @enderror" required placeholder="Contoh: Sambal Teri Medan Pedas">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label fw-semibold">Slug (opsional, otomatis dari nama jika kosong)</label>
                <input id="slug" type="text" name="slug" value="{{ old('slug') }}" maxlength="120" class="form-control @error('slug') is-invalid @enderror" placeholder="sambal-teri-medan-pedas">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label fw-semibold">Harga (Rupiah)</label>
                <input id="price" type="number" name="price" value="{{ old('price') }}" min="0" step="1" class="form-control @error('price') is-invalid @enderror" required placeholder="35000">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Deskripsi Produk (maks. 1000 karakter)</label>
                <textarea id="description" name="description" rows="4" maxlength="1000" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label fw-semibold">Foto Produk (opsional, JPG/JPEG/PNG/WebP maks. 2MB)</label>
                <input id="image" type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-sr-primary rounded-pill px-4">Simpan Produk</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light border rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>
@endsection
