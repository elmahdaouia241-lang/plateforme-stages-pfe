<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status'
    ];

    protected $hidden = ['password'];

    public function etudiant()
    {
        return $this->hasOne(Etudiant::class);
    }

    public function encadrant()
    {
        return $this->hasOne(Encadrant::class);
    }
}
