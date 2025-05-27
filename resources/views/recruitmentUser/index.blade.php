<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Event & Status Pendaftaran</title>
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
        .table thead th {
            background: #0066cc;
            color: #fff;
            border-top: none;
        }
        .badge {
            font-size: 1em;
        }
        .btn-primary, .btn-info, .btn-warning, .btn-danger {
            border-radius: 20px;
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
            background-color: #f8f9fa;
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
        .table td, .table th {
            vertical-align: middle;
        }
        .event-title {
            font-weight: 600;
            color: #004080;
        }
        .event-desc {
            font-size: 0.95em;
            color: #6c757d;
        }
        .card-header {
            border-radius: 18px 18px 0 0 !important;
        }
    </style>
</head>
<body>
@include('recruitmentUser.navbar')

<div class="container mt-4 mb-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Event & Status Pendaftaran</h4>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm">Kembali ke Dashboard</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped align-middle shadow-sm">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 35%;">Nama Event</th>
                            <th style="width: 20%;">Status Pendaftaran</th>
                            <th style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($events as $i => $event)
                        @php
                            $recruitment = $userRecruitments->get($event->event_id);
                        @endphp
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>
                                <span class="event-title">{{ $event->title }}</span>
                                <br>
                                <span class="event-desc">{{ \Illuminate\Support\Str::limit($event->description, 60) }}</span>
                            </td>
                            <td>
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
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                @if($recruitment)
                                    <a href="{{ route('recruitmentUser.show', $recruitment->recruitment_id) }}" class="btn btn-info btn-sm">Detail</a>
                                    @if($recruitment->status == 'pending')
                                        <a href="{{ route('recruitmentUser.edit', $recruitment->recruitment_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('recruitmentUser.destroy', $recruitment->recruitment_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pendaftaran ini?')">Hapus</button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('recruitmentUser.create', ['event_id' => $event->event_id]) }}" class="btn btn-primary btn-sm">Daftar</a>
                                @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada event tersedia.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>