@extends('layouts.app')

@section('title', 'Detail Produk & Rekomendasi')

@section('content')
<div class="container my-5">

    {{-- Detail Produk --}}
    <div class="mb-4">
        <h2>{{ $product->nama }}</h2>
        <img src="{{ asset('storage/' . $product->gambar) }}" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
        <p>Harga: Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
    </div>

    {{-- Rekomendasi Produk --}}
    <h4>Rekomendasi Berdasarkan Produk Ini:</h4>
    @if ($recommendations->count())
        <div class="row">
            @foreach ($recommendations as $rec)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $rec->gambar) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $rec->nama }}</h5>
                            <p>Rp{{ number_format($rec->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('user.product.show', $rec->id) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Tidak ada rekomendasi untuk produk ini.</p>
    @endif

</div>
@endsection
