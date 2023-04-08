<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'role',
        'dari',
        'satker_id',
        'link',
        'content',
        'status',
        'url_id'
    ];

    public function scopeByRole($query, $value)
    {
        return $query->whereRole($value);
    }

    public function scopeBySatker($query, $value)
    {
        return $query->whereSatkerId($value);
    }

    public function scopeByStatus($query, $value)
    {
        return $query->whereStatus($value);
    }

    public function scopeByUrl($query, $value)
    {
        return $query->whereUrlId($value);
    }

    public function scopeByDari($query, $value)
    {
        return $query->whereDari($value);
    }

    public function getDariNameAttribute($value)
    {
        if($this->dari == roles('satker')) {
            return 'Satker';
        }

        if($this->dari == roles('uapb')) {
            return 'UAPB';
        }

        if($this->dari == roles('apip')) {
            return 'APIP';
        }
        
    }
}
