<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certification';
    protected $primaryKey = 'cert_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'event_id',
        'title',
        'issued_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}
