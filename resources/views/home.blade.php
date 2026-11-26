<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sedap Rasa Nusantara - Sambal Autentik &amp; Oleh-Oleh UMKM</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --sr-red-dark: #881313;
            --sr-red: #c81e1e;
            --sr-orange: #ea580c;
            --sr-orange-soft: #f97316;
            --sr-cream-bg: #fffaf2;
            --sr-cream: #fff1dc;
            --sr-cream-deep: #fde2bc;
            --sr-ink: #2b1610;
            --sr-muted: #6c4d40;
            --sr-border: #eed3b1;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--sr-cream-bg);
            color: var(--sr-ink);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        section[id],
        header[id] {
            scroll-margin-top: 84px;
        }

        .sr-navbar {
            background: rgba(255, 250, 242, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--sr-border);
        }

        .sr-navbar .nav-link {
            color: var(--sr-ink);
            font-weight: 600;
            border-radius: 999px;
            padding: 0.45rem 0.9rem;
            transition: background-color 0.2s, color 0.2s;
        }

        .sr-navbar .nav-link:hover,
        .sr-navbar .nav-link:focus {
            background-color: var(--sr-cream-deep);
            color: var(--sr-red);
        }

        .btn-sr-primary {
            background: linear-gradient(135deg, var(--sr-red), var(--sr-orange));
            border: none;
            color: #fff;
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(200, 30, 30, 0.22);
        }

        .btn-sr-primary:hover,
        .btn-sr-primary:focus {
            background: linear-gradient(135deg, var(--sr-red-dark), var(--sr-orange));
            color: #fff;
        }

        .btn-sr-outline {
            border: 1.5px solid var(--sr-orange);
            color: var(--sr-red);
            background-color: #fff;
            font-weight: 700;
        }

        .btn-sr-outline:hover {
            background-color: var(--sr-cream);
            color: var(--sr-red-dark);
            border-color: var(--sr-red);
        }

        .sr-hero {
            background: radial-gradient(circle at top right, rgba(249, 115, 22, 0.18), transparent 55%),
                linear-gradient(135deg, #fff2de 0%, #fffaf2 55%, #fde2bc 100%);
            border-bottom: 1px solid var(--sr-border);
        }

        .sr-eyebrow {
            display: inline-block;
            background-color: var(--sr-cream-deep);
            color: var(--sr-red);
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.4rem 0.95rem;
            border-radius: 999px;
        }

        .sr-section-alt {
            background-color: var(--sr-cream);
            border-top: 1px solid var(--sr-border);
            border-bottom: 1px solid var(--sr-border);
        }

        .sr-card {
            background-color: #fff;
            border: 1px solid var(--sr-border);
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(136, 19, 19, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .sr-card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(136, 19, 19, 0.12);
        }

        .sr-thumb {
            aspect-ratio: 4 / 3;
            background: linear-gradient(135deg, #fff1dc 0%, #fde0b6 100%);
            border-bottom: 1px solid var(--sr-border);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .sr-thumb img.real-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sr-thumb img.logo-fallback {
            width: 82px;
            height: 82px;
        }

        .sr-badge-cat {
            background-color: var(--sr-cream-deep);
            color: var(--sr-red);
            font-weight: 700;
            font-size: 0.75rem;
        }

        .sr-price {
            color: var(--sr-red);
            font-weight: 800;
            font-size: 1.1rem;
        }

        .sr-filter-btn {
            border: 1px solid var(--sr-border);
            background-color: #fff;
            color: var(--sr-ink);
            font-weight: 700;
            border-radius: 999px;
            padding: 0.45rem 1.05rem;
        }

        .sr-filter-btn.active,
        .sr-filter-btn:hover {
            background: linear-gradient(135deg, var(--sr-red), var(--sr-orange));
            color: #fff;
            border-color: transparent;
        }

        .sr-stars {
            color: #d97706;
            letter-spacing: 1px;
        }

        .sr-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--sr-red), var(--sr-orange));
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .sr-footer {
            background: linear-gradient(180deg, #4b120d 0%, #310b08 100%);
            color: #fde8cc;
        }

        .sr-footer a {
            color: #fed7aa;
            text-decoration: none;
        }

        .sr-footer a:hover {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Sticky Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top sr-navbar">
        <div class="container py-1">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#hero">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara" width="44" height="44">
                <div>
                    <span class="d-block fw-bold lh-sm" style="color: var(--sr-red); font-size: 1.08rem;">Sedap Rasa Nusantara</span>
                    <small class="d-block fw-semibold" style="color: var(--sr-orange); font-size: 0.72rem;">Sambal &amp; Oleh-Oleh UMKM</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1 mt-3 mt-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kategori">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sr-primary btn-sm rounded-pill px-3">Panel Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sr-outline btn-sm rounded-pill px-3">Login Admin</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="sr-hero py-5">
        <div class="container py-lg-4">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="sr-eyebrow mb-3">UMKM Kuliner Lokal &bull; 100% Cabai &amp; Rempah Segar</span>
                    <h1 class="display-5 fw-bold mb-3" style="line-height: 1.15;">
                        Cita Rasa Pedas Autentik <span style="color: var(--sr-red);">Sedap Rasa Nusantara</span>
                    </h1>
                    <p class="lead mb-4" style="color: var(--sr-muted);">
                        Menghadirkan aneka sambal khas Nusantara dan oleh-oleh kering renyah yang diracik secara higienis tanpa bahan pengawet. Cocok untuk santapan harian maupun buah tangan istimewa.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <a href="#produk" class="btn btn-sr-primary rounded-pill px-4 py-2">Jelajahi Produk</a>
                        <a href="#kontak" class="btn btn-sr-outline rounded-pill px-4 py-2">Pesan Sekarang</a>
                    </div>
                    <div class="row g-3 pt-1">
                        <div class="col-6 col-sm-4">
                            <div class="sr-card p-3 text-center">
                                <div class="fs-4 fw-bold" style="color: var(--sr-red);">{{ $stats['products'] }}</div>
                                <small class="fw-semibold" style="color: var(--sr-muted);">Varian Produk</small>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="sr-card p-3 text-center">
                                <div class="fs-4 fw-bold" style="color: var(--sr-red);">{{ $stats['categories'] }}</div>
                                <small class="fw-semibold" style="color: var(--sr-muted);">Kategori Pilihan</small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="sr-card p-3 text-center">
                                <div class="fs-4 fw-bold" style="color: var(--sr-orange);">{{ $stats['average_rating'] }} / 5</div>
                                <small class="fw-semibold" style="color: var(--sr-muted);">Rating ({{ $stats['testimonials'] }} Ulasan)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="sr-card p-4 p-md-5 text-center bg-white">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Cabai Sedap Rasa Nusantara" width="160" height="160" class="mx-auto mb-3">
                        <h2 class="h4 fw-bold mb-2" style="color: var(--sr-red);">Dapur Sambal &amp; Oleh-Oleh</h2>
                        <p class="mb-0" style="color: var(--sr-muted);">
                            Dimasak dalam batch kecil setiap hari menggunakan cabai rawit pilihan, bawang segar, dan kemasan segel rapat agar tahan kirim ke seluruh Nusantara.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-5">
        <div class="container py-lg-2">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <span class="sr-eyebrow mb-2">Tentang Kami</span>
                <h2 class="fw-bold mb-2">Mengenal UMKM Sedap Rasa Nusantara</h2>
                <p class="mb-0" style="color: var(--sr-muted);">
                    Berawal dari dapur keluarga pencinta kuliner pedas Indonesia, kami menghadirkan sambal rumahan dan camilan oleh-oleh berkualitas tinggi dengan rasa otentik daerah.
                </p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-lg-6">
                    <div class="sr-card p-4 h-100">
                        <h3 class="h5 fw-bold mb-2" style="color: var(--sr-red);">Deskripsi Usaha</h3>
                        <p class="mb-0" style="color: var(--sr-muted);">
                            <strong>Sedap Rasa Nusantara</strong> adalah UMKM kuliner yang berfokus pada produksi sambal kemasan botol higienis serta oleh-oleh kering khas Nusantara seperti keripik tempe sagu, bawang goreng Sumenep, abon sapi, hingga paket hampers eksklusif. Seluruh bahan baku dipasok langsung dari petani lokal.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sr-card p-4 h-100" style="background: linear-gradient(135deg, #fff 0%, #fff4e3 100%);">
                        <h3 class="h5 fw-bold mb-2" style="color: var(--sr-orange);">Visi Kami</h3>
                        <p class="mb-0" style="color: var(--sr-muted);">
                            Menjadi UMKM oleh-oleh dan sambal Nusantara terpercaya yang membawa kekayaan cita rasa rempah Indonesia ke setiap rumah tangga, sekaligus memberdayakan petani cabai serta perajin pangan lokal secara berkelanjutan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <div class="sr-card p-3 h-100 d-flex align-items-start gap-3">
                        <span class="sr-icon-circle">1</span>
                        <div>
                            <h4 class="h6 fw-bold mb-1">Cabai Segar Pilihan</h4>
                            <p class="small mb-0" style="color: var(--sr-muted);">Menggunakan cabai rawit dan cabai merah segar hasil panen petani lokal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="sr-card p-3 h-100 d-flex align-items-start gap-3">
                        <span class="sr-icon-circle">2</span>
                        <div>
                            <h4 class="h6 fw-bold mb-1">Tanpa Pengawet</h4>
                            <p class="small mb-0" style="color: var(--sr-muted);">Diolah dengan teknik pemasakan matang dan sterilisasi botol tanpa bahan kimia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="sr-card p-3 h-100 d-flex align-items-start gap-3">
                        <span class="sr-icon-circle">3</span>
                        <div>
                            <h4 class="h6 fw-bold mb-1">Kemasan Anti Bocor</h4>
                            <p class="small mb-0" style="color: var(--sr-muted);">Toples food-grade tersegel rapi sehingga aman untuk pengiriman jarak jauh.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="sr-card p-3 h-100 d-flex align-items-start gap-3">
                        <span class="sr-icon-circle">4</span>
                        <div>
                            <h4 class="h6 fw-bold mb-1">Cocok Jadi Buah Tangan</h4>
                            <p class="small mb-0" style="color: var(--sr-muted);">Tersedia kemasan satuan maupun paket hampers cantik untuk keluarga &amp; kolega.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    <section id="kategori" class="sr-section-alt py-5">
        <div class="container py-lg-2">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
                <div>
                    <span class="sr-eyebrow mb-2">Kategori</span>
                    <h2 class="fw-bold mb-1">Pilihan Kategori Produk</h2>
                    <p class="mb-0" style="color: var(--sr-muted);">Klik salah satu kategori untuk menyaring daftar produk di bawah.</p>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-md-4">
                        <button type="button"
                                class="sr-card sr-card-hover w-100 p-4 text-start d-flex justify-content-between align-items-center category-jump-btn"
                                data-category-slug="{{ $category->slug }}">
                            <div>
                                <h3 class="h5 fw-bold mb-1" style="color: var(--sr-ink);">{{ $category->name }}</h3>
                                <span class="small fw-semibold" style="color: var(--sr-orange);">{{ $category->products_count }} produk tersedia</span>
                            </div>
                            <span class="sr-icon-circle" style="width: 40px; height: 40px; font-size: 1rem;">&rarr;</span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-5">
        <div class="container py-lg-2">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
                <div>
                    <span class="sr-eyebrow mb-2">Katalog Produk</span>
                    <h2 class="fw-bold mb-1">Sambal &amp; Oleh-Oleh Favorit</h2>
                    <p class="mb-0" style="color: var(--sr-muted);">Pilih kategori untuk menyaring produk, lalu klik <strong>Detail</strong> untuk melihat info lengkap dan testimoni.</p>
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="d-flex flex-wrap gap-2 mb-4" role="group" aria-label="Filter Kategori Produk">
                <button type="button" class="btn sr-filter-btn active" data-filter="all">
                    Semua ({{ $products->count() }})
                </button>
                @foreach ($categories as $category)
                    <button type="button" class="btn sr-filter-btn" data-filter="{{ $category->slug }}">
                        {{ $category->name }} ({{ $category->products_count }})
                    </button>
                @endforeach
            </div>

            <!-- Grid Produk -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="productGrid">
                @foreach ($products as $product)
                    <div class="col product-item" data-category="{{ $product->category?->slug }}">
                        <article class="sr-card sr-card-hover h-100 d-flex flex-column">
                            <div class="sr-thumb">
                                @if ($product->imageUrl())
                                    <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="real-photo">
                                @else
                                    <img src="{{ asset('images/logo.svg') }}" alt="{{ $product->name }}" class="logo-fallback">
                                @endif
                            </div>

                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
                                    <span class="badge rounded-pill sr-badge-cat">{{ $product->category?->name ?? 'Produk' }}</span>
                                    @if ($product->testimonials_count > 0)
                                        <small class="fw-bold" style="color: var(--sr-orange);">&#9733; {{ number_format((float) $product->testimonials_avg_rating, 1) }} ({{ $product->testimonials_count }})</small>
                                    @else
                                        <small class="fw-semibold" style="color: var(--sr-muted);">Baru</small>
                                    @endif
                                </div>

                                <h3 class="h6 fw-bold mb-2">{{ $product->name }}</h3>
                                <p class="small flex-grow-1 mb-3" style="color: var(--sr-muted);">
                                    {{ \Illuminate\Support\Str::limit($product->description, 90) }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center pt-2 border-top" style="border-color: var(--sr-cream-deep) !important;">
                                    <span class="sr-price">{{ $product->formattedPrice() }}</span>
                                    <button type="button"
                                            class="btn btn-sr-outline btn-sm rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#productModal-{{ $product->id }}">
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modals Detail Produk + Testimoni -->
    @foreach ($products as $product)
        <div class="modal fade" id="productModal-{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel-{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content" style="border-radius: 1rem; border: 1px solid var(--sr-border); background-color: var(--sr-cream-bg);">
                    <div class="modal-header" style="background-color: var(--sr-cream); border-bottom: 1px solid var(--sr-border);">
                        <div>
                            <span class="badge rounded-pill sr-badge-cat mb-1">{{ $product->category?->name }}</span>
                            <h5 class="modal-title fw-bold" id="productModalLabel-{{ $product->id }}">{{ $product->name }}</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4 align-items-center mb-4">
                            <div class="col-md-5">
                                <div class="sr-thumb rounded-3" style="border: 1px solid var(--sr-border);">
                                    @if ($product->imageUrl())
                                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" class="real-photo">
                                    @else
                                        <img src="{{ asset('images/logo.svg') }}" alt="{{ $product->name }}" class="logo-fallback" style="width: 110px; height: 110px;">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="fs-3 fw-bold mb-2" style="color: var(--sr-red);">{{ $product->formattedPrice() }}</div>
                                <div class="mb-2 small fw-bold" style="color: var(--sr-orange);">
                                    @if ($product->testimonials_count > 0)
                                        &#9733; {{ number_format((float) $product->testimonials_avg_rating, 1) }} / 5 dari {{ $product->testimonials_count }} testimoni
                                    @else
                                        Belum ada testimoni untuk produk ini
                                    @endif
                                </div>
                                <p class="mb-3" style="color: var(--sr-muted);">{{ $product->description }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Sedap Rasa Nusantara, saya ingin memesan ' . $product->name . ' (' . $product->formattedPrice() . ').') }}"
                                       target="_blank"
                                       rel="noopener"
                                       class="btn btn-sr-primary btn-sm rounded-pill px-3">
                                        Pesan via WhatsApp
                                    </a>
                                    <button type="button"
                                            class="btn btn-sr-outline btn-sm rounded-pill px-3 write-review-btn"
                                            data-product-id="{{ $product->id }}"
                                            data-bs-dismiss="modal">
                                        Tulis Testimoni
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr style="border-color: var(--sr-border);">
                        <h6 class="fw-bold mb-3">Testimoni Pembeli ({{ $product->testimonials->count() }})</h6>

                        @forelse ($product->testimonials as $item)
                            <div class="sr-card p-3 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong>{{ $item->name }}</strong>
                                    <span class="sr-stars small">
                                        @for ($i = 1; $i <= 5; $i++)
                                            {{ $i <= $item->rating ? '★' : '☆' }}
                                        @endfor
                                    </span>
                                </div>
                                <p class="small mb-0" style="color: var(--sr-muted);">"{{ $item->message }}"</p>
                            </div>
                        @empty
                            <p class="small mb-0" style="color: var(--sr-muted);">Belum ada testimoni. Jadilah yang pertama memberikan ulasan untuk {{ $product->name }}!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Testimoni Section (Daftar + Form Kirim) -->
    <section id="testimoni" class="sr-section-alt py-5">
        <div class="container py-lg-2">
            <div class="text-center mx-auto mb-5" style="max-width: 680px;">
                <span class="sr-eyebrow mb-2">Testimoni Pelanggan</span>
                <h2 class="fw-bold mb-2">Apa Kata Penikmat Sedap Rasa?</h2>
                <p class="mb-0" style="color: var(--sr-muted);">Ulasan asli dari pelanggan kami. Anda juga dapat mengirimkan testimoni langsung melalui formulir di bawah ini.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-4" role="alert">
                    <strong>Mohon periksa isian testimoni Anda:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4 align-items-start">
                <div class="col-lg-7">
                    <div class="row g-3">
                        @forelse ($testimonials as $testimonial)
                            <div class="col-md-6">
                                <article class="sr-card p-3 h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="sr-stars mb-2" aria-label="Rating {{ $testimonial->rating }} dari 5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                {{ $i <= $testimonial->rating ? '★' : '☆' }}
                                            @endfor
                                        </div>
                                        <p class="small mb-3" style="color: var(--sr-muted);">"{{ $testimonial->message }}"</p>
                                    </div>
                                    <div>
                                        <div class="fw-bold small">{{ $testimonial->name }}</div>
                                        @if ($testimonial->product)
                                            <span class="badge rounded-pill sr-badge-cat mt-1">{{ $testimonial->product->name }}</span>
                                        @endif
                                    </div>
                                </article>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="sr-card p-4 text-center">Belum ada testimoni pelanggan.</div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="sr-card p-4 bg-white">
                        <h3 class="h5 fw-bold mb-1" style="color: var(--sr-red);">Kirim Testimoni</h3>
                        <p class="small mb-3" style="color: var(--sr-muted);">Bagikan pengalaman Anda mencicipi produk Sedap Rasa Nusantara.</p>

                        <form method="POST" action="{{ route('testimonials.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="testimonial_product_id" class="form-label fw-semibold small">Pilih Produk</label>
                                <select id="testimonial_product_id" name="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
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
                                <label for="testimonial_name" class="form-label fw-semibold small">Nama Lengkap (maks. 50 karakter)</label>
                                <input id="testimonial_name" type="text" name="name" value="{{ old('name') }}" maxlength="50" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Rina Kusuma" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="testimonial_rating" class="form-label fw-semibold small">Rating (1 - 5)</label>
                                <select id="testimonial_rating" name="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                    @for ($r = 5; $r >= 1; $r--)
                                        <option value="{{ $r }}" @selected((int) old('rating', 5) === $r)>{{ $r }} Bintang</option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="testimonial_message" class="form-label fw-semibold small">Pesan Testimoni (maks. 300 karakter)</label>
                                <textarea id="testimonial_message" name="message" rows="3" maxlength="300" class="form-control @error('message') is-invalid @enderror" placeholder="Tulis pengalaman rasa atau kemasan produk..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-sr-primary w-100 rounded-pill">Kirim Testimoni</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5">
        <div class="container py-lg-2">
            <div class="sr-card p-4 p-lg-5" style="background: linear-gradient(135deg, #fff 0%, #fff1dc 100%);">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <span class="sr-eyebrow mb-2">Kontak &amp; Pemesanan</span>
                        <h2 class="fw-bold mb-2">Hubungi UMKM Sedap Rasa Nusantara</h2>
                        <p class="mb-4" style="color: var(--sr-muted);">
                            Melayani pembelian eceran, reseller oleh-oleh, hingga paket hampers acara kantor dan keluarga dengan pengiriman ke seluruh Indonesia.
                        </p>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="sr-card p-3 h-100">
                                    <div class="small fw-bold" style="color: var(--sr-orange);">Alamat Rumah Produksi</div>
                                    <div class="fw-semibold small mt-1">Jl. Rempah Nusantara No. 27, Sleman, Yogyakarta</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="sr-card p-3 h-100">
                                    <div class="small fw-bold" style="color: var(--sr-orange);">Jam Operasional</div>
                                    <div class="fw-semibold small mt-1">Senin &ndash; Sabtu, 08.00 &ndash; 17.00 WIB</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="sr-card p-3 h-100">
                                    <div class="small fw-bold" style="color: var(--sr-orange);">WhatsApp Pemesanan</div>
                                    <div class="fw-semibold small mt-1">+62 812-3456-7890</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="sr-card p-3 h-100">
                                    <div class="small fw-bold" style="color: var(--sr-orange);">Email Resmi</div>
                                    <div class="fw-semibold small mt-1">halo@sedaprasa.test</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 text-center">
                        <div class="sr-card p-4 bg-white">
                            <h3 class="h5 fw-bold mb-2" style="color: var(--sr-red);">Siap Kirim Hari Ini</h3>
                            <p class="small mb-3" style="color: var(--sr-muted);">Konsultasikan pilihan level pedas, stok oleh-oleh, atau pemesanan hampers langsung bersama admin kami.</p>
                            <a href="https://wa.me/6281234567890?text={{ urlencode('Halo UMKM Sedap Rasa Nusantara, saya ingin menanyakan info produk dan pemesanan.') }}"
                               target="_blank"
                               rel="noopener"
                               class="btn btn-sr-primary rounded-pill px-4 py-2 w-100">
                                Chat WhatsApp Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="sr-footer pt-5 pb-4 mt-4">
        <div class="container">
            <div class="row g-4 pb-4 border-bottom" style="border-color: rgba(254, 215, 170, 0.2) !important;">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara" width="44" height="44">
                        <div>
                            <div class="fw-bold text-white">Sedap Rasa Nusantara</div>
                            <small style="color: #fdba74;">Sambal Autentik &amp; Oleh-Oleh UMKM</small>
                        </div>
                    </div>
                    <p class="small mb-0" style="color: #fed7aa;">
                        Menyajikan kehangatan rasa nusantara lewat sambal racikan tradisional dan oleh-oleh kering premium tanpa pengawet.
                    </p>
                </div>

                <div class="col-6 col-lg-3">
                    <h3 class="h6 fw-bold text-white mb-3">Navigasi</h3>
                    <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
                        <li><a href="#hero">Beranda</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#kategori">Kategori</a></li>
                        <li><a href="#produk">Produk</a></li>
                        <li><a href="#testimoni">Testimoni</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4">
                    <h3 class="h6 fw-bold text-white mb-3">UMKM Kami</h3>
                    <p class="small mb-1" style="color: #fed7aa;">Jl. Rempah Nusantara No. 27, Yogyakarta</p>
                    <p class="small mb-1" style="color: #fed7aa;">WA: +62 812-3456-7890</p>
                    <p class="small mb-3" style="color: #fed7aa;">Email: halo@sedaprasa.test</p>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3">Panel Admin</a>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 small" style="color: #fdba74;">
                <span>&copy; {{ date('Y') }} UMKM Sedap Rasa Nusantara. All rights reserved.</span>
                <span>Tema Merah &bull; Oranye &bull; Krem</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.sr-filter-btn');
            const productItems = document.querySelectorAll('.product-item');
            const categoryJumpButtons = document.querySelectorAll('.category-jump-btn');
            const reviewSelect = document.getElementById('testimonial_product_id');
            const writeReviewButtons = document.querySelectorAll('.write-review-btn');

            function applyFilter(slug) {
                filterButtons.forEach(function (btn) {
                    btn.classList.toggle('active', btn.dataset.filter === slug);
                });

                productItems.forEach(function (item) {
                    if (slug === 'all' || item.dataset.category === slug) {
                        item.classList.remove('d-none');
                    } else {
                        item.classList.add('d-none');
                    }
                });
            }

            filterButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    applyFilter(btn.dataset.filter);
                });
            });

            categoryJumpButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const slug = btn.dataset.categorySlug;
                    applyFilter(slug);
                    const produkSection = document.getElementById('produk');
                    if (produkSection) {
                        produkSection.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            writeReviewButtons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (reviewSelect) {
                        reviewSelect.value = btn.dataset.productId;
                    }
                    setTimeout(function () {
                        const testimoniSection = document.getElementById('testimoni');
                        if (testimoniSection) {
                            testimoniSection.scrollIntoView({ behavior: 'smooth' });
                        }
                    }, 220);
                });
            });
        });
    </script>
</body>
</html>
