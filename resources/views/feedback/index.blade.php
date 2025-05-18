<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Feedback</title>
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

        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn {
            border-radius: 10px;
            padding: 6px 14px;
            font-size: 0.9rem;
        }

        .alert {
            border-radius: 12px;
        }

        .btn-lihat {
            background-color: #0d47a1;
            color: white;
        }

        .btn-edit {
            background-color: #F0DE36;
            color: black;
        }

        .btn-hapus {
            background-color: #D71313;
            color: white;
        }

        .btn-lihat:hover {
            background-color: #093170;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e4ce3c;
            color: black;
        }

        .btn-hapus:hover {
            background-color: #b01010;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>VolunteerNet</h2>

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
                <h3 class="mb-4 text-primary">Daftar Feedback</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover bg-white align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->event_id }}</td>
                                <td>{{ $feedback->event->title ?? 'Event #' . $feedback->event_id }}</td>
                                <td>{{ $feedback->user->name ?? 'User #' . $feedback->user_id }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $feedback->rating ? ' text-warning' : ' text-secondary' }}"></i>
                                    @endfor
                                </td>
                                <td>{{ $feedback->comments }}</td>
                                <td>{{ \Carbon\Carbon::parse($feedback->date_given)->format('d M Y H:i') }}</td>
                                <td class="text-center">
                                    @if($feedback->feedback_id)
                                        <a href="{{ route('feedback.show', $feedback->feedback_id) }}" class="btn btn-sm btn-lihat mb-1">Lihat</a>
                                        <a href="{{ route('feedback.edit', $feedback->feedback_id) }}" class="btn btn-sm btn-edit mb-1">Edit</a>
                                        <form action="{{ route('feedback.destroy', $feedback->feedback_id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-hapus" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                        </form>
                                    @else
                                        <span class="text-muted">ID tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data feedback.</td>
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