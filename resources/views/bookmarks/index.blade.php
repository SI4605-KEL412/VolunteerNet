<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
            color: #003366;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #004080;
            color: white;
            z-index: 1000;
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

        .page-header {
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .bookmark-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            padding: 20px;
        }

        .alert {
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem auto;
            max-width: 800px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
        }

        .alert-info {
            color: #004080;
        }

        .alert i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
            color: #004080;
        }

        .alert-heading {
            color: #004080;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .alert p {
            color: #004080;
            margin-bottom: 0;
            font-size: 1.1rem;
        }

        .alert-success {
            color: #198754;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex justify-content-between align-items-center p-3">
            <a class="nav-link active text-white fs-4 fw-bold" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
        <ul class="nav flex-column p-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('manageusers.index') }}">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events.index') }}">Manage Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('bookmarks.index') }}">Bookmarks</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h2 class="m-0">Daftar Bookmark</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($bookmarks->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-bookmark"></i>
                    <h4 class="alert-heading">Belum ada bookmark</h4>
                    <p>Anda belum menyimpan event apapun sebagai bookmark.</p>
                </div>
            @elseif($bookmarks && $bookmarks->isNotEmpty())
                <div class="row mt-4">
                    @foreach($bookmarks as $bookmark)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($bookmark->event->image)
                                    <img src="{{ asset('storage/' . $bookmark->event->image) }}" class="card-img-top" alt="event-image" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $bookmark->event->title }}</h5>
                                    <p class="mb-2 text-muted">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i> {{ $bookmark->event->location }} <br>
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        {{ \Carbon\Carbon::parse($bookmark->event->start_date)->format('d M Y') }}
                                    </p>
                                    <div class="mt-auto d-flex justify-content-between">
                                        @if($bookmark->event)
                                            <a href="{{ route('event.show', $bookmark->event->event_id) }}" class="btn btn-outline-secondary">
                                                <i class="fas fa-info-circle me-1"></i>Detail
                                            </a>
                                        @endif
                                        <form action="{{ route('bookmarks.destroy', ['id' => $bookmark->bookmark_id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus bookmark ini?')">
                                                <i class="fas fa-trash me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

