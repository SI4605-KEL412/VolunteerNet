<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralProgram extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'referralprogram';

    // Primary key tabel
    protected $primaryKey = 'referral_id';

    // Kalau tidak pakai timestamps (created_at, updated_at)
    public $timestamps = false;

    // Kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'referrer_id',
        'referred_user_id',
        'date_referred',
        'reward_earned',
    ];

    // Relasi ke User yang mereferensikan
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'user_id');
    }

    // Relasi ke User yang direferensikan
    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id', 'user_id');
    }
}
