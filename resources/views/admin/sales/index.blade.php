@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="fw-bold display-6 text-dark mb-0">Daftar Penjualan</h1>
        </div>
        <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">+ Tambah Penjualan</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
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
                    <tr>
                        <td class="text-center">{{ $order->nomerorder }}</td>
                        <td class="text-center">{{ $order->user->name ?? $order->iduser }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($order->tanggalorder)->format('d M Y') }}</td>
                        <td>
                            <ul class="mb-0">
                                @foreach($order->details as $detail)
                                    <li>
                                        {{ $detail->namaproduk ?? $detail->product->namaproduk ?? 'Produk tidak ditemukan' }} - 
                                        {{ $detail->qty }} x Rp{{ number_format($detail->subtotalproduk / max($detail->qty,1), 0, ',', '.') }} 
                                        = Rp{{ number_format($detail->subtotalproduk, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-end">Rp{{ number_format($order->ordertotal, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.sales.edit', $order->idorder) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.sales.destroy', $order->idorder) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data penjualan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    h1.display-6 {
        letter-spacing: 0.5px;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }
</style>

@endsection
