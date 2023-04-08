<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengadaanRakbm extends Model
{
    protected $table = 'pengadaan_rakbm';

    protected $fillable = [
        'pengadaan_id',
        'produk_id',
        'sbsk_bmn',
        'existing_bmn',
        'kebutuhan',
        'total',
        'peluang_setuju',
        'uapb',
        'apip',
        'status',
        'keterangan'
    ];

    public function produk()
    {
        return $this->belongsTo(RefProduk::class, 'produk_id');
    }

    public function scopeByStatus($query, $value)
    {
        return $query->whereStatus($value);
    }
}
