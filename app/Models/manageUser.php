<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class manageUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    // Menentukan kolom primary key yang digunakan
    protected $primaryKey = 'user_id';

    // Aktifkan timestamps (created_at dan updated_at)
    public $timestamps = true;

    // Kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'name', 'email', 'password', 'role', 'profiledetails',
    ];

    // Kolom yang harus disembunyikan
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Tipe primary key
    protected $keyType = 'int';
}
