<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// Grup Route untuk Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Tambahkan route admin lainnya di sini nanti
});

Route::get('/coba', function () {
    return view('coba');
});


Route::get('/coba2', function () {
    return view('backend.produk.item_produk');
});
