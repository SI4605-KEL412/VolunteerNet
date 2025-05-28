<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\User;
use App\Models\Event;
use PDF;

class CertificationController extends Controller
{
    // Menampilkan semua sertifikat milik user
    public function index()
{
    $user = auth()->user();
    $certifications = Certification::where('user_id', $user->user_id)->get();

    return view('certifications.index', compact('certifications'));
}

public function store(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:event,event_id',
        'title' => 'required|string|max:255',
        'issued_date' => 'required|date',
    ]);

    $user = auth()->user();

    Certification::create([
        'user_id' => $user->user_id,
        'event_id' => $request->event_id,
        'title' => $request->title,
        'issued_date' => $request->issued_date,
    ]);

    return redirect()->route('certifications.index')->with('success', 'Sertifikat berhasil ditambahkan!');
}


    // Generate sertifikat dan simpan
    public function generate($event_id)
{
    $user = auth()->user();
    $event = Event::findOrFail($event_id);

    // Cek apakah user sudah punya sertifikat event ini
    $existing = Certification::where('user_id', $user->user_id)
        ->where('event_id', $event_id)
        ->first();

    if ($existing) {
        return redirect()->back()->with('error', 'Sertifikat sudah dibuat.');
    }

    // Simpan data ke DB
    Certification::create([
        'user_id' => $user->user_id,
        'event_id' => $event_id,
        'title' => 'Sertifikat Partisipasi Volunteer',
        'issued_date' => now(),
    ]);

    return redirect()->route('certifications.index')->with('success', 'Sertifikat berhasil dibuat.');
}
public function showAllEvents()
{
    $user = auth()->user();
    $events = Event::all(); // Ambil semua event
    $certifications = Certification::where('user_id', $user->user_id)->get();

    return view('certifications.events', compact('events', 'certifications'));
}
public function destroy($id)
{
    $cert = Certification::findOrFail($id);
    $cert->delete();

    return redirect()->route('certifications.index')->with('success', 'Sertifikat berhasil dihapus.');
}


}
