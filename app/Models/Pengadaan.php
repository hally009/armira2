<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    protected $table = 'pengadaan';

    protected $fillable = [
        'periode',
        'nama',
        'kode_transaksi',
        'status_progress',
        'status_pengesahan',
        'status_apip',
        'kepada',
        'file',
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
    
    public function pengadaanChild()
    {
        return $this->hasMany(Pengadaan::class, 'pengadaan_id');
    }

    public function pengadaanFile()
    {
        return $this->hasMany(PengadaanFile::class, 'pengadaan_id');
    }

    public function pengadaanAlur()
    {
        return $this->hasMany(PengadaanAlur::class, 'pengadaan_id');
    }

    public function pengadaanRakbm()
    {
        return $this->hasMany(PengadaanRakbm::class, 'pengadaan_id');
    }
    
    public function scopeByPeriode($query, $tahun)
    {
        return $query->wherePeriode($tahun);
    }

    public function scopeByKepada($query, $value)
    {
        return $query->whereKepada($value);
    }

    public function scopeByStatusProgress($query, $value)
    {
        return $query->whereStatusProgress($value);
    }

    public function scopeByStatusApip($query, $value)
    {
        return $query->whereStatusApip($value);
    }

    public function getStatusTextAttribute($value)
    {
        if($this->status_progress == 0) {
            return 'secondary';
        }

        if($this->pengadaanAlur->last()->status == get_status_alur('ditolak')) {
            return 'danger';
        }

        if($this->pengadaanAlur->last()->status == get_status_alur('perbaikan')) {
            return 'warning';
        }

        return 'primary';
    }

    public function getStatusIconAttribute($value)
    {
        if($this->status_progress == get_status_alur('on-progress') ) {
            return '<i class="bi bi-check text-primary"></i> ';
        }

        if($this->pengadaanAlur->last()->status == get_status_alur('ditolak')) {
            return '<i class="bi bi-journal-x text-danger"></i>';
        }

        if($this->pengadaanAlur->last()->status == get_status_alur('perbaikan')) {
            return '<i class="bi bi-arrow-repeat text-warning"></i>';
        }

        return '<i class="bi bi-check text-success"></i>';
    }

    public function getStatusApipNameAttribute($value)
    {
        if($this->status_apip == 0) {
            return '-';
        }

        return 'Telah diperiksa';
    }

    public function getNextKodeAttribute($value)
    {
        $kode = $this->kode_transaksi;
        $kode += 1;
        return $kode;
    }

    public function isDeletable()
    {
        if($this->status_progress == get_status_alur('on-progress') && $this->pengadaanAlur->count() <= 1) {
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
