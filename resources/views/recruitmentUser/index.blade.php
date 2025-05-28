<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Event & Status Pendaftaran</title>
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
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 8px 32px rgba(0,0,0,0.13);
        }
        .badge {
            font-size: 1em;
        }
        .btn-action {
            border-radius: 18px;
            font-size: 0.97em;
            padding: 6px 18px;
            margin-right: 6px;
            margin-bottom: 4px;
            transition: background 0.15s, color 0.15s;
        }
        .btn-action:last-child {
            margin-right: 0;
        }
        .btn-detail {
            background: #e3f0ff;
            color: #0056b3;
            border: none;
        }
        .btn-detail:hover {
            background: #cce3ff;
            color: #003366;
        }
        .btn-edit {
            background: #fffbe6;
            color: #b38f00;
            border: none;
        }
        .btn-edit:hover {
            background: #fff3cd;
            color: #856404;
        }
        .btn-delete {
            background: #ffeaea;
            color: #c82333;
            border: none;
        }
        .btn-delete:hover {
            background: #ffcccc;
            color: #721c24;
        }
        .btn-daftar {
            background: #e6f9f0;
            color: #218838;
            border: none;
        }
        .btn-daftar:hover {
            background: #c3f7e2;
            color: #155724;
        }
        .status-dot {
            height: 12px;
            width: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }
        .status-pending { background: #ffc107; }
        .status-accepted { background: #28a745; }
        .status-rejected { background: #dc3545; }
        .event-title {
            font-weight: 700;
            color: #004080;
            font-size: 1.13em;
        }
        .event-desc {
            font-size: 0.97em;
            color: #6c757d;
        }
        .event-detail {
            font-size: 0.93em;
            color: #495057;
        }
        .card-event {
            min-height: 320px;
            background: #fafdff;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .event-status {
            margin-bottom: 10px;
        }
        .event-actions {
            margin-top: auto;
        }
    </style>
</head>
<body>
@include('recruitmentUser.navbar')

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Event & Status Pendaftaran</h4>
        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary btn-sm">Kembali ke Dashboard</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        @forelse($events as $i => $event)
            @php
                $recruitment = $userRecruitments->get($event->event_id);
            @endphp
            <div class="col-md-6 col-lg-4">
                <div class="card card-event h-100 shadow-sm">
                    <div class="card-body">
                        <div class="mb-2">
                            <span class="event-title">{{ $event->title }}</span>
                            <div class="event-desc">{{ \Illuminate\Support\Str::limit($event->description, 60) }}</div>
                            <div class="event-detail mt-2">
                                <div>
                                    <i class="bi bi-calendar-event"></i>
                                    {{ isset($event->start_date) ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : '-' }}
                                    @if(isset($event->end_date) && $event->end_date != $event->start_date)
                                        &ndash; {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                    @endif
                                </div>
                                @if(isset($event->location))
                                <div><i class="bi bi-geo-alt"></i> {{ $event->location }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="event-status">
                            <span class="fw-semibold">Status: </span>
                            @if($recruitment)
                                @if($recruitment->status == 'pending')
                                    <span class="status-dot status-pending"></span>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($recruitment->status == 'accepted')
                                    <span class="status-dot status-accepted"></span>
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($recruitment->status == 'rejected')
                                    <span class="status-dot status-rejected"></span>
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            @else
                                <span class="text-muted">Belum daftar</span>
                            @endif
                        </div>
                        <div class="event-actions d-flex flex-wrap">
                            @if($recruitment)
                                <a href="{{ route('recruitmentUser.show', $recruitment->recruitment_id) }}" class="btn btn-detail btn-action mb-1">
                                    <i class="bi bi-info-circle"></i> Detail
                                </a>
                                @if($recruitment->status == 'pending')
                                    <a href="{{ route('recruitmentUser.edit', $recruitment->recruitment_id) }}" class="btn btn-edit btn-action mb-1">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('recruitmentUser.destroy', $recruitment->recruitment_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-action mb-1" onclick="return confirm('Yakin ingin menghapus pendaftaran ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('recruitmentUser.create', ['event_id' => $event->event_id]) }}" class="btn btn-daftar btn-action mb-1">
                                    <i class="bi bi-person-plus"></i> Daftar
                                </a>
                            @endif
                            @if(Auth::check())
                                @if(isset($event->bookmarked) && $event->bookmarked)
                                    <form action="{{ route('bookmarks.destroy', $event->bookmark_id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">Remove Bookmark</button>
                                    </form>
                                @else
                                    <form action="{{ route('bookmarks.store') }}" method="POST" style="display:inline">
                                        @csrf
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Bookmark</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Tidak ada event tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>