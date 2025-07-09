<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Contoh rekomendasi: ambil 3 produk lain secara acak, selain produk ini
        $recommendations = Product::where('id', '!=', $id)->inRandomOrder()->limit(3)->get();

        return view('user.recommendation', compact('product', 'recommendations'));
    }
}
