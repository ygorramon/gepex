<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
    protected $fillable = [
        'name', 'initials',
    ];

    public function servidores()
    {
        return $this->belongsToMany(\App\User::class, 'secretary_user');
    }

    public function gepexes(){
        return $this->hasMany(\App\Models\Gepex::class);
    }
}
