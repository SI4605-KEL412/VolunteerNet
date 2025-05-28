<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $forum->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
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

        .content {
            margin-left: 250px;
        }

        .card-body small {
            display: block;
            margin-top: 5px;
        }

        .card-body .btn {
            font-size: 0.8rem;
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

        <!-- Detail Forum -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3>{{ $forum->title }}</h3>
                <p>{!! nl2br(e($forum->content)) !!}</p>
                <small class="text-muted">Oleh: {{ $forum->user->name ?? 'Anonim' }} - {{ $forum->created_at->diffForHumans() }}</small>

                @if ($forum->user_id === auth()->id())
                    <div class="mt-2">
                        <a href="{{ route('forums.edit', $forum) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                        <form action="{{ route('forums.destroy', $forum) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Daftar Komentar -->
        <h4>Komentar</h4>

        @forelse ($forum->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <strong>{{ $comment->user->name ?? 'Anonim' }}</strong>
                    <p class="mb-1">{{ $comment->content }}</p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                    @if ($comment->user_id === auth()->id())
                        <div class="mt-2">
                            <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada komentar.</p>
        @endforelse

        <!-- Form Tambah Komentar -->
        <h5 class="mt-4">Tambah Komentar</h5>
        <form action="{{ route('comments.store', $forum) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" placeholder="Tulis komentar..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>