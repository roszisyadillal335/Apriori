<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AprioriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman apriori
Route::get('/apriori', [AprioriController::class, 'index'])->name('apriori.index');

// Resource route untuk daftar order
Route::resource('orders', OrderController::class);

// Custom routes for detail order to include idorderdetail as parameter for edit, update, destroy
Route::get('details/{idorderdetail}/edit', [OrderDetailController::class, 'edit'])->name('details.edit');
Route::put('details/{idorderdetail}', [OrderDetailController::class, 'update'])->name('details.update');
Route::delete('details/{idorderdetail}', [OrderDetailController::class, 'destroy'])->name('details.destroy');

// Default resource route for details without edit, update, destroy
Route::resource('details', OrderDetailController::class)->except(['edit', 'update', 'destroy']);