<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::with(['referralProgram'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Update only the name of the user.
     */
    public function updateName(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('users.show', $id)->with('success', 'Nama berhasil diperbarui!');
    }
}