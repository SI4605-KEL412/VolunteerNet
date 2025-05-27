<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\User;

class Recruitment extends Model
{
    // Menyesuaikan nama tabel di database
    protected $table = 'recruitment';

    // Menyesuaikan primary key
    protected $primaryKey = 'recruitment_id';

    // Menonaktifkan timestamps karena tidak ada kolom created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'motivation',
        'admin_notes',
        'date_applied',
    ];

    // Relasi ke event (yang dibuat EO)
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    // Relasi ke user (relawan yang mendaftar)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
        // catatan: biasanya User model pakai 'id' sebagai PK, kalau beda, sesuaikan di sini
    }
}