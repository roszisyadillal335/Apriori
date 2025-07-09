@extends('layouts.user')

@section('title', 'Detail Produk')

@section('content')
<div class="container my-5">
    {{-- Detail Produk --}}
    <div class="row mb-5 align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="bg-white d-flex justify-content-center align-items-center" style="height: 300px; border-radius: 1rem; overflow: hidden;">
                <img src="{{ asset('storage/' . $product->gambar) }}" 
                    alt="{{ $product->namaproduk }}"
                    style="max-height: 100%; max-width: 100%; object-fit: contain;">
            </div>
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold fs-2 mb-3">{{ $product->namaproduk }}</h2>
            <h4 class="text-danger mb-3">Rp{{ number_format($product->hargaproduk, 0, ',', '.') }}</h4>
            <p class="text-secondary mb-4">
                {{ $product->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}
            </p>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">← Kembali</a>
        </div>
    </div>

    {{-- Rekomendasi Produk --}}
    <h4 class="fw-semibold mb-4">Rekomendasi Produk Lainnya</h4>
    <div class="row g-4">
        @foreach($recommendations as $reco)
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 product-card overflow-hidden">
                
                {{-- Wrapper gambar agar selalu rapi --}}
                <div class="d-flex align-items-center justify-content-center bg-white" style="height: 180px;">
                    <img src="{{ asset('storage/' . $reco->gambar) }}" 
                         class="product-img"
                         alt="{{ $reco->namaproduk }}"
                         style="max-height: 160px; max-width: 100%; object-fit: contain;">
                </div>

                {{-- Nama produk di bawah gambar, center --}}
                <div class="text-center mt-2 px-3">
                    <h6 class="fw-semibold mb-1">{{ $reco->namaproduk }}</h6>
                    <p class="text-muted small">Rp{{ number_format($reco->hargaproduk, 0, ',', '.') }}</p>
                </div>

                <div class="card-body d-flex flex-column pt-0">
                    <a href="{{ route('user.product.show', $reco->idproduct) }}" class="btn btn-outline-primary mt-auto lihat-detail">Beli</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .product-card {
        transition: all 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .lihat-detail {
        transition: all 0.2s ease-in-out;
    }

    .lihat-detail:hover {
        transform: translateY(-2px);
        background-color: #0056b3;
        color: #fff;
    }

    .product-img {
        transition: transform 0.3s ease;
    }
</style>
@endsection
