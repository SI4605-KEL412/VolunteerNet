<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImpactTracker;
use App\Models\Event;
use App\Models\User;

class ImpactTrackerController extends Controller
{
    // EO: List event yang bisa dinilai
    public function eoIndex()
    {
        $events = Event::where('organizer_id', auth()->id())->get();
        return view('impacttracker.eo_index', compact('events'));
    }

    // EO: Form penilaian impact tracker untuk event tertentu
    public function create($event_id)
    {
        $event = Event::findOrFail($event_id);
        $users = User::whereHas('events', function($q) use ($event_id) {
            $q->where('event.event_id', $event_id);
        })->get();
        return view('impacttracker.create', compact('event', 'users'));
    }

    // EO: Simpan penilaian
    public function store(Request $request, $event_id)
    {
        foreach ($request->input('users', []) as $user_id => $data) {
            ImpactTracker::updateOrCreate(
                ['user_id' => $user_id, 'event_id' => $event_id],
                [
                    'hours_contributed' => $data['hours_contributed'],
                    'tasks_completed' => $data['tasks_completed'],
                    'social_impact_score' => $data['social_impact_score'],
                ]
            );
        }
        return redirect()->route('impacttracker.eo.index')->with('success', 'Impact tracker updated!');
    }

    // User: Lihat impact tracker miliknya
    public function userIndex()
    {
        $impacts = ImpactTracker::with('event')
            ->where('user_id', auth()->id())
            ->get();
        return view('impacttracker.user_index', compact('impacts'));
    }
}