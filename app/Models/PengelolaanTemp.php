<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengelolaanTemp extends Model
{
    protected $table = 'pengelolaan_temp';

    protected $casts = [
        'file' => 'array',
        'form' => 'array',
    ];

    protected $fillable = [
        'periode',
        'jenis',
        'dokumen_id',
        'kategori_id',
        'form',
        'file',
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    public function scopeByPeriode($query, $tahun)
    {
        return $query->wherePeriode($tahun);
    }

    public function scopeByJenis($query, $jenis)
    {
        return $query->whereJenis($jenis);
    }

    public function scopeByDokumen($query, $jenis)
    {
        return $query->whereDokumenId($jenis);
    }

    public function scopeByKategori($query, $jenis)
    {
        return $query->whereKategoriId($jenis);
    }
    
    public function getStepAttribute($value)
    {

        if(!$this->form) {
            return 0;
        }
        
        if(!$this->file) {
            return 1;
        }

        return 2;
    }

    public function getFormViewAttribute($value)
    {
        return json_decode($this->form, true);
    }
}
