<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function index()
    {
        // Get all notifications for admin view
        $notifications = Notification::with('user')->orderBy('date_sent', 'desc')->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        // Get all users for selection
        $users = User::where('role', 'user')->get();
        return view('admin.notifications.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'message' => 'required|string'
        ]);

        // Send notification
        Notification::sendNotification($request->user_id, $request->message);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification sent successfully!');
    }

    public function bulkCreate()
    {
        return view('admin.notifications.bulk');
    }

    public function bulkStore(Request $request)
    {
        // Validate request
        $request->validate([
            'message' => 'required|string'
        ]);

        // Get all users with 'user' role
        $users = User::where('role', 'user')->get();

        // Send notification to all users
        foreach ($users as $user) {
            Notification::sendNotification($user->user_id, $request->message);
        }

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Bulk notifications sent successfully!');
    }
}
