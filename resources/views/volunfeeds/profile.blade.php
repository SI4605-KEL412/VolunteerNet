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


    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Card -->
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="text-muted">{{ $user->email }}</p>
                            <hr>
                            <div class="text-start">
                                <p class="mb-1"><small class="text-muted">Bergabung sejak:</small><br>{{ date('d F Y', strtotime($user->created_at)) }}</p>
                                <p class="mb-0"><small class="text-muted">Total Portfolio:</small><br>{{ $portfolios->total() }} Kegiatan</p>
                            </div>
                        </div>
                    </div>
                    <div class="list-group mt-3">
                        <a href="{{ route('volunfeeds.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke VoluFeed
                        </a>
                    </div>
                </div>

                <!-- VolunFeeds Section -->
                <div class="col-md-8 col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="volunfeeds-title">VoluFeed</h1>
                        <a href="{{ route('portfolio.index') }}" class="btn btn-primary-custom text-white">Tambah Portfolio</a>
                    </div>

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Feeds -->
                    @forelse ($feeds as $portfolio)
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <a href="{{ route('user.profile', ['userId' => $portfolio->user_id]) }}" class="fw-bold text-dark">
                                    {{ $portfolio->username }}
                                </a>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($portfolio->created_at)->diffForHumans() }}</small>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('volunfeeds.show', $portfolio->id) }}">{{ $portfolio->title }}</a>
                                </h5>
                                <p class="card-text">{{ Str::limit($portfolio->description, 150) }}</p>
                                <div class="text-muted small">
                                    <i class="fa fa-calendar"></i> {{ date('d M Y', strtotime($portfolio->event_date)) }}
                                    <span class="ms-3"><i class="fa fa-map-marker"></i> {{ $portfolio->location }}</span>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                @auth
                                    <form action="{{ route('volunfeeds.toggle-like', $portfolio->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ in_array($portfolio->id, $likedPortfolios) ? 'btn-danger' : 'btn-outline-danger' }}">
                                            <i class="fa fa-heart"></i> {{ in_array($portfolio->id, $likedPortfolios) ? 'Unlike' : 'Like' }}
                                        </button>
                                    </form>
                                @endauth
                                <a href="{{ route('volunfeeds.show', $portfolio->id) }}" class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-5 bg-light rounded">
                            <p>Belum ada portfolio yang dibagikan.</p>
                            <a href="{{ route('portfolio.index') }}" class="btn btn-primary-custom text-white">Buat Portfolio Pertama</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
