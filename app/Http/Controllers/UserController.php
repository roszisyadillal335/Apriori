<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{
    public function show()
    {
        $products = Product::all();
        return view('user.show', compact('products'));
    }
}
