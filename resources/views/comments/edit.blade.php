<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komentar</title>
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
        <h2>Edit Komentar</h2>
        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="4" required>{{ old('content', $comment->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Komentar</button>
            <a href="{{ route('forums.show', $comment->forum) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>