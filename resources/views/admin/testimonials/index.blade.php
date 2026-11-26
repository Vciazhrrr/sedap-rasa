@extends('layouts.admin')

@section('title', 'Kelola Testimoni - Sedap Rasa Nusantara')
@section('heading', 'Kelola Testimoni')
@section('subheading', 'Ulasan pelanggan untuk setiap produk UMKM.')

@section('topbar_actions')
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sr-primary btn-sm rounded-pill px-3">+ Tambah Testimoni</a>
@endsection

@section('content')
    <div class="sr-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Rating</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonials->firstItem() + $loop->index }}</td>
                            <td class="fw-bold">{{ $testimonial->name }}</td>
                            <td><span class="badge rounded-pill sr-badge-cat">{{ $testimonial->product?->name }}</span></td>
                            <td class="fw-bold" style="color: var(--sr-orange);">{{ $testimonial->rating }} / 5</td>
                            <td class="small">{{ \Illuminate\Support\Str::limit($testimonial->message, 80) }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Edit</a>
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Yakin ingin menghapus testimoni ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada testimoni.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $testimonials->links() }}
    </div>
@endsection
