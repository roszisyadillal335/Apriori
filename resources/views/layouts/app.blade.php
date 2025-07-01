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
</head>
<body class="font-sans antialiased">

<div class="min-vh-100 bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <!-- Sidebar hanya untuk user admin -->
            @auth
                @if(auth()->user()->role === 'admin')
                    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar shadow-sm">
                        <div class="position-sticky pt-4 px-3">
                            <h5 class="text-center mb-4">Admin Panel</h5>
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2">
                                    <a class="nav-link {{ request()->is('admin.products.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.dashboard.index') }}">
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
                                <!-- Tambahkan ini -->
                                <li class="nav-item mt-4">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </nav>
                @endif
            @endauth


            <!-- Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>

</body>
</html>
