<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapAset extends Model
{
    protected $table = 'rekap_aset';

    protected $fillable = [
        'satker_id',
        'baik',
        'rusak_ringan',
        'rusak_berat'
    ];
}
