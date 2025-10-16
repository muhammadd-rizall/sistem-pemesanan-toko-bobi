<?php

use Illuminate\Support\Facades\Route;
// Beri alias agar tidak bingung dengan Controller Admin
use App\Http\Controllers\Frontend\ProductController as FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiskonController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SupplierController;

/*
|--------------------------------------------------------------------------
| RUTE UNTUK PENGUNJUNG (FRONTEND)
|--------------------------------------------------------------------------
*/

// Rute untuk Halaman Utama / Home (yang sudah ada)
Route::get('/', [FrontendController::class, 'index'])->name('home');

// Rute untuk detail produk
Route::get('/product/{id}', [FrontendController::class, 'show'])->name('products.show');

// --- RUTE HALAMAN BARU ---
Route::get('/produk', [FrontendController::class, 'produk'])->name('produk');
Route::get('/tentang-kami', [FrontendController::class, 'tentang'])->name('tentang');
Route::get('/testimoni', [FrontendController::class, 'testimoni'])->name('testimoni');
Route::get('/galeri', [FrontendController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [FrontendController::class, 'kontak'])->name('kontak');


// Rute GET untuk MENAMPILKAN form
Route::get('/login', function () {
    return view('frontend.login');
})->name('login'); // Nama untuk menampilkan form tetap 'login'

Route::get('/register', function () {
    return view('frontend.register');
})->name('register'); // Nama untuk menampilkan form tetap 'register'


// Rute POST untuk MEMPROSES data dari form
Route::post('/login', function () {
    // Nanti logika login sesungguhnya akan ada di sini
    return 'Proses login...';
})->name('login.submit'); // Kita beri nama baru agar tidak konflik

Route::post('/register', function () {
    // Nanti logika register sesungguhnya akan ada di sini
    return 'Proses register...';
})->name('register.submit');



// Grup Route untuk Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //produk
    Route::get('/produk', [ProdukController::class, 'produkView'])->name('produk_view');
    Route::get('/produk/create', [ProdukController::class, 'createProduk'])->name('createItemProduk');
    Route::post('/produk/store', [ProdukController::class, 'storeProduk'])->name('storeItemProduk');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'editProduk'])->name('editItemProduk');
    Route::post('/produk/update/{id}', [ProdukController::class, 'updateProduk'])->name('updateItemProduk');
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'deleteProduk'])->name('deleteItemProduk');

    //supplier
    Route::get('/supplier',[SupplierController::class, 'supplierView'])->name('supplierView');
    Route::get('/supplier/create', [SupplierController::class, 'createSupplier'])->name('createSupplier');
    Route::post('/supplier/store', [SupplierController::class, 'storeSupplier'])->name('storeSupplier');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'editSupplier'])->name('editSupplier');
    Route::post('/supplier/update/{id}', [SupplierController::class, 'updateSupplier'])->name('updateSupplier');
    Route::delete('/supplier/delete/{id}',[SupplierController::class, 'deleteSupplier'])->name('deleteSupplier');

    //order
    Route::get('/orders', [OrderController::class, 'index'])->name('listOrder');
    Route::delete('/orders/delete/{id}', [OrderController::class, 'deleteOrder'])->name('deleteOrder');
    Route::get('/orders/{id}', [OrderController::class, 'showOrder'])->name('detailOrder');
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('updateOrderStatus');


    //diskon
    Route::get('/diskon',[DiskonController::class, 'diskonView'])->name('diskonView');
    Route::get('/diskon/create', [DiskonController::class, 'createDiskon'])->name('createDiskon');
    Route::post('/diskon/store', [DiskonController::class, 'storeDiskon'])->name('storeDiskon');
    Route::get('/diskon/edit/{id}', [DiskonController::class, 'editDiskon'])->name('editDiskon');
    Route::post('/diskon/update/{id}', [DiskonController::class, 'updateDiskon'])->name('updateDiskon');
    Route::delete('/diskon/delete/{id}',[DiskonController::class, 'deleteDiskon'])->name('deleteDiskon');

    // Tambahkan route admin lainnya di sini nanti
});




