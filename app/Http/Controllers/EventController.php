<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Tampilkan semua event.
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    /**
     * Tampilkan form pembuatan event baru.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Simpan event baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,approved,rejected',
            'organizer_id' => 'nullable|integer',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
    }

    /**
     * Tampilkan detail event.
     */
    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        return view('events.show', compact('event'));
    }

    /**
     * Tampilkan form edit event.
     */
    public function edit($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update data event.
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,approved,rejected',
            'organizer_id' => 'nullable|integer',
        ]);

        $event->update($request->all());

        return redirect()->route('event.show', $id)->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Hapus event dari database.
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events.index')->with('error', 'Event tidak ditemukan.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }
}