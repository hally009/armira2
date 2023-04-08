<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengelolaanAlur extends Model
{
    protected $table = 'pengelolaan_alur';

    protected $fillable = [
        'sequence',
        'status',
        'keterangan',
        'tanggal_status',
        'kepada',
        'dari',
    ];

    public function getKepadaNameAttribute($value)
    {
        switch($this->kepada) {
            case '1':
                return 'Satker';
            case '2':
                return 'UAPB';
            case '3':
                return 'APIP';
        }
    }
    
}
