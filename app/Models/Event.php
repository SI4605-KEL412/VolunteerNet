<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'event';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'status',
    ];

    // Tentukan kolom primary key jika menggunakan selain 'id'
    protected $primaryKey = 'event_id'; // Menggunakan event_id sebagai primary key

    // Tentukan waktu format tanggal sesuai dengan field lainnya
    public $timestamps = false;
}
