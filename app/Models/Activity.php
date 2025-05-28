<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities'; // optional, bisa ditulis untuk kejelasan
    protected $primaryKey = 'history_id'; // per database

    public $timestamps = false; // karena tidak ada created_at & updated_at

    protected $fillable = [
        'user_id',
        'action',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

