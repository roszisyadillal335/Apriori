@extends('layouts.app')

@section('title', 'Beranda Customer')

@section('content')
<div class="container my-5">
    {{-- Banner --}}
    <div class="mb-5 text-center">
        <img src="{{ asset('images/banner.jpg') }}" class="rounded shadow img-fluid" alt="Banner" style="max-height: 350px; object-fit: cover;">
    </div>

    {{-- Produk --}}
    <h2 class="mb-4 text-center fw-bold">Produk Terbaru</h2>
    <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-link nav-link">Logout</button></form>

    @if($products->count())
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="overflow-hidden border-0 shadow-sm card h-100 rounded-4">
                        {{-- Nama Produk di Atas Gambar --}}
                        <div class="p-3 bg-light border-bottom">
                            <h5 class="mb-0 text-center fw-semibold text-dark">{{ $product->nama }}</h5>
                        </div>

                        {{-- Gambar --}}
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="card-img-top" alt="{{ $product->nama }}" style="height: 200px; object-fit: cover;">

                        {{-- Body --}}
                        <div class="card-body d-flex flex-column">
                            <p class="mb-2 card-text text-muted">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                            <a href="#" class="mt-auto btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center alert alert-info">Belum ada produk yang tersedia saat ini.</div>
    @endif
</div>
@endsection
