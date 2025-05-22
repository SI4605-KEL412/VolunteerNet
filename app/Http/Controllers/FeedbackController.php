<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // Menampilkan daftar feedback
    public function index()
    {
        $feedbacks = Feedback::with('event', 'user')->get();

        if ($feedbacks->isEmpty()) {
            return view('feedback.index')->with('error', 'Tidak ada feedback yang tersedia.');
        }

        return view('feedback.index', compact('feedbacks'));
    }

    // Menampilkan form untuk membuat feedback
    public function create()
    {
        // Ambil semua event yang tersedia
        $events = Event::all();

        return view('feedback.create', compact('events'));
    }

    // Menyimpan feedback baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id'   => 'required|exists:event,event_id',
            'rating'     => 'required|numeric|min:0|max:5',
            'comments'   => 'nullable|string|max:500',
            'date_given' => 'required|date',
        ]);

        // Tentukan user yang memberi feedback dari user yang sedang login
        $validated['user_id'] = Auth::id();

        Feedback::create($validated);

        return redirect()->route('feedback.index')
                         ->with('success', 'Feedback berhasil ditambahkan.');
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
        $events   = Event::all();

        return view('feedback.edit', compact('feedback', 'events'));
    }

    // Menyimpan perubahan feedback
    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $validated = $request->validate([
            'event_id'   => 'required|exists:event,event_id',
            'rating'     => 'required|numeric|min:0|max:5',
            'comments'   => 'nullable|string|max:500',
            'date_given' => 'required|date',
        ]);

        $feedback->update($validated);

        return redirect()->route('feedback.index')
                         ->with('success', 'Feedback berhasil diperbarui.');
    }

    // Menghapus feedback
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')
                         ->with('success', 'Feedback berhasil dihapus.');
    }
}