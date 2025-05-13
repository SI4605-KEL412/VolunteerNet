<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #0d47a1;
            color: #fff;
            padding: 30px 20px;
            position: fixed;
            width: 250px;
            transition: all 0.3s;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 12px;
            transition: 0.3s ease-in-out;
        }

        .sidebar a:hover {
            background-color: #bbdefb;
            color: #0d47a1;
            transform: scale(1.05);
        }

        .sidebar a .icon {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .sidebar a.active {
            background-color: #bbdefb;
            color: #0d47a1;
        }

        .main-content {
            margin-left: 270px;
            padding: 40px;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .btn-kembali {
            background-color: #0d47a1;
            color: white;
            border-radius: 12px;
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
        }

        .btn-kembali:hover {
            background-color: #093170;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>VolunteerNet</h2>

        <!-- Menu Navigasi -->
        <a href="{{ route(Auth::user()->role == 'admin' ? 'admin.dashboard' : (Auth::user()->role == 'eo' ? 'dashboardEO' : 'user.dashboard')) }}" class="{{ request()->routeIs('admin.dashboard') || request()->routeIs('dashboardEO') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="fas fa-arrow-left icon"></i> Dashboard
        </a>

        <a href="{{ route('feedback.create') }}" class="{{ request()->routeIs('feedback.create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle icon"></i> Buat Feedback
        </a>

        <a href="{{ route('feedback.index') }}" class="{{ request()->routeIs('feedback.index') ? 'active' : '' }}">
            <i class="fas fa-file-alt icon"></i> Lihat Daftar Feedback
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="card p-4">
                <h3 class="mb-4 text-primary">Detail Feedback</h3>

                <div class="mb-3">
                    <label class="form-label">User ID</label>
                    <p>{{ $feedback->user_id }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Event ID</label>
                    <p>{{ $feedback->event_id }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <p>{{ $feedback->rating }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Komentar</label>
                    <p>{{ $feedback->comments }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Diberikan</label>
                    <p>{{ $feedback->date_given }}</p>
                </div>

                <a href="{{ route('feedback.index') }}" class="btn btn-kembali">← Kembali ke Daftar Feedback</a>
            </div>
        </div>
    </div>

</body>
</html>