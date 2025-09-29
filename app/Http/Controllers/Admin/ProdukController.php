<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
     public function produkView()
    {
        $items = Produk::latest()->paginate(10);
        return view('backend.produk.item_produk', compact('items'));
    }
}
