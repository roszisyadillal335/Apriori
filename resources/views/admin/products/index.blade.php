@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold text-dark display-6">📦 Daftar Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive p-4">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $produk)
                        <tr>
                            <td>{{ $produk->idproduct }}</td>
                            <td>
                                @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" width="70" height="70" class="rounded shadow-sm" style="object-fit: cover;">
                                @else
                                    <span class="text-muted fst-italic">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $produk->namaproduk }}</td>
                            <td class="text-success fw-bold">Rp{{ number_format($produk->hargaproduk, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $produk->idproduct) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $produk->idproduct) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted fst-italic">Belum ada produk yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>

<!-- Tambahan Gaya -->
<style>
    h1.display-6 {
        font-family: 'Segoe UI', Roboto, sans-serif;
        letter-spacing: 0.5px;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .card {
        border-radius: 12px;
    }

    .btn i {
        font-size: 14px;
    }
</style>
@endsection
