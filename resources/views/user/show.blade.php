@extends('layouts.user')

@section('title', 'Beranda Customer')

@section('content')
<div class="container my-5">
    {{-- Banner --}}
    <div class="mb-5 text-center">
        <img src="{{ asset('images/banner.jpg') }}" class="rounded-4 shadow img-fluid" alt="Banner"
             style="max-height: 350px; object-fit: cover; width: 100%;">
    </div>

    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Produk Terbaru</h2>
    </div>

    {{-- Daftar Produk --}}
    @if($products->count())
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card border-0 h-100 shadow-sm rounded-4 overflow-hidden text-center">
                        {{-- Gambar --}}
                        <div class="product-image-wrapper bg-white d-flex align-items-center justify-content-center" style="height: 180px;">
                            <img src="{{ asset('storage/' . $product->gambar) }}"
                                class="product-img"
                                alt="{{ $product->namaproduk }}"
                                style="max-height: 160px; max-width: 100%; object-fit: contain;">
                        </div>
                        {{-- Nama Produk --}}
                        <div class="p-3">
                            <h6 class="fw-semibold text-dark mb-2">{{ $product->namaproduk }}</h6>
                            <p class="text-muted mb-2">Rp{{ number_format($product->hargaproduk, 0, ',', '.') }}</p>
                            <a href="{{ route('user.product.show', $product->idproduct) }}" class="btn btn-primary btn-sm lihat-detail">Beli</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center mt-4">Belum ada produk yang tersedia saat ini.</div>
    @endif
</div>

{{-- Custom CSS --}}
<style>
    .product-card {
        transition: all 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .lihat-detail {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .lihat-detail:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }
    .product-image-wrapper {
    border-bottom: 1px solid #eee;
    padding: 10px;
    }

</style>
@endsection
