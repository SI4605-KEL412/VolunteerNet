<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\User;

class Recruitment extends Model
{
    // Nama tabel di database
    protected $table = 'recruitment';

    // Primary key
    protected $primaryKey = 'recruitment_id';

    // Tidak menggunakan timestamps
    public $timestamps = false;

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'motivation',
        'admin_notes',
        'date_applied',
    ];

    // Relasi ke event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}