<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the forums.
     */
    public function index()
    {
        $forums = Forum::with('user', 'comments')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('forums.index', compact('forums'));
    }

    /**
     * Show the form for creating a new forum.
     */
    public function create()
    {
        return view('forums.create');
    }

    /**
     * Store a newly created forum in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Forum::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('forums.index')
            ->with('success', 'Forum berhasil dibuat!');
    }

    /**
     * Display the specified forum.
     */
    public function show(Forum $forum)
    {
        $forum->load(['user', 'comments.user']);
        return view('forums.show', compact('forum'));
    }

    /**
     * Show the form for editing the specified forum.
     */
    public function edit(Forum $forum)
    {
        // Check if user is the owner
        if ($forum->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('forums.edit', compact('forum'));
    }

    /**
     * Update the specified forum in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        // Check if user is the owner
        if ($forum->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $forum->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forums.show', $forum)
            ->with('success', 'Forum berhasil diupdate!');
    }

    /**
     * Remove the specified forum from storage.
     */
    public function destroy(Forum $forum)
    {
        // Check if user is the owner
        if ($forum->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $forum->delete();

        return redirect()->route('forums.index')
            ->with('success', 'Forum berhasil dihapus!');
    }
}