@extends('layouts.admin')

@section('title', 'Kelola Produk - Sedap Rasa Nusantara')
@section('heading', 'Kelola Produk')
@section('subheading', 'Daftar produk sambal dan oleh-oleh Sedap Rasa Nusantara.')

@section('topbar_actions')
    <a href="{{ route('admin.products.create') }}" class="btn btn-sr-primary btn-sm rounded-pill px-3">+ Tambah Produk</a>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex flex-wrap gap-2 mb-3">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama produk..." class="form-control" style="max-width: 280px;">
        <button type="submit" class="btn btn-sr-outline btn-sm rounded-pill px-3">Cari</button>
        @if ($search !== '')
            <a href="{{ route('admin.products.index') }}" class="btn btn-light border btn-sm rounded-pill px-3">Reset</a>
        @endif
    </form>

    <div class="sr-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Testimoni</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>
                                @if ($product->imageUrl())
                                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="rounded-2 border" style="width: 56px; height: 42px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/logo.svg') }}" alt="{{ $product->name }}" class="rounded-2 border p-1 bg-light" style="width: 56px; height: 42px; object-fit: contain;">
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $product->name }}</div>
                                <small class="text-muted"><code>{{ $product->slug }}</code></small>
                            </td>
                            <td><span class="badge rounded-pill sr-badge-cat">{{ $product->category?->name }}</span></td>
                            <td class="fw-bold" style="color: var(--sr-red);">{{ $product->formattedPrice() }}</td>
                            <td>{{ $product->testimonials_count }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini? File gambar dan testimoni terkait juga akan dihapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>
@endsection
