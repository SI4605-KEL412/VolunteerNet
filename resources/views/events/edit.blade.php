<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event: {{ $event->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 30px;
            margin-bottom: 50px;
        }
        .form-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }
        .form-header {
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
        .btn-action {
            padding: 8px 24px;
            border-radius: 6px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Daftar Event</a></li>
            <li class="breadcrumb-item"><a href="{{ route('event.show', $event->event_id) }}">{{ $event->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <div class="form-container">
        <div class="form-header">
            <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Event: {{ $event->title }}</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.update', $event->event_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label required-field">Judul Event</label>
                <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $event->start_date) }}">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $event->end_date) }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $event->location) }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="">Pilih Status</option>
                    <option value="pending" {{ old('status', $event->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status', $event->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status', $event->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="organizer_id" class="form-label">ID Organizer (opsional)</label>
                <input type="number" name="organizer_id" id="organizer_id" class="form-control @error('organizer_id') is-invalid @enderror" value="{{ old('organizer_id', $event->organizer_id) }}">
                @error('organizer_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success btn-action">
                    <i class="fas fa-save me-1"></i> Perbarui Event
                </button>
                <a href="{{ route('event.show', $event->event_id) }}" class="btn btn-secondary btn-action">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>