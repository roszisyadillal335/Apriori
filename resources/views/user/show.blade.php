@extends('layouts.user')

@section('title', 'Beranda Customer')

@section('content')

{{-- === Carousel Banner Full Width === --}}
<div class="w-100 mb-5 px-0">
    <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/banner1.jpg') }}" class="d-block w-100" style="height: 450px; object-fit:cover;" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/banner2.jpg') }}" class="d-block w-100" style="height: 450px; object-fit:cover;" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/banner3.jpg') }}" class="d-block w-100" style="height: 450px; object-fit:cover;" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>


{{-- === Produk Terbaru === --}}
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold text-dark mb-0">Produk Terbaru</h2>
        {{-- Future: Tambah filter / sort --}}
    </div>

    @if($products->count())
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card border-0 h-100 shadow-sm rounded-4 product-card">
                        {{-- Gambar --}}
                        <div class="bg-light d-flex align-items-center justify-content-center p-4" style="height: 200px;">
                            <img src="{{ asset('storage/' . $product->gambar) }}"
                                alt="{{ $product->namaproduk }}"
                                class="img-fluid" style="max-height: 160px; object-fit: contain;">
                        </div>
                        {{-- Info --}}
                        <div class="card-body d-flex flex-column text-center">
                            <div class="mb-2">
                                <h6 class="fw-semibold text-truncate">{{ $product->namaproduk }}</h6>
                                <p class="text-danger fw-bold mb-2">Rp{{ number_format($product->hargaproduk, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('user.product.show', $product->idproduct) }}" class="btn btn-primary btn-sm rounded-pill mt-auto">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-5 d-flex justify-content-between align-items-center flex-wrap">
            <p class="text-muted mb-2">Menampilkan halaman {{ $products->currentPage() }} dari {{ $products->lastPage() }}</p>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-warning text-center mt-4">Belum ada produk yang tersedia saat ini.</div>
    @endif
</div>

{{-- Custom CSS --}}
<style>
    .product-card {
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
    }

    .card-body h6 {
        font-size: 1rem;
        color: #343a40;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #084298;
    }

    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endsection
