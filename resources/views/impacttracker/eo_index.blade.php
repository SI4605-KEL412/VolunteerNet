<!-- filepath: resources/views/impacttracker/eo_index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Impact Tracker EO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Event Anda</h3>
    <ul class="list-group">
        @forelse($events as $event)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $event->title }}</span>
                <a href="{{ route('impacttracker.eo.create', $event->event_id) }}" class="btn btn-primary btn-sm">Nilai Impact</a>
            </li>
        @empty
            <li class="list-group-item">Belum ada event.</li>
        @endforelse
    </ul>
</div>
</body>
</html>