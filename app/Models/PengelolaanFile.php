<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengelolaanFile extends Model
{
    protected $table = 'pengelolaan_file';

    protected $fillable = [
        'name',
        'file',
    ];
}
