<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Sidebar CSS -->
    <style>
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            z-index: 1000;
            overflow-y: auto;
            border-right: 1px solid #dee2e6;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
    </style>
</head>
<body class="font-sans antialiased bg-light">

    @auth
        @if(auth()->user()->role === 'admin')
            <!-- Sidebar -->
            <nav class="fixed-sidebar shadow-sm px-3 pt-4">
                <h5 class="text-center mb-4">Admin Panel</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->is('admin.dashboard*') ? 'active fw-bold' : '' }}" href="{{ route('admin.dashboard.index') }}">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box me-2"></i> Data Produk
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('admin.sales.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.sales.index') }}">
                            <i class="fas fa-shopping-cart me-2"></i> Data Penjualan
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('admin.apriori.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.apriori.index') }}">
                            <i class="fas fa-project-diagram me-2"></i> Apriori
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ request()->routeIs('admin.results.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.results.index') }}">
                            <i class="fas fa-chart-line me-2"></i> Hasil Rekomendasi
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        @endif
    @endauth

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

</body>
</html>
