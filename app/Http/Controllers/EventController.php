<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')?->store('events', 'public');

        Event::create([
            'title' => $request->title,
            'location' => $request->location,
            'date' => $request->date,
            'description' => $request->description,
            'status' => $request->status ?? 'Active',
            'image' => $imagePath,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
{
    return view('events.show', compact('event'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $event->image = $imagePath;
        }

        $event->update($request->only(['title', 'location', 'date', 'description', 'status']));

        return redirect()->route('events.index')->with('success', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted!');
    }
}
