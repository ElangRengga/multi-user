<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Metode untuk memeriksa peran
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    


    public function isUser()
    {
        return $this->role === 'user';
    }
}


