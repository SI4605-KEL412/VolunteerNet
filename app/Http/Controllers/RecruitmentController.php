<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recruitment;
use App\Models\Event;

class RecruitmentController extends Controller
{
    // ===========================
    // Fitur EO (Event Organizer)
    // ===========================

    // Menampilkan semua recruitment untuk event milik EO yang login
    public function index()
    {
        $userId = auth()->id(); // ID EO yang login

        $recruitments = Recruitment::whereHas('event', function ($query) use ($userId) {
            $query->where('user_id', $userId); // EO hanya bisa lihat event miliknya
        })->with(['event', 'user'])->orderByDesc('date_applied')->get();

        return view('recruitmentEO.index', compact('recruitments'));
    }

    // Menampilkan detail satu pendaftaran untuk EO
    public function show($id)
    {
        $recruitment = Recruitment::with(['event', 'user'])->findOrFail($id);
        return view('recruitmentEO.show', compact('recruitment'));
    }

    // Menampilkan form edit status (acc/tolak) untuk EO
    public function edit($id)
    {
        $recruitment = Recruitment::with(['event', 'user'])->findOrFail($id);
        return view('recruitmentEO.edit', compact('recruitment'));
    }

    // Menyimpan perubahan status dan catatan admin untuk EO
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $recruitment = Recruitment::findOrFail($id);
        $recruitment->status = $request->status;
        $recruitment->admin_notes = $request->admin_notes;
        $recruitment->save();

        return redirect()->route('recruitmentEO.index')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    // ===========================
    // Fitur User (Peserta)
    // ===========================

    // Menampilkan daftar pendaftaran user yang login
    public function userIndex()
    {
        $userId = auth()->id();

        $recruitments = Recruitment::where('user_id', $userId)
            ->with('event')
            ->orderByDesc('date_applied')
            ->get();

        return view('recruitmentUser.index', compact('recruitments'));
    }

    // Menampilkan form pendaftaran baru oleh user
    public function create()
    {
        // Ambil semua event yang tersedia (pastikan table dan kolomnya sesuai)
        $events = Event::orderBy('date')->get();

        return view('recruitmentUser.create', compact('events'));
    }

    // Simpan pendaftaran baru dari user
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id', // sesuaikan 'event_id' sesuai primary key tabel events kamu
            // Jika ada field lain, tambahkan validasi di sini
        ]);

        $recruitment = new Recruitment();
        $recruitment->user_id = auth()->id();
        $recruitment->event_id = $request->event_id;
        $recruitment->date_applied = now();
        $recruitment->status = 'pending'; // status default pendaftaran baru
        // Isi field lain jika diperlukan, misal motivation, dll
        $recruitment->save();

        return redirect()->route('recruitmentUser.index')->with('success', 'Pendaftaran berhasil dibuat.');
    }
}
     