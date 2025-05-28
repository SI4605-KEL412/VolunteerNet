<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Forum $forum)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'forum_id' => $forum->id,
        ]);

        return redirect()->route('forums.show', $forum)
            ->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit(Comment $comment)
    {
        // Check if user is the owner
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // Check if user is the owner
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('forums.show', $comment->forum)
            ->with('success', 'Komentar berhasil diupdate!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        // Check if user is the owner
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $forum = $comment->forum;
        $comment->delete();

        return redirect()->route('forums.show', $forum)
            ->with('success', 'Komentar berhasil dihapus!');
    }
}