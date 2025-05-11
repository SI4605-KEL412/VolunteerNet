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
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
            color: #003366;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #004080;
            color: white;
            z-index: 1000;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar a.nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
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
        /* Status badge styling */
        .status-badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        .status-pending {
            background-color: #ffc107;
        }
        .status-approved {
            background-color: #198754;
        }
        .status-rejected {
            background-color: #dc3545;
        }
        /* Custom styling for status select */
        .form-select option[value="pending"] {
            background-color: #fff3cd;
            color: #664d03;
        }
        .form-select option[value="approved"] {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .form-select option[value="rejected"] {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex justify-content-between align-items-center p-3">
            <span class="text-white fs-4 fw-bold">Dashboard</span>
        </div>
        <ul class="nav flex-column p-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('manageusers.index') }}">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('events.index') }}">Manage Events</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
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

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $event->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="pending" {{ old('status', $event->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $event->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $event->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-secondary btn-action">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-action">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Additional validation for date fields
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            
            // Ensure end date is after start date
            endDateInput.addEventListener('change', function() {
                if(startDateInput.value && endDateInput.value) {
                    const startDate = new Date(startDateInput.value);
                    const endDate = new Date(endDateInput.value);
                    
                    if(endDate < startDate) {
                        alert('Tanggal selesai tidak boleh sebelum tanggal mulai');
                        endDateInput.value = '';
                    }
                }
            });
            
            // Ensure start date is before end date
            startDateInput.addEventListener('change', function() {
                if(startDateInput.value && endDateInput.value) {
                    const startDate = new Date(startDateInput.value);
                    const endDate = new Date(endDateInput.value);
                    
                    if(endDate < startDate) {
                        alert('Tanggal mulai tidak boleh setelah tanggal selesai');
                        startDateInput.value = '';
                    }
                }
            });
        });
    </script>
</body>
</html>