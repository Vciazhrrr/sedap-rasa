<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sedap Rasa Nusantara - Sambal & Oleh-Oleh Khas')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/sedap-rasa.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara">
                <div>
                    <span class="brand-title">Sedap Rasa Nusantara</span>
                    <span class="brand-sub">Sambal Autentik &amp; Oleh-Oleh UMKM</span>
                </div>
            </a>

            <nav class="nav-links" aria-label="Navigasi Utama">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Katalog Produk</a>
                <a href="{{ route('home') }}#testimoni" class="nav-link">Testimoni</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">Panel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login Admin</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @if (session('success'))
            <div class="container" style="padding-top: 20px;">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="brand" style="margin-bottom: 12px;">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara" style="width: 40px; height: 40px;">
                        <div>
                            <span class="brand-title" style="color: #fff;">Sedap Rasa Nusantara</span>
                            <span class="brand-sub" style="color: #fdba74;">Cita Rasa Nusantara dalam Setiap Botol</span>
                        </div>
                    </div>
                    <p>UMKM kuliner spesialis sambal nusantara dan aneka oleh-oleh kering premium yang diracik dari bahan segar pilihan tanpa pengawet buatan.</p>
                </div>
                <div>
                    <h3>Menu Cepat</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}">Semua Produk</a></li>
                        <li><a href="{{ route('home') }}#kategori">Kategori Produk</a></li>
                        <li><a href="{{ route('login') }}">Admin UMKM</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Kontak UMKM</h3>
                    <p>Jl. Rempah Nusantara No. 27, Yogyakarta</p>
                    <p>WhatsApp: 0812-3456-7890</p>
                    <p>Email: halo@sedaprasa.test</p>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} UMKM Sedap Rasa Nusantara.</span>
                <span>Sambal &amp; Oleh-Oleh Khas Nusantara</span>
            </div>
        </div>
    </footer>
</body>
</html>
