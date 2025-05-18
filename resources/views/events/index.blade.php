<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
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

        .page-header {
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .card {
            height: 100%;
            transition: transform 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            position: relative;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            font-weight: bold;
            background-color: #f8f9fa;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
        }

        .event-status {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .event-date {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons .btn {
            margin-right: 3px;
            margin-bottom: 5px;
        }

        .no-events {
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 40px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex justify-content-between align-items-center p-3">
            <a class="nav-link active text-white fs-4 fw-bold" href="{{ route('admin.dashboard') }}">Dashboard</a>
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
            <div class="page-header d-flex justify-content-between align-items-center">
                <h2 class="m-0"><i class="fas fa-calendar-alt me-2"></i>Daftar Event</h2>
                <a href="{{ route('events.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Buat Event Baru
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(count($events) > 0)
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($events as $event)
                        <div class="col">
                            <div class="card h-100">
                                <div class="event-status">
                                    @if ($event->status == 'pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i> {{ ucfirst($event->status) }}
                                        </span>
                                    @elseif ($event->status == 'approved')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i> {{ ucfirst($event->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times me-1"></i> {{ ucfirst($event->status) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="card-header text-truncate">{{ $event->title }}</div>
                                <div class="card-body">
                                    <p class="card-text">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        {{ $event->location ?? 'Lokasi tidak tersedia' }}
                                    </p>
                                    <p class="card-text event-date">
                                        <i class="far fa-calendar-alt me-2"></i>
                                        {{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : 'Tanggal tidak tersedia' }}
                                    </p>
                                </div>
                                <div class="card-footer action-buttons">
                                    <a href="{{ route('event.show', $event->event_id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-events">
                    <i class="fas fa-info-circle me-2"></i> Tidak ada event ditemukan.
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
</body>
</html>
