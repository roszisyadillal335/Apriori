@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Tambah Produk Baru</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="namaproduk" class="form-label">Nama Produk</label>
            <input type="text" name="namaproduk" class="form-control" value="{{ old('namaproduk') }}" required>
        </div>

        <div class="mb-3">
            <label for="hargaproduk" class="form-label">Harga Produk</label>
            <input type="number" name="hargaproduk" class="form-control" value="{{ old('hargaproduk') }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
