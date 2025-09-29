<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    // Definisikan kolom yang boleh diisi
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'gambar_produk',
    ];

    // Jika nama primary key bukan 'id'
    protected $primaryKey = 'id_produk';
}
