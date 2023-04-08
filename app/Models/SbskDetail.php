<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SbskDetail extends Model
{
    protected $table = 'sbsk_detail';

    protected $fillable = [
        'sbsk_id',
        'struktur_id',
        'total',
    ];
}
