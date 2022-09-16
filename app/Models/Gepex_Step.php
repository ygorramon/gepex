<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gepex_Step extends Model
{
    protected $table = 'gepex_step';

    public function gepex(){
        return $this->belongsTo(Gepex::class);
    }
    
    public function step(){
        return $this->belongsTo(Step::class);
    }
}
