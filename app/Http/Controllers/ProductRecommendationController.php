<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\AprioriRule;
use Illuminate\Http\Request;

class ProductRecommendationController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Ambil produk yang disarankan sesuai rule Apriori
        $rules = AprioriRule::where('lhs', $product->namaproduk)->get();
        $recommendedNames = $rules->pluck('rhs')->toArray();

        $recommendations = Product::whereIn('namaproduk', $recommendedNames)->get();

        return view('user.recommendation', compact('product', 'recommendations'));
    }
}
