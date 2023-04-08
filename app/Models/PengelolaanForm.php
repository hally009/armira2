<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengelolaanForm extends Model
{
    protected $table = 'pengelolaan_form';

    protected $casts = [
        'form' => 'Array',
    ];

    protected $fillable = [
        'form'
    ];
}
