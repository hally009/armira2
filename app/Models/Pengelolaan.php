<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Pengelolaan extends Model
{
    protected $table = 'pengelolaan';

    protected $fillable = [
        'periode',
        'jenis',
        'dokumen_id',
        'kategori_id',
        'kode_transaksi',
        'pengelolaan_id',
        'status_progress',
        'status_pengesahan',
        'file',
        'kepada',
    ];

    // public function pengelolaanChild()
    // {
    //     return $this->hasMany(Pengelolaan::class, 'pengelolaan_id');
    // }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    public function pengelolaanAlur()
    {
        return $this->hasMany(PengelolaanAlur::class, 'pengelolaan_id');
    }

    public function pengelolaanFile()
    {
        return $this->hasMany(PengelolaanFile::class, 'pengelolaan_id');
    }

    public function pengelolaanForm()
    {
        return $this->hasOne(PengelolaanForm::class, 'pengelolaan_id');
    }



    public function getStatusTextAttribute($value)
    {
        if($this->status_progress == 0) {
            return 'secondary';
        }

        if($this->pengelolaanAlur->last()->status == get_status_alur('ditolak')) {
            return 'danger';
        }

        if($this->pengelolaanAlur->last()->status == get_status_alur('perbaikan')) {
            return 'warning';
        }

        return 'primary';
    }

    public function getStatusIconAttribute($value)
    {
        if($this->status_progress == get_status_alur('on-progress') ) {
            return '<i class="bi bi-check text-primary"></i> ';
        }

        if($this->pengelolaanAlur->last()->status == get_status_alur('ditolak')) {
            return '<i class="bi bi-journal-x text-danger"></i>';
        }

        if($this->pengelolaanAlur->last()->status == get_status_alur('perbaikan')) {
            return '<i class="bi bi-arrow-repeat text-warning"></i>';
        }

        return '<i class="bi bi-check text-success"></i>';
    }

    public function getDokumenNameAttribute($value)
    {
        $dokumen = collect(kategori_penghapusan());
        return Arr::first($dokumen->where('id', $this->dokumen_id))['name'];
    }

    public function getKategoriNameAttribute($value)
    {
        $dokumen = collect(kategori_penghapusan());
        $kategori = collect(Arr::first($dokumen->where('id', $this->dokumen_id))['dokumen']);
        $kategori = $kategori->where('id', $this->kategori_id)->toArray();
        $kategori = data_get($kategori, '*.name');
        return $kategori[0];
    }

    public function getNextKodeAttribute($value)
    {
        $kode = $this->kode_transaksi;
        $kode += 1;
        return $kode;
    }

    public function scopeByPeriode($query, $tahun)
    {
        return $query->wherePeriode($tahun);
    }

    public function scopeByJenis($query, $jenis)
    {
        return $query->whereJenis($jenis);
    }

    public function scopeByKepada($query, $value)
    {
        return $query->whereKepada($value);
    }

    public function isDeletable()
    {
        if($this->status_progress == get_status_alur('on-progress') && $this->pengelolaanAlur->count() <= 1) {
            return true;
        }

        return false;
    }

    public function isOwner()
    {
        if($this->satker_id == auth()->user()->satker_id) {
            return true;
        }

        return false;
    }
}
