<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'kode_pembelian',
        'tanggal',
        'supplier_id',
        'produk_id',
        'jumlah',
        'harga_satuan',
        'total',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'harga_satuan' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pembelian) {
            if (empty($pembelian->kode_pembelian)) {
                $pembelian->kode_pembelian = 'PB-' . date('Ymd') . '-' . str_pad(self::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
            $pembelian->total = $pembelian->jumlah * $pembelian->harga_satuan;
        });

        static::updating(function ($pembelian) {
            $pembelian->total = $pembelian->jumlah * $pembelian->harga_satuan;
        });
    }
}
