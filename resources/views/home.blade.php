@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Produk</h2>

    @if (isset($message))
        <div class="alert alert-warning">{{ $message }}</div>
    @else
        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama }}</h5>
                            <p class="card-text">Rp{{ number_format($product->harga) }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Belum ada produk.</p>
            @endforelse
        </div>
    @endif
</div>
@endsection
