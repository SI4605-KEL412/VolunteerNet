<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactTracker extends Model
{
    protected $table = 'impacttracker';
    protected $primaryKey = 'impact_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'event_id', 'hours_contributed', 'tasks_completed', 'social_impact_score'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }
}