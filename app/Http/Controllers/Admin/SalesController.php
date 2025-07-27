<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $orders = Order::with(['details', 'user'])->paginate(10); // 10 orders per page
        return view('admin.sales.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.sales.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomerorder' => 'required|unique:daftarorder,nomerorder',
            'iduser' => 'required',
            'tanggalorder' => 'required|date',
            'ordertotal' => 'required|numeric',
        ]);

        Order::create($request->only([
            'nomerorder', 'iduser', 'tanggalorder', 'jamorder',
            'status', 'statustrack', 'itemsubtotal', 'discon', 'coupon',
            'kodekupon', 'persdiskon', 'tax', 'shippingprice', 'ordertotal'
        ]));

        return redirect()->route('admin.sales.index')->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        return view('admin.sales.edit', compact('order', 'users'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'iduser' => 'required',
            'tanggalorder' => 'required|date',
            'ordertotal' => 'required|numeric',
        ]);

        $order->update($request->only([
            'iduser', 'tanggalorder', 'jamorder',
            'status', 'statustrack', 'itemsubtotal', 'discon', 'coupon',
            'kodekupon', 'persdiskon', 'tax', 'shippingprice', 'ordertotal'
        ]));

        return redirect()->route('admin.sales.index')->with('success', 'Data penjualan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.sales.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
}
