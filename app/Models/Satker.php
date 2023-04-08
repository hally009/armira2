<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    protected $table = 'satker';

    protected $fillable = [
        'kode',
        'name',
        'alamat',
        'djkn',
        'kpknl',
        'pejabat_pengesahan',
        'role',
    ];

    public function user()
    {
        return $this->hasOne(\App\User::class, 'satker_id');
    }

    public function struktur()
    {
        return $this->hasMany(SatkerStruktur::class, 'satker_id');
    }

    public function aset()
    {
        return $this->hasOne(AsetBmn::class, 'satker_id');
    }

    public function pengelolaan()
    {
        return $this->hasMany(Pengelolaan::class, 'satker_id');
    }

    public function pengelolaanTemp()
    {
        return $this->hasMany(PengelolaanTemp::class, 'satker_id');
    }

    public function pengadaan()
    {
        return $this->hasMany(Pengadaan::class, 'satker_id');
    }

    public function pengadaanTemp()
    {
        return $this->hasMany(PengadaanTemp::class, 'satker_id');
    }

    public function scopeByRole($query, $value)
    {
        return $query->whereRole($value);
    }
}
