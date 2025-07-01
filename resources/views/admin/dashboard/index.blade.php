@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    <h3 class="my-4">Dashboard Admin</h3>

    <div class="row g-4">
        <!-- Total Produk -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-box fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">Total Produk</h6>
                        <h4 class="mb-0">{{ $totalProduk ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Penjualan -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-shopping-cart fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">Total Penjualan</h6>
                        <h4 class="mb-0">{{ $totalPenjualan ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-warning shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-receipt fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">Total Transaksi</h6>
                        <h4 class="mb-0">{{ $totalTransaksi ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Rekomendasi -->
        <div class="col-md-6 col-xl-3">
            <div class="card text-white bg-danger shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-lightbulb fa-2x me-3"></i>
                    <div>
                        <h6 class="mb-1">Rekomendasi Terbentuk</h6>
                        <h4 class="mb-0">{{ $totalRekomendasi ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
