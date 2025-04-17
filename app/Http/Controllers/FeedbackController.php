<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedbacks.
     */
    public function index()
    {
        // Mengambil semua feedback dari database
        $feedbacks = Feedback::paginate(10); // Menampilkan 10 data per halaman
        
        // Mengembalikan tampilan dengan data feedback
        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new feedback.
     */
    public function create()
    {
        // Menampilkan halaman form untuk mengisi feedback
        return view('feedback.create');
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'volunteer_name' => 'required|string|max:255',
            'feedback' => 'required|string',
        ]);

        // Membuat feedback baru dan menyimpannya ke database
        Feedback::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'volunteer_name' => $request->volunteer_name,
            'feedback' => $request->feedback,
        ]);

        // Mengarahkan ke halaman feedback setelah berhasil menyimpan
        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil disimpan.');
    }

    /**
     * Display the specified feedback.
     */
    public function show(int $id)
    {
        // Mencari feedback berdasarkan ID
        $feedback = Feedback::findOrFail($id);

        // Menampilkan detail feedback
        return view('feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified feedback.
     */
    public function edit(string $id)
    {
        // Mencari feedback berdasarkan ID untuk diedit
        $feedback = Feedback::findOrFail($id);

        // Menampilkan halaman edit dengan data feedback
        return view('feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified feedback in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'volunteer_name' => 'required|string|max:255',
            'feedback' => 'required|string',
        ]);

        // Mencari feedback yang akan diupdate
        $feedback = Feedback::findOrFail($id);

        // Mengupdate data feedback
        $feedback->update([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'volunteer_name' => $request->volunteer_name,
            'feedback' => $request->feedback,
        ]);

        // Mengarahkan kembali ke halaman feedback setelah berhasil update
        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil diperbarui.');
    }

    /**
     * Remove the specified feedback from storage.
     */
    public function destroy(string $id)
    {
        // Mencari feedback berdasarkan ID
        $feedback = Feedback::findOrFail($id);

        // Menghapus feedback dari database
        $feedback->delete();

        // Mengarahkan kembali ke halaman feedback setelah berhasil dihapus
        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
    public function dashboard()
    {
    return view('dashboard');
    }
}
