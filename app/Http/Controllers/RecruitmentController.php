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
            $query->where('organizer_id', $userId); // EO hanya bisa lihat event miliknya
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

        return redirect()->route('eo.recruitment.index')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    // ===========================
    // Fitur User (Peserta)
    // ===========================

    // Menampilkan daftar event & status pendaftaran user yang login
    public function userIndex()
    {
        $userId = auth()->id();
        $events = Event::orderBy('start_date')->get();

        // Ambil semua recruitment milik user, keyBy event_id untuk akses cepat
        $userRecruitments = Recruitment::where('user_id', $userId)->get()->keyBy('event_id');

        return view('recruitmentUser.index', compact('events', 'userRecruitments'));
    }

    // Menampilkan form pendaftaran event untuk user
    public function userCreate(Request $request)
    {
        $events = Event::orderBy('start_date')->get();
        $selectedEventId = $request->event_id ?? null;

        return view('recruitmentUser.create', compact('events', 'selectedEventId'));
    }

    // Menyimpan pendaftaran baru dari user
    public function userStore(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:event,event_id',
            'motivation' => 'required|string|max:1000',
        ]);

        // Cek apakah user sudah pernah daftar event ini
        $exists = Recruitment::where('user_id', auth()->id())
            ->where('event_id', $request->event_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Kamu sudah mendaftar event ini.');
        }

        $recruitment = new Recruitment();
        $recruitment->user_id = auth()->id();
        $recruitment->event_id = $request->event_id;
        $recruitment->motivation = $request->motivation;
        $recruitment->date_applied = now();
        $recruitment->status = 'pending';
        $recruitment->save();

        return redirect()->route('recruitmentUser.index')->with('success', 'Pendaftaran berhasil dibuat.');
    }

    // Menampilkan detail pendaftaran user
    public function userShow($id)
    {
        $userId = auth()->id();
        $recruitment = Recruitment::where('user_id', $userId)
            ->with('event')
            ->findOrFail($id);

        return view('recruitmentUser.show', compact('recruitment'));
    }

    // Menampilkan form edit motivasi pendaftaran user
    public function userEdit($id)
    {
        $userId = auth()->id();
        $recruitment = Recruitment::where('user_id', $userId)
            ->with('event')
            ->findOrFail($id);

        return view('recruitmentUser.edit', compact('recruitment'));
    }

    // Update motivasi pendaftaran user
    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'motivation' => 'required|string|max:1000',
        ]);

        $userId = auth()->id();
        $recruitment = Recruitment::where('user_id', $userId)->findOrFail($id);

        // Hanya boleh update jika status masih pending
        if ($recruitment->status !== 'pending') {
            return redirect()->route('recruitmentUser.index')->with('error', 'Pendaftaran sudah diproses, tidak bisa diedit.');
        }

        $recruitment->motivation = $request->motivation;
        $recruitment->save();

        return redirect()->route('recruitmentUser.show', $recruitment->recruitment_id)->with('success', 'Motivasi berhasil diperbarui.');
    }

    // Hapus pendaftaran user
    public function userDestroy($id)
    {
        $userId = auth()->id();
        $recruitment = Recruitment::where('user_id', $userId)->findOrFail($id);

        // Hanya boleh hapus jika status masih pending
        if ($recruitment->status !== 'pending') {
            return redirect()->route('recruitmentUser.index')->with('error', 'Pendaftaran sudah diproses, tidak bisa dihapus.');
        }

        $recruitment->delete();

        return redirect()->route('recruitmentUser.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
}