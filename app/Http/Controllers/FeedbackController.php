<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Event; // Pastikan model Event diimport
use App\Models\User;  // Pastikan model User diimport
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Menampilkan daftar feedback
    public function index()
    {
        // Mengambil semua data feedback dengan relasi event dan user
        $feedbacks = Feedback::with('event', 'user')->get();

        // Jika feedback kosong, kembalikan tampilan dengan pesan error
        if ($feedbacks->isEmpty()) {
            return view('feedback.index')->with('error', 'Tidak ada feedback yang tersedia.');
        }

        // Mengembalikan view index dengan data feedback
        return view('feedback.index', compact('feedbacks'));
    }

    // Menampilkan form untuk membuat feedback
    public function create()
    {
        // Mengambil semua data event untuk ditampilkan di form
        $events = Event::all(); // Mengambil semua data event
        $users = User::all(); // Mengambil semua data user (jika diperlukan)

        // Mengirimkan data events ke view create
        return view('feedback.create', compact('events', 'users'));
    }

    // Menyimpan feedback baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:500',
        ]);

        // Membuat feedback baru
        Feedback::create($validated);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil ditambahkan.');
    }

    // Menampilkan detail feedback
    public function show($id)
    {
        $feedback = Feedback::with('event', 'user')->findOrFail($id);
        return view('feedback.show', compact('feedback'));
    }

    // Menampilkan form untuk mengedit feedback
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        $events = Event::all(); // Mengambil data event untuk form edit
        $users = User::all();  // Mengambil data user untuk form edit
        return view('feedback.edit', compact('feedback', 'events', 'users'));
    }

    // Menyimpan perubahan feedback
    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:500',
        ]);

        // Update feedback
        $feedback->update($validated);

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diperbarui.');
    }

    // Menghapus feedback
    public function destroy($id)
    {
        // Mencari feedback berdasarkan id dan menghapusnya
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
}