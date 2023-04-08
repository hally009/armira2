<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefPeriode extends Model
{
    protected $table = 'ref_periode';

    protected $fillable = [
        'nama',
        'tahun',
        'status',
    ];

    public function getStatusNameAttribute($value)
    {
        switch ($this->status) {
            case 1:
                return 'Aktif'; 
                break;
            case 0:
                return 'Non Aktif';
                break;
        }
    }

    public function scopeByStatus($query, $value)
    {
        return $query->whereStatus($value);
    }
}