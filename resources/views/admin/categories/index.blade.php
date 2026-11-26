@extends('layouts.admin')

@section('title', 'Kelola Kategori - Sedap Rasa Nusantara')
@section('heading', 'Kelola Kategori')
@section('subheading', 'Daftar kategori produk sambal dan oleh-oleh UMKM.')

@section('topbar_actions')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-sr-primary btn-sm rounded-pill px-3">+ Tambah Kategori</a>
@endsection

@section('content')
    <div class="sr-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Jumlah Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $loop->index }}</td>
                            <td class="fw-bold">{{ $category->name }}</td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>{{ $category->products_count }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Edit</a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Semua produk di dalamnya juga akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>
@endsection
