<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\AprioriRule;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalProduk' => Product::distinct('idproduct')->count('idproduct'),
            'totalPenjualan' => Order::sum('ordertotal'),
            'totalTransaksi' => Order::count(),
            'totalRekomendasi' => AprioriRule::count()
        ]);
    }

}



