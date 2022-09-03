<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gepex extends Model
{
    protected $fillable = [
        'uid', 'needs', 'strategies', 'goals', 'completion_date', 'secretary_id', 'priority', 'status'
    ];

    public function secretary()
    {
        return $this->belongsTo(\App\Models\Secretary::class);
    }
}
