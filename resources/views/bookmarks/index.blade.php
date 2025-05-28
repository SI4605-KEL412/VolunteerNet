<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Bookmark Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(to bottom, #e0eafc, #cfdef3); min-height: 100vh; }
        .card { border-radius: 18px; box-shadow: 0 4px 16px rgba(0,0,0,0.07); transition: transform 0.15s, box-shadow 0.15s; }
        .card:hover { transform: translateY(-6px) scale(1.02); box-shadow: 0 8px 32px rgba(0,0,0,0.13); }
        .event-title { font-weight: 700; color: #004080; font-size: 1.13em; }
        .event-desc { font-size: 0.97em; color: #6c757d; }
        .event-detail { font-size: 0.93em; color: #495057; }
        .card-event { min-height: 260px; background: #fafdff; }
        .card-body { display: flex; flex-direction: column; height: 100%; }
        .event-actions { margin-top: auto; }
    </style>
</head>
<body>
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Event yang Dibookmark <span class="badge bg-primary">{{ $bookmarks->count() }}</span></h4>
        <a href="/" class="btn btn-outline-primary btn-sm">Kembali ke Beranda</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row g-4">
        @forelse($bookmarks as $bookmark)
            <div class="col-md-6 col-lg-4">
                <div class="card card-event h-100 shadow-sm">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="event-title">{{ $bookmark->event->title ?? '-' }}</span>
                            <div class="event-desc">{{ \Illuminate\Support\Str::limit($bookmark->event->description ?? '', 60) }}</div>
                            <div class="event-detail mt-2">
                                <div><i class="bi bi-calendar-event"></i> {{ isset($bookmark->event->start_date) ? \Carbon\Carbon::parse($bookmark->event->start_date)->format('d M Y') : '-' }}</div>
                                @if(isset($bookmark->event->location))
                                <div><i class="bi bi-geo-alt"></i> {{ $bookmark->event->location }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="event-actions d-flex flex-wrap">
                            <a href="{{ route('events.show', $bookmark->event->event_id) }}" class="btn btn-detail btn-action mb-1">
                                <i class="bi bi-info-circle"></i> Detail
                            </a>
                            <form action="{{ route('bookmarks.destroy', $bookmark->bookmark_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-action mb-1" onclick="return confirm('Hapus bookmark ini?')">
                                    <i class="bi bi-bookmark-x"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada event yang dibookmark.</div>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>