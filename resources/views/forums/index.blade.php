<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
            color: #003366;
        }

        .hero {
            height: 100vh;
            background: linear-gradient(135deg, #004080 0%, #0066cc 50%, #6a5acd 100%);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .card-deck .card {
            margin-bottom: 20px;
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
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="d-flex justify-content-between align-items-center p-3">
        <a href="{{ route('user.dashboard') }}" class="text-white text-decoration-none fs-5">
            Dashboard
        </a>
    </div>
    <ul class="nav flex-column p-3">
        <li class="nav-item">
            <a class="nav-link" href="#">Activities</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Feedback</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Build Portfolio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Notification</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('forums.index') }}">Social Network</a>
        </li>
        <li class="nav-item mt-3">
            <a class="nav-link btn btn-light text-dark" href="{{ route('admin.dashboard') }}">Go to EO Dashboard</a>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="content p-4">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Forum Diskusi</h2>
            <a href="{{ route('forums.create') }}" class="btn btn-primary">Buat Topik Baru</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse ($forums as $forum)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('forums.show', $forum) }}" class="text-decoration-none text-dark">
                            {{ $forum->title }}
                        </a>
                    </h5>
                    <p class="card-text">{!! Str::limit($forum->content, 150) !!}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Oleh: {{ $forum->user->name ?? 'Anonim' }} - {{ $forum->created_at->diffForHumans() }}</small>
                        <div>
                            @if ($forum->user_id === auth()->id())
                                <a href="{{ route('forums.edit', $forum) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                <form action="{{ route('forums.destroy', $forum) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada forum tersedia.</div>
        @endforelse

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $forums->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>