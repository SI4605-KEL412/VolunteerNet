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
            font-weight: 600;
            color: #004080;
        }
        .event-desc {
            font-size: 0.95em;
            color: #6c757d;
        }
        dt {
            color: #004080;
        }
    </style>
</head>
<body>
@include('recruitmentUser.navbar')

<div class="container mt-4 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Pendaftaran Event</h4>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm">Kembali ke Dashboard</a>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4">Nama Event</dt>
                <dd class="col-sm-8">
                    <span class="event-title">{{ $recruitment->event->title ?? '-' }}</span>
                    <br>
                    <span class="event-desc">{{ $recruitment->event->description ?? '' }}</span>
                </dd>

                <dt class="col-sm-4">Motivasi</dt>
                <dd class="col-sm-8">{{ $recruitment->motivation }}</dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
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
                </dd>

                <dt class="col-sm-4">Catatan EO/Admin</dt>
                <dd class="col-sm-8">{{ $recruitment->admin_notes ?? '-' }}</dd>

                <dt class="col-sm-4">Tanggal Daftar</dt>
                <dd class="col-sm-8">
                    {{ $recruitment->date_applied ? \Carbon\Carbon::parse($recruitment->date_applied)->format('d M Y H:i') : '-' }}
                </dd>
            </dl>
            <div class="mt-4">
                <a href="{{ route('recruitmentUser.index') }}" class="btn btn-secondary">Kembali ke Daftar Pendaftaran</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>