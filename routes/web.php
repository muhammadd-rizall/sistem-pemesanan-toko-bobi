<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProductController;


Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');


Route::get('/coba', function () {
    return view('coba');
});
