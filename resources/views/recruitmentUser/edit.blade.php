<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Motivasi Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        .event-title {
            font-weight: 700;
            color: #004080;
            font-size: 1.18em;
        }
        .event-desc {
            font-size: 0.97em;
            color: #6c757d;
        }
        .event-detail {
            font-size: 0.93em;
            color: #495057;
            margin-bottom: 10px;
        }
        .form-label {
            font-weight: 500;
            color: #004080;
        }
        .btn-primary, .btn-secondary {
            border-radius: 18px;
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

<div class="container mt-4 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Motivasi Pendaftaran</h4>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('recruitmentUser.update', $recruitment->recruitment_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <div class="form-label">Nama Event</div>
                    <div class="event-title">{{ $recruitment->event->title }}</div>
                    <div class="event-desc">{{ $recruitment->event->description }}</div>
                    <div class="event-detail mt-2">
                        <div>
                            <i class="bi bi-calendar-event"></i>
                            {{ isset($recruitment->event->start_date) ? \Carbon\Carbon::parse($recruitment->event->start_date)->format('d M Y') : '-' }}
                            @if(isset($recruitment->event->end_date) && $recruitment->event->end_date != $recruitment->event->start_date)
                                &ndash; {{ \Carbon\Carbon::parse($recruitment->event->end_date)->format('d M Y') }}
                            @endif
                        </div>
                        @if(isset($recruitment->event->location))
                        <div><i class="bi bi-geo-alt"></i> {{ $recruitment->event->location }}</div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label for="motivation" class="form-label">Motivasi Mengikuti Event Ini</label>
                    <div class="motivasi-info">
                        Ceritakan secara singkat alasan dan harapanmu mengikuti event ini. Contoh: "Saya ingin menambah pengalaman dan berkontribusi di bidang sosial."
                    </div>
                    <textarea name="motivation" id="motivation" class="form-control" rows="4" maxlength="1000" required>{{ old('motivation', $recruitment->motivation) }}</textarea>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('recruitmentUser.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>