<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Menentukan kolom primary key yang digunakan
    protected $primaryKey = 'user_id'; 

    // Tentukan jika kamu tidak ingin menggunakan timestamps (optional)
    public $timestamps = true; // Ini default-nya, jadi bisa dibiarkan true

    // Menentukan kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'points',       // Tambahkan kolom points supaya bisa diupdate
    ];

    // Menentukan kolom yang harus disembunyikan, seperti password dan token
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Jika kamu ingin mengubah tipe primary key (contoh: non-integer)
    protected $keyType = 'int';

    // Relasi 1-1 dengan referral program (user sebagai referrer)
    public function referralProgram()
    {
        return $this->hasOne(ReferralProgram::class, 'referrer_id', 'user_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'user_id', 'user_id');
    }

    public function bookmarkedEvents()
    {
        return $this->belongsToMany(Event::class);
    }
}
