<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - Sedap Rasa Nusantara')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --sr-red-dark: #7f1d1d;
            --sr-red: #c81e1e;
            --sr-orange: #ea580c;
            --sr-cream-bg: #fffaf2;
            --sr-cream: #fff1dc;
            --sr-cream-deep: #fde2bc;
            --sr-ink: #2b1610;
            --sr-muted: #6c4d40;
            --sr-border: #eed3b1;
        }

        body {
            background-color: var(--sr-cream-bg);
            color: var(--sr-ink);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--sr-red-dark) 0%, #9a3412 100%);
            color: #fff7ed;
        }

        .admin-sidebar .nav-link {
            color: #ffedd5;
            font-weight: 600;
            border-radius: 0.65rem;
            padding: 0.65rem 0.95rem;
            transition: background-color 0.2s, color 0.2s;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.18);
            color: #ffffff;
        }

        .sr-card {
            background-color: #fff;
            border: 1px solid var(--sr-border);
            border-radius: 1rem;
            box-shadow: 0 4px 14px rgba(127, 29, 29, 0.05);
        }

        .btn-sr-primary {
            background: linear-gradient(135deg, var(--sr-red), var(--sr-orange));
            border: none;
            color: #fff;
            font-weight: 700;
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
            font-weight: 600;
        }

        .btn-sr-outline:hover {
            background-color: var(--sr-cream);
            color: var(--sr-red-dark);
        }

        .sr-badge-cat {
            background-color: var(--sr-cream-deep);
            color: var(--sr-red);
            font-weight: 700;
        }

        .table thead th {
            background-color: var(--sr-cream);
            color: var(--sr-ink);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            border-bottom-color: var(--sr-border);
        }

        .pagination .page-link {
            color: var(--sr-red);
            border-color: var(--sr-border);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--sr-red), var(--sr-orange));
            border-color: transparent;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Mobile Topbar -->
    <nav class="navbar d-lg-none sticky-top px-3 py-2" style="background: linear-gradient(90deg, var(--sr-red-dark), #9a3412);">
        <a class="navbar-brand d-flex align-items-center gap-2 text-white" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara" width="36" height="36">
            <span class="fw-bold fs-6">Admin Sedap Rasa</span>
        </a>
        <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminOffcanvas" aria-controls="adminOffcanvas">
            Menu
        </button>
    </nav>

    <div class="d-flex">
        <!-- Desktop Sidebar -->
        <aside class="admin-sidebar d-none d-lg-flex flex-column p-3 flex-shrink-0 sticky-top" style="height: 100vh;">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-white pb-3 mb-3 border-bottom border-light border-opacity-25">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara" width="42" height="42">
                <div>
                    <div class="fw-bold lh-sm">Sedap Rasa</div>
                    <small style="color: #fed7aa;">Panel Admin UMKM</small>
                </div>
            </a>

            <ul class="nav nav-pills flex-column gap-1 mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">Testimoni</a>
                </li>
                <li class="nav-item mt-2 pt-2 border-top border-light border-opacity-25">
                    <a href="{{ route('home') }}" class="nav-link">Lihat Website Publik</a>
                </li>
            </ul>

            <div class="pt-3 border-top border-light border-opacity-25">
                <div class="small mb-2" style="color: #fed7aa;">Masuk sebagai: <strong class="text-white">{{ auth()->user()->name }}</strong></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm w-100 rounded-pill">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Mobile Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="adminOffcanvas" aria-labelledby="adminOffcanvasLabel" style="background: linear-gradient(180deg, var(--sr-red-dark) 0%, #9a3412 100%); max-width: 280px;">
            <div class="offcanvas-header border-bottom border-light border-opacity-25">
                <div class="d-flex align-items-center gap-2" id="adminOffcanvasLabel">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara" width="36" height="36">
                    <span class="fw-bold">Admin Sedap Rasa</span>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <ul class="nav nav-pills flex-column gap-1 mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'bg-white bg-opacity-25' : '' }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'bg-white bg-opacity-25' : '' }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'bg-white bg-opacity-25' : '' }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link text-white {{ request()->routeIs('admin.testimonials.*') ? 'bg-white bg-opacity-25' : '' }}">Testimoni</a>
                    </li>
                    <li class="nav-item mt-2 pt-2 border-top border-light border-opacity-25">
                        <a href="{{ route('home') }}" class="nav-link text-white">Lihat Website Publik</a>
                    </li>
                </ul>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm w-100 rounded-pill">Logout ({{ auth()->user()->name }})</button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-grow-1 p-3 p-md-4">
            <div class="container-fluid px-0">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 pb-3 mb-4 border-bottom" style="border-color: var(--sr-border) !important;">
                    <div>
                        <h1 class="h3 fw-bold mb-1">@yield('heading', 'Dashboard Admin')</h1>
                        <p class="small mb-0" style="color: var(--sr-muted);">@yield('subheading', 'Kelola data UMKM Sedap Rasa Nusantara')</p>
                    </div>
                    <div>
                        @yield('topbar_actions')
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Terdapat kesalahan input:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
