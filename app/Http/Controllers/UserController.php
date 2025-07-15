<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{
    public function show()
    {
        $products = Product::select('namaproduk', 'gambar', 'hargaproduk', 'idproduct')
                   ->distinct()
                   ->orderByDesc('idproduct')
                   ->paginate(12);
        return view('user.show', compact('products'));
    }
}
