<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPembelian extends Model
{
    use HasFactory;
    protected $table = 'laporan_pembelians';
    protected $guarded = ['id'];
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
