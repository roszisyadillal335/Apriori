<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | CoffeeStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand-text {
            font-weight: 700;
            font-size: 1.4rem;
            color: #343a40;
            text-decoration: none;
        }

        .brand-text:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <header class="py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('user.show') }}" class="brand-text">☕ CoffeeStore</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted d-none d-md-inline">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </header>

    {{-- Konten --}}
    <main>
        @yield('content')
    </main>

    {{-- Optional: Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
