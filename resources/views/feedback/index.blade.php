<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Feedback</title>
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

        .btn {
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.9rem;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>VolunteerNet</h2>
        <a href="#">Dashboard</a>
        <a href="#">Events</a>
        <a href="{{ route('feedback.index') }}">Feedback</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="card p-4">
                <h3 class="mb-4 text-primary">Daftar Feedback</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-hover bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Event</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->event->name ?? 'Event #' . $feedback->event_id }}</td>
                            <td>{{ $feedback->user->name ?? 'User #' . $feedback->user_id }}</td>
                            <td>{{ $feedback->rating }}</td>
                            <td>{{ $feedback->comments }}</td>
                            <td>{{ $feedback->date_given }}</td>
                            <td>
                                <a href="{{ route('feedback.show', $feedback->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>
</html>