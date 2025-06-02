<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Event; // Pastikan model Event di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
// use Illuminate\Validation\Rule; // Bisa juga digunakan jika lebih disukai

class BookmarkController extends Controller
{
    /**
     * Menampilkan semua bookmark milik pengguna yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $bookmarks = Bookmark::where('user_id', $userId)
                            ->with('event') 
                            ->latest('created_at') 
                            ->paginate(9); 

        // $unreadNotificationsCount = Auth::user()->unreadNotifications()->count(); 

        return view('bookmarks.index', compact('bookmarks' /*, 'unreadNotificationsCount'*/));
    }

    /**
     * Menyimpan bookmark baru untuk pengguna yang sedang login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input event_id
        $request->validate([
            // PERBAIKAN DI SINI: Menggunakan nama tabel 'event' dan kolom 'event_id'
            // sesuai dengan definisi di Model Event Anda.
            'event_id' => 'required|integer|exists:event,event_id',
        ]);

        $userId = Auth::id();
        $eventId = $request->input('event_id');

        $existingBookmark = Bookmark::where('user_id', $userId)
                                    ->where('event_id', $eventId)
                                    ->first();

        if ($existingBookmark) {
            return Redirect::back()->with('info', 'Event ini sudah Anda bookmark sebelumnya.');
        }

        Bookmark::create([
            'user_id' => $userId,
            'event_id' => $eventId,
        ]);

        return Redirect::route('bookmarks.index')->with('success', 'Event berhasil ditambahkan ke bookmark!');
    }

    /**
     * Menghapus bookmark milik pengguna yang sedang login.
     *
     * @param  int  $id (bookmark_id)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) 
    {
        try {
            $bookmark = Bookmark::where('bookmark_id', $id)
                                ->where('user_id', Auth::id()) 
                                ->firstOrFail();

            $bookmark->delete();

            return Redirect::route('bookmarks.index')->with('success', 'Bookmark berhasil dihapus!');

        } catch (ModelNotFoundException $e) {
            return Redirect::route('bookmarks.index')->with('error', 'Bookmark tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
        } catch (\Exception $e) {
            // \Illuminate\Support\Facades\Log::error('Gagal menghapus bookmark: ' . $e->getMessage()); 
            return Redirect::route('bookmarks.index')->with('error', 'Gagal menghapus bookmark. Silakan coba lagi.');
        }
    }
}
