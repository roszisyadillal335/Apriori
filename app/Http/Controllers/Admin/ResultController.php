<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        // Ambil data rules dari session atau database sesuai kebutuhan
        $rules = session('apriori_rules', []); // misalnya disimpan di session

        return view('admin.result.index', compact('rules'));
    }
}
