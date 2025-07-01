<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'namaproduk' => 'required|string|max:255',
            'hargaproduk' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'namaproduk' => 'required|string|max:255',
            'hargaproduk' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($product->gambar && \Storage::disk('public')->exists($product->gambar)) {
                \Storage::disk('public')->delete($product->gambar);
            }

            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        // Update data produk
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diubah!');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar lama jika ada
        if ($product->gambar && \Storage::disk('public')->exists($product->gambar)) {
            \Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }

}
