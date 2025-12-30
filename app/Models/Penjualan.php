<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'kode_penjualan',
        'tanggal',
        'produk_id',
        'jumlah',
        'harga_satuan',
        'total',
        'pembeli',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'harga_satuan' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($penjualan) {
            if (empty($penjualan->kode_penjualan)) {
                $penjualan->kode_penjualan = 'PJ-' . date('Ymd') . '-' . str_pad(self::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
            $penjualan->total = $penjualan->jumlah * $penjualan->harga_satuan;
        });

        static::updating(function ($penjualan) {
            $penjualan->total = $penjualan->jumlah * $penjualan->harga_satuan;
        });
    }
}
