<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pendaftaran Event</title>
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
        .badge {
            font-size: 1em;
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
        .info-label {
            color: #004080;
            font-weight: 500;
            margin-bottom: 2px;
        }
        .info-value {
            margin-bottom: 16px;
        }
        .btn-action {
            border-radius: 18px;
            font-size: 0.97em;
            padding: 6px 18px;
            margin-right: 6px;
            margin-bottom: 4px;
            transition: background 0.15s, color 0.15s;
        }
        .btn-secondary {
            background: #e3f0ff;
            color: #0056b3;
            border: none;
        }
        .btn-secondary:hover {
            background: #cce3ff;
            color: #003366;
        }
        .btn-outline-primary {
            border-radius: 18px;
        }
    </style>
</head>
<body>
@include('recruitmentUser.navbar')

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Pendaftaran Event</h4>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="info-label">Nama Event</div>
                <div class="event-title">{{ $recruitment->event->title ?? '-' }}</div>
                <div class="event-desc">{{ $recruitment->event->description ?? '' }}</div>
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
                <div class="info-label">Motivasi</div>
                <div class="info-value">{{ $recruitment->motivation }}</div>
            </div>
            <div class="mb-3">
                <div class="info-label">Status</div>
                <div class="info-value">
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
                </div>
            </div>
            <div class="mb-3">
                <div class="info-label">Catatan EO/Admin</div>
                <div class="info-value">{{ $recruitment->admin_notes ?? '-' }}</div>
            </div>
            <div class="mb-3">
                <div class="info-label">Tanggal Daftar</div>
                <div class="info-value">
                    {{ $recruitment->date_applied ? \Carbon\Carbon::parse($recruitment->date_applied)->format('d M Y H:i') : '-' }}
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('recruitmentUser.index') }}" class="btn btn-secondary btn-action">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pendaftaran
                </a>
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-primary btn-action">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>