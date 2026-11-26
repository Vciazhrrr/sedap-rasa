@extends('layouts.admin')

@section('title', 'Edit Kategori - Sedap Rasa Nusantara')
@section('heading', 'Edit Kategori')
@section('subheading', 'Perbarui nama atau slug kategori.')

@section('topbar_actions')
    <a href="{{ route('admin.categories.index') }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Kembali</a>
@endsection

@section('content')
    <div class="sr-card p-4" style="max-width: 620px;">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama Kategori (maks. 50 karakter)</label>
                <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" maxlength="50" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="slug" class="form-label fw-semibold">Slug</label>
                <input id="slug" type="text" name="slug" value="{{ old('slug', $category->slug) }}" maxlength="70" class="form-control @error('slug') is-invalid @enderror">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-sr-primary rounded-pill px-4">Perbarui Kategori</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light border rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>
@endsection
