<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pendaftaran Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #e0eafc, #cfdef3);
            min-height: 100vh;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        }
        .card-header {
            border-radius: 18px 18px 0 0 !important;
        }
        .event-title {
            font-weight: 600;
            color: #004080;
        }
        .event-desc {
            font-size: 0.95em;
            color: #6c757d;
        }
    </style>
</head>
<body>
@include('recruitmentUser.navbar')

<div class="container mt-4 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Motivasi Pendaftaran</h4>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm">Kembali ke Dashboard</a>
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
                    <label class="form-label">Nama Event</label>
                    <input type="text" class="form-control event-title" value="{{ $recruitment->event->title }}" disabled>
                    <div class="event-desc mt-1">{{ $recruitment->event->description }}</div>
                </div>
                <div class="mb-3">
                    <label for="motivation" class="form-label">Motivasi</label>
                    <textarea name="motivation" id="motivation" class="form-control" rows="4" maxlength="1000" required>{{ old('motivation', $recruitment->motivation) }}</textarea>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('recruitmentUser.index') }}" class="btn btn-secondary ms-2">Kembali ke Daftar Pendaftaran</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>