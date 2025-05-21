<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}