<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // kalau nama tabel bukan default

    protected $primaryKey = 'UserID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'ProfileDetails',
        'ReferralCode',
    ];

    // Agar Laravel tahu kolom password mana yg digunakan
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Agar Laravel tahu kolom email mana yg digunakan
    public function getEmailForPasswordReset()
    {
        return $this->Email;
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function bookmarkedEvents()
    {
        return $this->belongsToMany(Event::class, 'Bookmarks', 'UserID', 'EventID');
    }
    
    
}
