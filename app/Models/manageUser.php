<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class manageUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'profiledetails',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
