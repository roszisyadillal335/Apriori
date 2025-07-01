@extends('layouts.app')

@section('title', 'Beranda Customer')

@section('content')
<div class="container my-5">
    {{-- Banner --}}
    <div class="mb-5 text-center">
        <img src="{{ asset('images/banner.jpg') }}" class="img-fluid rounded shadow" alt="Banner" style="max-height: 350px; object-fit: cover;">
    </div>

    {{-- Produk --}}
    <h2 class="mb-4 text-center fw-bold">Produk Terbaru</h2>
    
    @if($products->count())
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        {{-- Nama Produk di Atas Gambar --}}
                        <div class="p-3 bg-light border-bottom">
                            <h5 class="mb-0 text-center fw-semibold text-dark">{{ $product->nama }}</h5>
                        </div>

                        {{-- Gambar --}}
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama }}" style="height: 200px; object-fit: cover;">

                        {{-- Body --}}
                        <div class="card-body d-flex flex-column">
                            <p class="card-text text-muted mb-2">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                            <a href="#" class="btn btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">Belum ada produk yang tersedia saat ini.</div>
    @endif
</div>
@endsection
