<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengadaanTemp extends Model
{
    protected $table = 'pengadaan_temp';

    protected $casts = [
        'file' => 'array',
        'usulan_rakbm' => 'array',
    ];

    protected $fillable = [
        'satker_id',
        'periode',
        'nama_usulan',
        'usulan_rakbm',
        'file'
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    public function scopeByPeriode($query, $tahun)
    {
        return $query->wherePeriode($tahun);
    }

    public function getStepAttribute($value)
    {

        if(!$this->usulan_rakbm) {
            return 0;
        }
        
        if(!$this->file) {
            return 1;
        }

        return 2;
    }

    public function getUsulanViewAttribute($value)
    {
        return json_decode($this->usulan_rakbm, true);
    }
}
