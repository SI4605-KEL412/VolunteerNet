<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Event;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::with('event') 
            ->where('user_id', auth()->id())
            ->get();
        return view('bookmarks.index', compact('bookmarks'));
    }

    public function toggle(Event $event)
    {
        // Validasi event_id
        if (!$event || !$event->id) {
            return back()->with('error', 'Event tidak ditemukan.');
        }

        $bookmark = Bookmark::where('user_id', auth()->id())
                           ->where('event_id', $event->id)
                           ->first();

        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Event dihapus dari bookmark.');
        }

        // Pastikan semua data terisi
        $data = [
            'user_id' => auth()->id(),
            'event_id' => $event->id,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Bookmark::create($data);

        return back()->with('success', 'Event berhasil ditambahkan ke bookmark.');
    }

    public function destroy(Bookmark $bookmark)
    {
        $bookmark->delete();
        return redirect()->route('bookmarks.index')
                        ->with('success', 'Bookmark berhasil dihapus.');
    }
}
    
