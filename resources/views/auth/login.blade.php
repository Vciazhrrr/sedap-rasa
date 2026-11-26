<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Sedap Rasa Nusantara</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top right, rgba(249, 115, 22, 0.2), transparent 50%),
                linear-gradient(135deg, #fff2de 0%, #fffaf2 55%, #fde2bc 100%);
            color: #2b1610;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .login-card {
            background: #fff;
            border: 1px solid #eed3b1;
            border-radius: 1.25rem;
            box-shadow: 0 16px 36px rgba(127, 29, 29, 0.1);
        }

        .btn-sr-primary {
            background: linear-gradient(135deg, #c81e1e, #ea580c);
            border: none;
            color: #fff;
            font-weight: 700;
        }

        .btn-sr-primary:hover {
            background: linear-gradient(135deg, #7f1d1d, #ea580c);
            color: #fff;
        }
    </style>
</head>
<body class="d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-card p-4 p-md-5">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Sedap Rasa Nusantara" width="84" height="84" class="mx-auto mb-3">
                        <h1 class="h4 fw-bold mb-1" style="color: #c81e1e;">Login Admin UMKM</h1>
                        <p class="small text-muted mb-0">Masuk untuk mengelola kategori, produk, dan testimoni Sedap Rasa Nusantara.</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success small">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login.attempt') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold small">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus placeholder="admin@sedaprasa.test">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold small">Kata Sandi</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-4">
                            <input id="remember" type="checkbox" name="remember" value="1" class="form-check-input">
                            <label for="remember" class="form-check-label small">Ingat sesi saya</label>
                        </div>

                        <button type="submit" class="btn btn-sr-primary w-100 rounded-pill py-2 mb-3">Masuk ke Panel Admin</button>
                        <div class="text-center">
                            <a href="{{ route('home') }}" class="small text-decoration-none fw-semibold" style="color: #ea580c;">&larr; Kembali ke Halaman Utama</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
