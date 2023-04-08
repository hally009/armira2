<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sbsk extends Model
{
    protected $table = 'sbsk';

    protected $fillable = [
        'produk_id',
        'struktur_id',
        'total',
    ];

    public function produk()
    {
        return $this->belongsTo(RefProduk::class, 'produk_id');
    }
}
