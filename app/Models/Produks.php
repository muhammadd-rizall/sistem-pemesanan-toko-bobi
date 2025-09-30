<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Produks extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $guarded = ['id'];

}
