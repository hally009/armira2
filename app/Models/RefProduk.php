<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefProduk extends Model
{
    protected $table = 'ref_produk';

    protected $fillable = [
        'nama',
        'kode_barang',
        'status',
    ];

    public function sbsk()
    {
        return $this->hasMany(Sbsk::class, 'produk_id');
    }

    public function scopeByStatus($query, $value)
    {
        return $query->whereStatus($value);
    }

    public function getStatusNameAttribute($value)
    {
        switch ($this->status) {
            case 1:
                return 'Aktif'; 
                break;
            case 0:
                return 'Non Aktif';
                break;
        }
    }
}
