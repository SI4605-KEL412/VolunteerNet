<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method untuk menampilkan dashboard user
    public function userDashboard()
    {
        // Ambil data 3 event terbaru dari database
        $events = Event::orderBy('start_date', 'desc')->limit(3)->get();

        // Ambil nama user yang sedang login
        $userName = auth()->user()->name;

        // Kirim data ke view dashboard user
        return view('user.dashboard', compact('events', 'userName'));
    }

    public function eoDashboard()
{
    $userName = auth()->user()->name;

    $events = Event::orderBy('start_date', 'desc')->limit(3)->get();

    return view('admin.dashboard', compact('events', 'userName'));
}

}
