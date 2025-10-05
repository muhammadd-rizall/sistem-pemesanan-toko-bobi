<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Produks extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
