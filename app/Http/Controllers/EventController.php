<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Tampilkan semua event.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua event yang tersedia
        $events = Event::all();

        // Kembalikan tampilan dengan semua event
        return view('events.index', compact('events'));
    }

    /**
     * Tampilkan detail event berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Ambil event berdasarkan event_id
        $event = Event::find($id);

        // Jika event tidak ditemukan, redirect ke halaman lain
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        // Kembalikan tampilan untuk menampilkan detail event
        return view('event.show', compact('event'));
    }

    /**
     * Tampilkan form untuk membuat event baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Proses penyimpanan event baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        // Simpan event baru
        $event = Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);

        // Redirect ke halaman event setelah berhasil disimpan
        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
    }

    /**
     * Tampilkan form untuk mengedit event.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Ambil event berdasarkan ID
        $event = Event::find($id);

        // Jika event tidak ditemukan, redirect ke halaman lain
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Proses pembaruan event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        // Ambil event berdasarkan ID
        $event = Event::find($id);

        // Jika event tidak ditemukan, redirect ke halaman lain
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        // Update data event
        $event->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);

        // Redirect ke halaman event setelah berhasil diupdate
        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Hapus event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Ambil event berdasarkan ID
        $event = Event::find($id);

        // Jika event tidak ditemukan, redirect ke halaman lain
        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        // Hapus event
        $event->delete();

        // Redirect ke halaman event setelah berhasil dihapus
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }
}
