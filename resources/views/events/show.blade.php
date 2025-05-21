<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Event: {{ $event->title }}</title>
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
            max-width: calc(100% - 250px);
        }

        .card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-action {
            padding: 8px 24px;
            border-radius: 6px;
            font-weight: 500;
        }

        .detail-label {
            font-weight: 600;
            width: 150px;
            display: inline-block;
            color: #495057;
        }

        .detail-item {
            margin-bottom: 1rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
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
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('bookmarks.index') }}">Bookmarks</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Daftar Event</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Event</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-calendar-check me-2"></i>{{ $event->title }}</h3>
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
                </div>
                <div class="card-body">
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-align-left me-2"></i>Deskripsi:</span>
                        <span>{{ $event->description ?? 'Tidak ada deskripsi' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-map-marker-alt me-2"></i>Lokasi:</span>
                        <span>{{ $event->location ?? '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-calendar me-2"></i>Tanggal Mulai:</span>
                        <span>{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-calendar-check me-2"></i>Tanggal Selesai:</span>
                        <span>{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-user me-2"></i>ID Organizer:</span>
                        <span>{{ $event->organizer_id ?? '-' }}</span>
                    </div>
                </div>
            </div>

            @auth
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('events.index') }}" class="btn btn-secondary btn-action">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-warning btn-action">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form method="POST" action="{{ route('events.bookmark', ['event' => $event->event_id]) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-action">
                        <i class="fas fa-bookmark me-1"></i>
                        {{ $event->isBookmarkedBy(auth()->user()) ? 'Unbookmark' : 'Bookmark' }}
                    </button>
                </form>
                <form action="{{ route('events.bookmark', $event->event_id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-bookmark"></i> Bookmark
                    </button>
                </form>
                <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
