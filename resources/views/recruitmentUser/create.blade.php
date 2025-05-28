<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('recruitmentUser.navbar')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Form Pendaftaran Event</h4>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('recruitmentUser.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="event_id" class="form-label">Pilih Event</label>
                    <select name="event_id" id="event_id" class="form-select" required>
                        <option value="">-- Pilih Event --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->event_id }}" {{ old('event_id') == $event->event_id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="motivation" class="form-label">Motivasi</label>
                    <textarea name="motivation" id="motivation" class="form-control" rows="4" maxlength="1000" required>{{ old('motivation') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
                <a href="{{ route('recruitmentUser.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>