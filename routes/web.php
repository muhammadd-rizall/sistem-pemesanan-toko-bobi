<?php

use Illuminate\Support\Facades\Route;
// Beri alias agar tidak bingung dengan Controller Admin
use App\Http\Controllers\Frontend\ProductController as FrontendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiskonController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;

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

/*
|--------------------------------------------------------------------------
| RUTE UNTUK Customer (FRONTEND)
|--------------------------------------------------------------------------
*/

Route::prefix('/')->name('customer.')->group(function () {

    // Guest Routes (belum login)
    Route::middleware('guest:customer')->group(function () {
        Route::post('/register', [CustomerController::class, 'registerCustomer'])->name('register');
        Route::post('/login', [CustomerController::class, 'loginCustomer'])->name('login');
        Route::get('/login', [CustomerController::class, 'loginCustomer'])->name('login');

        // Forgot Password
        Route::post('/forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('forgotPassword.sendOtp');
        Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgotPassword.verifyOtp');
        Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgotPassword.resetPassword');
        Route::post('/forgot-password/resend-otp', [ForgotPasswordController::class, 'resendOtp'])->name('forgotPassword.resendOtp');

        //redirect
        //google
        Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle'])->name('google.redirect');
    });

    //callback
    //google
    Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('google.callback');

    // Authenticated Customer Routes
    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [CustomerController::class, 'logoutCustomer'])->name('logout');
    });
});


/*
|--------------------------------------------------------------------------
| RUTE AUTENTIKASI ADMIN (HALAMAN LOGIN KHUSUS)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    // Rute yang bisa diakses 'guest' (belum login admin)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

/*
|--------------------------------------------------------------------------
| RUTE UNTUK ADMIN (DILINDUNGI DENGAN MIDDLEWARE)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin.role'])->prefix('admin')->group(function () {
    // Middleware 'admin.role' yang baru Anda buat akan melindungi semua rute di sini

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //produk
    Route::get('/produk', [ProdukController::class, 'produkView'])->name('produk_view');
    Route::get('/produk/create', [ProdukController::class, 'createProduk'])->name('createItemProduk');
    Route::post('/produk/store', [ProdukController::class, 'storeProduk'])->name('storeItemProduk');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'editProduk'])->name('editItemProduk');
    Route::post('/produk/update/{id}', [ProdukController::class, 'updateProduk'])->name('updateItemProduk');
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'deleteProduk'])->name('deleteItemProduk');

    //supplier
    Route::get('/supplier', [SupplierController::class, 'supplierView'])->name('supplierView');
    Route::get('/supplier/create', [SupplierController::class, 'createSupplier'])->name('createSupplier');
    Route::post('/supplier/store', [SupplierController::class, 'storeSupplier'])->name('storeSupplier');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'editSupplier'])->name('editSupplier');
    Route::post('/supplier/update/{id}', [SupplierController::class, 'updateSupplier'])->name('updateSupplier');
    Route::delete('/supplier/delete/{id}', [SupplierController::class, 'deleteSupplier'])->name('deleteSupplier');

    //order
    Route::get('/orders', [OrderController::class, 'index'])->name('listOrder');
    Route::delete('/orders/delete/{id}', [OrderController::class, 'deleteOrder'])->name('deleteOrder');
    Route::get('/orders/{id}', [OrderController::class, 'showOrder'])->name('detailOrder');
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('updateOrderStatus');

    //diskon
    Route::get('/diskon', [DiskonController::class, 'diskonView'])->name('diskonView');
    Route::get('/diskon/create', [DiskonController::class, 'createDiskon'])->name('createDiskon');
    Route::post('/diskon/store', [DiskonController::class, 'storeDiskon'])->name('storeDiskon');
    Route::get('/diskon/edit/{id}', [DiskonController::class, 'editDiskon'])->name('editDiskon');
    Route::post('/diskon/update/{id}', [DiskonController::class, 'updateDiskon'])->name('updateDiskon');
    Route::delete('/diskon/delete/{id}', [DiskonController::class, 'deleteDiskon'])->name('deleteDiskon');
});
