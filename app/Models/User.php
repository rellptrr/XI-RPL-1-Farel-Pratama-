<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
    'nama_lengkap', 
    'username',
    'password',
    'role',
    'is_active',
];

    protected $hidden = ['password'];
}