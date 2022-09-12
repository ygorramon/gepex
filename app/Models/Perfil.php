<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function servidores()
    {
        return $this->belongsToMany(\App\User::class, 'perfil_user');
    }
}
