<!-- filepath: resources/views/impacttracker/user_index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Impact Tracker Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Impact Tracker Saya</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Event</th>
                <th>Jam Kontribusi</th>
                <th>Tugas Selesai</th>
                <th>Social Impact Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($impacts as $impact)
                <tr>
                    <td>{{ $impact->event->name ?? '-' }}</td>
                    <td>{{ $impact->hours_contributed }}</td>
                    <td>{{ $impact->tasks_completed }}</td>
                    <td>{{ $impact->social_impact_score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>