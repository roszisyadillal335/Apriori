<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('daftarorderdetail')
            ->select(
                'idproduct',
                DB::raw('MAX(namaproduk) as namaproduk'),
                DB::raw('MAX(hargaproduk) as hargaproduk'),
                DB::raw('MAX(gambar) as gambar')
            )
            ->groupBy('idproduct')
            ->orderByDesc('idproduct')
            ->paginate(10);

        // Ubah setiap item menjadi array agar bisa diakses di blade dengan aman
        $products->getCollection()->transform(function ($item) {
            $item->gambar_url = asset('storage/' . ltrim($item->gambar, '/'));
            return $item;
        });

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
            $oldPath = trim($product->gambar);
            if ($oldPath && \Storage::disk('public')->exists($oldPath)) {
                \Storage::disk('public')->delete($oldPath);
            }

            // Simpan gambar baru
            $path = trim($request->file('gambar')->store('images', 'public'));
            $data['gambar'] = $path;
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
