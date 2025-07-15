@extends('layouts.user')

@section('title', 'Detail Produk')

@section('content')
<div class="container my-5">

    {{-- === DETAIL PRODUK === --}}
    <div class="row g-5 align-items-start mb-5">
        <div class="col-md-6">
            <div class="bg-white rounded-4 shadow-sm d-flex justify-content-center align-items-center p-4" style="height: 400px;">
                <img src="{{ asset('storage/' . $product->gambar) }}"
                     alt="{{ $product->namaproduk }}"
                     class="img-fluid"
                     style="max-height: 100%; max-width: 100%; object-fit: contain;">
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="fw-bold text-dark mb-3">{{ $product->namaproduk }}</h1>
            <h4 class="text-danger fw-semibold mb-4">Rp{{ number_format($product->hargaproduk, 0, ',', '.') }}</h4>

            <div class="mb-4">
                <h6 class="fw-semibold text-secondary mb-2">Deskripsi Produk</h6>
                <p class="text-muted" style="line-height: 1.7">
                    {{ $product->deskripsi ?? 'Tidak ada deskripsi tersedia untuk produk ini.' }}
                </p>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-outline-dark rounded-pill px-4">
                ← Kembali ke Produk
            </a>
        </div>
    </div>

    {{-- === REKOMENDASI === --}}
    <h3 class="fw-bold mb-4">Rekomendasi Produk Lainnya</h3>
    <div class="row g-4">
        @foreach($recommendations->unique('idproduct') as $reco)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 product-card d-flex flex-column overflow-hidden">
                    <div class="bg-light d-flex justify-content-center align-items-center p-3" style="height: 180px;">
                        <img src="{{ asset('storage/' . $reco->gambar) }}"
                             alt="{{ $reco->namaproduk }}"
                             class="img-fluid product-img"
                             style="max-height: 160px; object-fit: contain;">
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-semibold text-dark mb-1">{{ Str::limit($reco->namaproduk, 40) }}</h6>
                            <p class="text-muted mb-3 small">Rp{{ number_format($reco->hargaproduk, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('user.product.show', $reco->idproduct) }}"
                           class="btn btn-outline-primary btn-sm rounded-pill mt-auto w-100 lihat-detail">
                            Beli
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- === STYLE === --}}
<style>
    .product-card {
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .product-img {
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .lihat-detail {
        transition: 0.3s ease-in-out;
        font-weight: 500;
        border-radius: 25px;
    }

    .lihat-detail:hover {
        background-color: #0056b3;
        color: #fff;
        border-color: #0056b3;
        transform: translateY(-2px);
    }
</style>
@endsection
