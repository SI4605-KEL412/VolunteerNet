<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect; 

class BookmarkController extends Controller
{
    // Menampilkan semua bookmark user
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())->with('event')->latest()->get();
        return view('bookmarks.index', compact('bookmarks'));
    }

    // Menyimpan bookmark baru
    public function store(Request $request)
    {
        $userId = auth()->id();
        $eventId = $request->input('event_id');

        // Cek apakah sudah ada bookmark
        $exists = \App\Models\Bookmark::where('user_id', $userId)
            ->where('event_id', $eventId)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already bookmarked'], 409);
        }

        \App\Models\Bookmark::create([
            'user_id' => $userId,
            'event_id' => $eventId,
        ]);

        return response()->json(['message' => 'Bookmarked']);
    }

    // Menghapus bookmark
    public function destroy($id)
    {
        try {
            // Mencari bookmark berdasarkan bookmark_id dan user_id yang sedang login.
            // Jika tidak ditemukan, akan otomatis melempar 404.
            $bookmark = Bookmark::where('bookmark_id', $id)->where('user_id', Auth::id())->firstOrFail();

            // Menghapus bookmark.
            $bookmark->delete();

            // Mengarahkan kembali ke halaman daftar bookmark dengan pesan sukses.
            return Redirect::route('bookmarks.index')->with('success', 'Bookmark berhasil dihapus!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika bookmark tidak ditemukan (misalnya ID salah atau bukan milik user),
            // arahkan kembali dengan pesan error.
            return Redirect::back()->with('error', 'Bookmark tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
        } catch (\Exception $e) {
            // Tangani error lain yang mungkin terjadi saat penghapusan.
            return Redirect::back()->with('error', 'Gagal menghapus bookmark: ' . $e->getMessage());
        }
    }
}