<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SatkerStruktur extends Model
{
    protected $table = 'satker_struktur';

    protected $fillable = [
        'struktur_id',
        'total',
    ];
    
    public function scopeBySatker($query, $id)
    {
        return $query->whereSatkerId($id);
    }

    public function satker()
    {
        return $this->belongsTo(SatkerStruktur::class, 'satker_id');
    }

    public function ref()
    {
        return $this->belongsTo(RefStruktur::class, 'struktur_id');
    }
}
