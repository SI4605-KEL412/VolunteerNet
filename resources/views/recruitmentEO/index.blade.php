<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recruitment EO - Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <h5 class="mb-1">{{ $recruitment->user->name }}</h5>
                <p class="mb-1"><strong>Event:</strong> {{ $recruitment->event->name }}</p>
                <p class="mb-1"><strong>Motivasi:</strong> {{ $recruitment->motivation ?? '-' }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge bg-{{ 
                        $recruitment->status == 'accepted' ? 'success' : 
                        ($recruitment->status == 'rejected' ? 'danger' : 'secondary') 
                    }}">
                        {{ ucfirst($recruitment->status) }}
                    </span>
                </p>

                <form action="{{ route('eo.recruitments.update', $recruitment->recruitment_id) }}" method="POST" class="row g-2 mt-2">
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
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada pendaftar untuk event Anda.</div>
    @endforelse
</div>

</body>
</html>