<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recruitment EO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f8fb;
        }
        .card {
            border-radius: 16px;
        }
        .badge-status {
            font-size: 1em;
            padding: 0.5em 1em;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4">Daftar Pendaftar Event Anda</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse ($recruitments as $recruitment)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h5 class="mb-1">{{ $recruitment->user->name }}</h5>
                        <div class="text-muted small">
                            <strong>Event:</strong> {{ $recruitment->event->title ?? '-' }}
                        </div>
                    </div>
                    <div>
                        @if($recruitment->status == 'accepted')
                            <span class="badge bg-success badge-status">Diterima</span>
                        @elseif($recruitment->status == 'rejected')
                            <span class="badge bg-danger badge-status">Ditolak</span>
                        @else
                            <span class="badge bg-warning text-dark badge-status">Pending</span>
                        @endif
                    </div>
                </div>
                <p class="mb-1"><strong>Motivasi:</strong> {{ $recruitment->motivation ?? '-' }}</p>
                <p class="mb-1"><strong>Catatan EO:</strong> {{ $recruitment->admin_notes ?? '-' }}</p>
                <p class="mb-1 text-muted"><strong>Tanggal Daftar:</strong> {{ $recruitment->date_applied ? \Carbon\Carbon::parse($recruitment->date_applied)->format('d M Y H:i') : '-' }}</p>

                @if($recruitment->status == 'pending')
                <form action="{{ route('eo.recruitment.update', $recruitment->recruitment_id) }}" method="POST" class="row g-2 mt-2">
                    @csrf
                    @method('PUT')
                    <div class="col-md-3">
                        <select name="status" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Aksi --</option>
                            <option value="accepted">Terima</option>
                            <option value="rejected">Tolak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="admin_notes" class="form-control" placeholder="Catatan (opsional)">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada pendaftar untuk event Anda.</div>
    @endforelse
</div>

</body>
</html>