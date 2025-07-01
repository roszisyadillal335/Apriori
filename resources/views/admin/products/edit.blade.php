@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Produk</h3>

    <form action="{{ route('admin.products.update', $product->idproduct) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="namaproduk" class="form-label">Nama Produk</label>
            <input type="text" name="namaproduk" class="form-control" value="{{ old('namaproduk', $product->namaproduk) }}" required>
        </div>

        <div class="mb-3">
            <label for="hargaproduk" class="form-label">Harga Produk</label>
            <input type="number" name="hargaproduk" class="form-control" value="{{ old('hargaproduk', $product->hargaproduk) }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk (Opsional)</label>
            <input type="file" name="gambar" class="form-control">
            @if($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" width="120" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
