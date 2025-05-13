<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Feedback</title>
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

        .form-label {
            font-weight: 600;
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

        <!-- Menu Navigasi -->
        <a href="{{ route(Auth::user()->role == 'admin' ? 'admin.dashboard' : (Auth::user()->role == 'eo' ? 'dashboardEO' : 'user.dashboard')) }}">
            ← Dashboard
        </a>

        <a href="{{ route('feedback.create') }}">➕ Buat Feedback</a>
        <a href="{{ route('feedback.index') }}">📄 Lihat Daftar Feedback</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="card p-4">
                <h3 class="mb-4 text-primary">Edit Feedback</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('feedback.update', $feedback->feedback_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Pilih Event</label>
                        <select name="event_id" id="event_id" class="form-select" required>
                            <option value="">-- Pilih Event --</option>
                            @forelse($events as $event)
                                <option value="{{ $event->event_id }}">{{ $event->title }}</option>
                            @empty
                                <option disabled>No events available</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (0 - 5)</label>
                        <input type="number" step="0.01" min="0" max="5" class="form-control" name="rating" id="rating" value="{{ old('rating', $feedback->rating) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="comments" class="form-label">Komentar</label>
                        <textarea class="form-control" name="comments" id="comments" rows="4" maxlength="500" placeholder="Tulis komentar kamu di sini...">{{ old('comments', $feedback->comments) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="date_given" class="form-label">Tanggal Diberikan</label>
                        <input type="datetime-local" class="form-control" name="date_given" id="date_given" value="{{ old('date_given', $feedback->date_given ? $feedback->date_given : '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Feedback</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
