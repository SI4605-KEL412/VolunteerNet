<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';
    protected $primaryKey = 'notif_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'message',
        'date_sent',
        'status'
    ];

    /**
     * Mark notification as read
     *
     * @return bool
     */
    public function markAsRead()
    {
        $this->status = 'read';
        return $this->save();
    }

    /**
     * Send notification to user
     *
     * @param int $userId
     * @param string $message
     * @return Notification
     */
    public static function sendNotification($userId, $message)
    {
        return self::create([
            'user_id' => $userId,
            'message' => $message,
            'date_sent' => now(),
            'status' => 'unread'
        ]);
    }

    /**
     * Get the user that owns the notification
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $casts = [
    'date_sent' => 'datetime',
    ];

}
