<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class SalesController extends Controller
{
    public function index()
    {
        $orders = Order::with(['details', 'user'])->get();
        return view('admin.sales.index', compact('orders'));
    }
}
