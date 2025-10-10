<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SupplierController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

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

    // Tambahkan route admin lainnya di sini nanti
});

// Route::get('/coba', function () {
//     return view('coba');
// });


// Route::get('/coba2', function () {
//     return view('backend.produk.item_produk');
// });



