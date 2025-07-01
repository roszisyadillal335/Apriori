<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Cek jika tabel products belum dibuat
        if (!Schema::hasTable('products')) {
            return view('home')->with('message', 'Tabel produk belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $products = Product::all();
        return view('home', compact('products'));
    }
}
