<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | IGX Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #ffffff;
            border-bottom: 1px solid #eaeaea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            color: #222;
            letter-spacing: 1px;
        }

        .navbar-brand span {
            color: #0d6efd;
        }

        .footer {
            background-color: #fff;
            border-top: 1px solid #eee;
            padding: 3rem 0;
            margin-top: 5rem;
        }

        .footer h6 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer p, .footer a {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .footer a:hover {
            color: #0d6efd;
            text-decoration: none;
        }

        .footer-logo {
            font-weight: bold;
            font-size: 1.3rem;
            color: #222;
        }

        .btn-logout {
            font-size: 0.9rem;
        }

        .nav-user {
            font-size: 0.95rem;
            color: #6c757d;
        }

        main {
            min-height: 70vh;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ route('user.show') }}">IGX<span>Store</span></a>
                <div class="d-flex align-items-center ms-auto">
                    <span class="nav-user me-3 d-none d-md-inline">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm btn-logout">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    {{-- Konten --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <div class="footer-logo mb-2">IGX Store</div>
                    <p class="mb-2">Platform belanja terpercaya untuk produk-produk unggulan lokal dan internasional.</p>
                    <p class="text-muted">&copy; {{ date('Y') }} IGX Store. All rights reserved.</p>
                </div>
                <div class="col-md-4">
                    <h6>Tentang</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Karier</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Hubungi Kami</h6>
                    <p class="mb-1">Jl. Inovasi No. 88, Surabaya</p>
                    <p class="mb-1">Email: <a href="mailto:support@igxstore.com">support@igxstore.com</a></p>
                    <p class="mb-0">WhatsApp: <a href="https://wa.me/6281234567890">0812-3456-7890</a></p>
                </div>
            </div>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
