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
        </ul>
    </div>



    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
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

            <!-- Bagian Filter Bar -->
            <div class="filter-bar mb-4">
                <form action="{{ route('volunfeeds.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label for="sort" class="form-label">Urutkan:</label>
                        <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="location" class="form-label">Lokasi:</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ request('location') }}" placeholder="Filter by location">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-contrast w-100">Filter</button>
                    </div>
                </form>
            </div>
            <!-- Feeds -->
            <div class="volun-feeds">
                @forelse ($feeds as $portfolio)
                    <div class="card mb-4 position-relative">
                        @if($portfolio->likes_count > 5)
                            <span class="popular-tag"><i class="fa fa-fire"></i> Popular</span>
                        @endif
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{ route('user.profile', ['userId' => $portfolio->user_id]) }}" class="fw-bold text-dark">
                                {{ $portfolio->username }}
                            </a>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($portfolio->created_at)->diffForHumans() }}
                            </small>
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
                            <div>
                                @auth
                                    <form action="{{ route('volunfeeds.toggle-like', $portfolio->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ in_array($portfolio->id, $likedPortfolios) ? 'btn-danger' : 'btn-outline-danger' }}">
                                            <i class="fa fa-heart"></i> {{ in_array($portfolio->id, $likedPortfolios) ? 'Unlike' : 'Like' }}
                                        </button>
                                        <span class="like-count">
                                            <i class="fa fa-heart"></i> {{ $portfolio->likes_count }}
                                        </span>
                                    </form>
                                @endauth
                                <a href="{{ route('volunfeeds.show', $portfolio->id) }}" class="btn btn-sm btn-outline-primary ms-2">
                                    <i class="fa fa-eye"></i> Detail
                                </a>
                            </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
