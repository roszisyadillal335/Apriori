@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h1 class="fw-bold display-6 text-dark mb-0">
            <i class="bi bi-cart-check me-2"></i>Daftar Penjualan
        </h1>
        <a href="{{ route('admin.sales.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Penjualan
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-borderless align-middle mb-0">
                    <thead class="bg-dark text-white text-center">
                        <tr>
                            <th>No. Order</th>
                            <th>User</th>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Total</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="border-bottom">
                                <td class="text-center fw-semibold">{{ $order->nomerorder }}</td>
                                <td class="text-center">{{ $order->user->name ?? $order->iduser }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($order->tanggalorder)->format('d M Y') }}</td>
                                <td>
                                    <ul class="mb-0 ps-3">
                                        @foreach($order->details as $detail)
                                            <li>
                                                <span class="text-dark">
                                                    {{ $detail->namaproduk ?? $detail->product->namaproduk ?? 'Produk tidak ditemukan' }}
                                                </span> -
                                                <span class="text-muted">{{ $detail->qty }} x Rp{{ number_format($detail->subtotalproduk / max($detail->qty, 1), 0, ',', '.') }}</span>
                                                = <span class="fw-semibold text-success">Rp{{ number_format($detail->subtotalproduk, 0, ',', '.') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-end text-nowrap fw-bold text-primary">
                                    Rp{{ number_format($order->details->sum('subtotalproduk'), 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.sales.edit', $order->idorder) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.sales.destroy', $order->idorder) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Tambahkan icon dari Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    h1.display-6 {
        font-family: 'Segoe UI', Roboto, sans-serif;
        letter-spacing: 0.5px;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-outline-warning:hover, .btn-outline-danger:hover {
        color: #fff;
    }
</style>
@endsection
