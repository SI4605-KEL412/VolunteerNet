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

    // Tentukan jika kamu tidak ingin menggunakan timestamps (optional)
    public $timestamps = true; // Ini default-nya, jadi bisa dibiarkan true

    // Menentukan kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'name', 'email', 'password', 'role', 'profile_detail',
    ];

    // Menentukan kolom yang harus disembunyikan, seperti password dan token
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Jika kamu ingin mengubah tipe primary key (contoh: non-integer)
    protected $keyType = 'int';
}
