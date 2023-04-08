<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsetBmn extends Model
{
    protected $table = 'aset_bmn';
    protected $casts = [
        'content' => 'json',
    ];

    protected $fillable = [
        'file',
        'file_temp',
        'content',
    ];

    public function scopeBySatker($query, $satker)
    {
        return $query->whereSatkerId($satker);
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }
    
}
