<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    public function index(Request $request)
    {
        // Get all notifications for the logged-in user
        $user = $request->user();
        $notifications = Notification::where('user_id', $user->user_id)
            ->orderBy('date_sent', 'desc')
            ->get();

        $unreadCount = $notifications->where('status', 'unread')->count();

        return view('user.notifications.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead(Request $request, $id)
    {
        $user = $request->user();
        $notification = Notification::where('notif_id', $id)
            ->where('user_id', $user->user_id)
            ->firstOrFail();

        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marked as read');
    }

    public function markAllAsRead(Request $request)
    {
        $user = $request->user();
        $notifications = Notification::where('user_id', $user->user_id)
            ->where('status', 'unread')
            ->get();

        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'All notifications marked as read');
    }
}
