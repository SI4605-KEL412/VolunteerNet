<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .sidebar .nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        .btn-primary-custom {
            background-color: #007bff;
            border-color: #007bff;
        }
        .filter-bar label {
            color: white;
            font-weight: 500;
            font-size: 1rem;
        }

        .btn-contrast {
            background-color: white;
            color: #004080;
            border: none;
            font-weight: 600;
        }

        .btn-contrast:hover {
            background-color: #f0f0f0;
            color: #003366;
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
                <a class="nav-link" href="{{ route('volunfeeds.index') }}">VoluFeed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.notifications.index') }}">Notification</a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link btn btn-light text-dark" href="{{ route('admin.dashboard') }}">Go to EO Dashboard</a>
            </li>
        </ul>
    </div>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Portfolio Saya</h4>
                    <div>
                        <a href="{{ route('portfolio.create') }}" class="btn btn-primary">Buat Portfolio Baru</a>
                        <a href="{{ route('volunfeeds.index') }}" class="btn btn-outline-secondary ms-2">Kembali ke VoluFeed</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="my-portfolios">
                        @forelse ($portfolios as $portfolio)
                            <div class="portfolio-item card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('volunfeeds.show', $portfolio->id) }}">
                                            {{ $portfolio->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        {{ \Illuminate\Support\Str::limit($portfolio->description, 150) }}
                                    </p>
                                    <div class="portfolio-meta">
                                        <small class="text-muted">
                                            <i class="fa fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($portfolio->event_date)->format('d M Y') }}
                                        </small>
                                        <small class="text-muted ms-3">
                                            <i class="fa fa-map-marker"></i>
                                            {{ $portfolio->location }}
                                        </small>
                                        <small class="text-muted ms-3">
                                            <i class="fa fa-clock-o"></i>
                                            Dibuat: {{ \Carbon\Carbon::parse($portfolio->created_at)->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                                        Edit
                                    </a>
                                    <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus portfolio ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-5">
                                <p>Anda belum memiliki portfolio yang dibagikan.</p>
                                <a href="{{ route('portfolio.create') }}" class="btn btn-primary">Buat Portfolio Pertama</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
