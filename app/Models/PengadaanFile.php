<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengadaanFile extends Model
{
    protected $table = 'pengadaan_file';

    protected $fillable = [
        'name',
        'file',
    ];
}
