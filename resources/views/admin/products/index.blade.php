@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daftar Produk</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $produk)
                <tr>
                    <td>{{ $produk->idproduct }}</td>
                    <td>
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" width="80" height="80" style="object-fit: cover;">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $produk->namaproduk }}</td>
                    <td>Rp{{ number_format($produk->hargaproduk, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $produk) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.products.destroy', $produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
