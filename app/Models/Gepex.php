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

    public function steps()
    {
        return $this->belongsToMany(\App\Models\Step::class, 'gepex_step')->withPivot('finished','id','completion_date');
    }
}
