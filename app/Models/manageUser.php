<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class manageUser extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'manageUser';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'skills',
        'points',
        'phone',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'skills' => 'array',
    ];


    public function isVolunteer()
    {
        return $this->role === 'volunteer';
    }


    public function isActive()
    {
        return $this->status === 'active';
    }
}
