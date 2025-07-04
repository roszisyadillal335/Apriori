<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRecommendationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\AprioriController;
use App\Http\Controllers\Admin\ResultController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

// Redirect root berdasarkan role
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('admin.dashboard.index')
            : redirect()->route('user.show');
    }
    return redirect()->route('login');
});

// Route public detail produk (optional, kalau mau detail produk public)
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// ADMIN Routes
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('products', AdminProductController::class);
    Route::resource('sales', SalesController::class);
    Route::get('/apriori', [AprioriController::class, 'index'])->name('apriori.index');
    Route::post('/apriori/process', [AprioriController::class, 'process'])->name('apriori.process');
    Route::get('/results', [ResultController::class, 'index'])->name('results.index');
});

// CUSTOMER Routes
Route::middleware(['auth', 'role:customer'])->prefix('user')->name('user.')->group(function () {
    Route::get('/show', [UserController::class, 'show'])->name('show');
    Route::get('/user/product/{id}', [ProductRecommendationController::class, 'show'])->name('user.product.show');
});

// Profile Routes (common for all roles)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Optional logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Breeze / Fortify Auth Routes
require __DIR__.'/auth.php';
