<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portofolio Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            color: #003366;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #004080;
            color: white;
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
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="d-flex justify-content-between align-items-center p-3">
        <span class="text-white">Dashboard</span>
    </div>
    <ul class="nav flex-column p-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('activities.index') }}">Activities</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Feedback</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('portfolio.index') }}">Build Portfolio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Notification</a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link btn btn-light text-dark" href="{{ route('admin.dashboard') }}">Go to EO Dashboard</a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Portofolio Saya</h2>
        <a href="{{ route('portfolio.create') }}" class="btn btn-primary">+ Tambah Entri</a>
    </div>
    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary mb-3">← Kembali ke Dashboard</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($portfolios->isEmpty())
        <p class="text-muted">Belum ada entri portofolio.</p>
    @else
        <div class="row row-cols-1 g-3">
            @foreach ($portfolios as $entry)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $entry->title }}</h5>
                            <p class="card-text">{{ $entry->description }}</p>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Tanggal: {{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}</small>
                                <small class="text-muted">Lokasi: {{ $entry->location ?? '-' }}</small>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('portfolio.edit', $entry->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('portfolio.destroy', $entry->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus entri ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
