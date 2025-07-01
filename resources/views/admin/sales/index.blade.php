@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Data Penjualan</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No. Order</th>
                    <th>User</th>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="text-center">{{ $order->nomerorder }}</td>
                        <td class="text-center">{{ $order->iduser }}</td>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data penjualan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
