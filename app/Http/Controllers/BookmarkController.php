<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Untuk bookmark atau unbookmark event
    public function toggle(Event $event)
    {
        $user = \App\Models\User::find(1);
    
        if ($user->bookmarkedEvents()->where('event_id', $event->id)->exists()) {
            $user->bookmarkedEvents()->detach($event->id);
            return back()->with('status', 'Bookmark dihapus.');
        } else {
            $user->bookmarkedEvents()->attach($event->id);
            return back()->with('status', 'Event berhasil di-bookmark.');
        }
    }

    // Untuk menampilkan halaman list bookmark
    public function index()
    {
        $user = \App\Models\User::find(1); // Ganti dengan user yang kamu mau pakai untuk test
        $bookmarkedEvents = $user->bookmarkedEvents()->latest()->get();
    
        return view('bookmarks.index', compact('bookmarkedEvents'));
    }
    
}
    
