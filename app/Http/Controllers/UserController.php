<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{
    public function show()
    {
        $products = DB::table('daftarorderdetail')
            ->select('idproduct', 'namaproduk', 'gambar', 'hargaproduk')
            ->distinct('idproduct') // ambil produk unik berdasarkan id
            ->orderByDesc('idproduct')
            ->paginate(12);

        return view('user.show', compact('products'));
    }
}
