<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefStruktur extends Model
{
    protected $table = 'ref_struktur';

    protected $fillable = [
        'nama',
    ];

    public function struktur()
    {
        return $this->hasMany(SatkerStruktur::class, 'struktur_id');
    }
}
