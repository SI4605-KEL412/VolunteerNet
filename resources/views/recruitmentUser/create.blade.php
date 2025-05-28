<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #e0eafc, #cfdef3);
            min-height: 100vh;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            max-width: 500px;
            margin: 40px auto;
        }
        .card-header {
            border-radius: 18px 18px 0 0 !important;
        }
        .form-label {
            font-weight: 500;
            color: #004080;
        }
        .btn-primary, .btn-secondary {
            border-radius: 20px;
        }
        .motivasi-info {
            font-size: 0.97em;
            color: #6c757d;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
@include('recruitmentUser.navbar')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Pendaftaran Event</h4>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('recruitmentUser.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="event_id" class="form-label">Pilih Event</label>
                    @if(isset($selectedEventId) && $selectedEventId)
                        @php
                            $selectedEvent = $events->firstWhere('event_id', $selectedEventId);
                        @endphp
                        <input type="hidden" name="event_id" value="{{ $selectedEventId }}">
                        <input type="text" class="form-control" value="{{ $selectedEvent ? $selectedEvent->title : 'Event tidak ditemukan' }}" disabled>
                    @else
                        <select name="event_id" id="event_id" class="form-select" required>
                            <option value="">-- Pilih Event --</option>
                            @foreach($events as $event)
                                <option value="{{ $event->event_id }}" {{ old('event_id') == $event->event_id ? 'selected' : '' }}>
                                    {{ $event->title }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="motivation" class="form-label">Motivasi Mendaftar Event Ini</label>
                    <div class="motivasi-info">
                        Ceritakan secara singkat alasan dan harapanmu mengikuti event ini. Contoh: "Saya ingin menambah pengalaman dan berkontribusi di bidang sosial."
                    </div>
                    <textarea name="motivation" id="motivation" class="form-control" rows="4" maxlength="1000" required>{{ old('motivation') }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary px-4">Daftar</button>
                    <a href="{{ route('recruitmentUser.index') }}" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>