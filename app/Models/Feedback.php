<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'rating',
        'comments',
        'date_given',
    ];

    public $timestamps = false;

    /**
     * Relasi ke User (feedback diberikan oleh user tertentu)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Relasi ke Event (feedback terkait event tertentu)
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}