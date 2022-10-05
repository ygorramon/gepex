<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gepex extends Model
{
    protected $fillable = [
        'uid', 'needs',  'completion_date', 'secretary_id', 'priority', 'status','obs'
    ];

    public function secretary()
    {
        return $this->belongsTo(\App\Models\Secretary::class);
    }

    public function steps()
    {
        return $this->belongsToMany(\App\Models\Step::class, 'gepex_step')->withPivot('finished','id','completion_date','obs','prevision_date');
    }

    public function steps_todas()
    {
        return $this->hasManyThrough("App\Models\Gepex", "App\Models\Step");
    }
}
