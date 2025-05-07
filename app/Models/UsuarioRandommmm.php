<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioRandom extends Model
{
    protected $table = 'users'; 
    protected $fillable = [
        'uuid', 'gender', 'name', 'email', 'username', 'password',
        'salt', 'md5', 'sha1', 'sha256', 'picture',
    ];
    
}
