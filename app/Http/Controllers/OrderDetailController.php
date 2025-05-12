<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        // Retrieve all order details
        $details = OrderDetail::all();
        return view('details.index', compact('details'));
    }

    public function create()
    {
        // Show the create form for order details
        return view('details.create');
    }

    public function store(Request $request)
    {
        // Validate and store the new order detail
        OrderDetail::create($request->all());
        return redirect()->route('details.index')->with('success', 'Detail berhasil ditambahkan!');
    }

    public function edit($idorderdetail)
    {
        // Retrieve the order detail by its idorderdetail
        $detail = OrderDetail::findOrFail($idorderdetail);
        return view('details.edit', compact('detail'));
    }

    public function update(Request $request, $idorderdetail)
    {
        // Retrieve the order detail and update it
        $detail = OrderDetail::findOrFail($idorderdetail);
        $detail->update($request->all());
        return redirect()->route('details.index')->with('success', 'Detail berhasil diupdate!');
    }

    public function destroy($idorderdetail)
    {
        // Retrieve and delete the order detail by its idorderdetail
        $detail = OrderDetail::findOrFail($idorderdetail);
        $detail->delete();
        return redirect()->route('details.index')->with('success', 'Detail berhasil dihapus!');
    }
}
