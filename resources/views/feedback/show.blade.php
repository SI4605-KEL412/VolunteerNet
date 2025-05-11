<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 40px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #bbdefb;
        }

        .main-content {
            margin-left: 270px;
            padding: 40px;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            border-radius: 12px;
            padding: 10px 20px;
            font-size: 1rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>VolunteerNet</h2>
        <a href="#">Dashboard</a>
        <a href="#">Events</a>
        <a href="#">Feedback</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
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

                <a href="{{ route('feedback.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            </div>
        </div>
    </div>

</body>
</html>
