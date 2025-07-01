<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\AprioriRule;
use Illuminate\Http\Request;

class ProductRecommendationController extends Controller
{
    public function show($id)
    {
        // Ambil produk yang ditekan user
        $product = Product::findOrFail($id);

        // Ambil nama produk sebagai antecedent dari rule apriori
        $recommendedNames = AprioriRule::where('antecedent', 'like', '%' . $product->nama . '%')
                                        ->pluck('consequent');

        // Ambil produk-produk rekomendasi sesuai consequent
        $recommendations = Product::whereIn('nama', $recommendedNames)->get();

        return view('user.recommendation', compact('product', 'recommendations'));
    }
}
