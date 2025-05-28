<!-- filepath: resources/views/impacttracker/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Penilaian Impact Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Penilaian Impact: {{ $event->name }}</h3>
    <form method="POST" action="{{ route('impacttracker.eo.store', $event->event_id) }}">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Jam Kontribusi</th>
                    <th>Tugas Selesai</th>
                    <th>Social Impact Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @php
                        $impact = $user->impacttracker->where('event_id', $event->event_id)->first();
                    @endphp
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            <input type="number" step="0.1" name="users[{{ $user->user_id }}][hours_contributed]" value="{{ $impact->hours_contributed ?? '' }}" class="form-control">
                        </td>
                        <td>
                            <input type="number" name="users[{{ $user->user_id }}][tasks_completed]" value="{{ $impact->tasks_completed ?? '' }}" class="form-control">
                        </td>
                        <td>
                            <input type="number" step="0.1" name="users[{{ $user->user_id }}][social_impact_score]" value="{{ $impact->social_impact_score ?? '' }}" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('impacttracker.eo.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>