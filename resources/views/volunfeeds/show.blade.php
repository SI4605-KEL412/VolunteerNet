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
                <a class="nav-link btn btn-light text-dark" href="{{ route('user.dashboardEO') }}">Go to EO Dashboard</a>
            </li>
        </ul>
    </div>


    <!-- Main Content -->
    <div class="content container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <!-- Portfolio Card -->
                <div class="card mb-4 shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('user.profile', $portfolio->user_id) }}">
                            {{ $portfolio->username }}
                        </a>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($portfolio->created_at)->diffForHumans() }}</small>
                    </div>

                    <div class="card-body">
                        <h4 class="card-title">{{ $portfolio->title }}</h4>
                        <div class="mb-3">
                            <span class="badge bg-primary me-2">
                                <i class="fa fa-calendar"></i> {{ date('d M Y', strtotime($portfolio->event_date)) }}
                            </span>
                            <span class="badge bg-info text-dark">
                                <i class="fa fa-map-marker-alt"></i> {{ $portfolio->location }}
                            </span>
                        </div>
                        <div class="card-text">
                            {!! nl2br(e($portfolio->description)) !!}
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div>
                            @auth
                                <form action="{{ route('volunfeeds.toggle-like', $portfolio->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ in_array($portfolio->id, $likedPortfolios) ? 'btn-danger' : 'btn-outline-danger' }}">
                                        <i class="fa fa-heart"></i>
                                        {{ in_array($portfolio->id, $likedPortfolios) ? 'Unlike' : 'Like' }}
                                    </button>
                                </form>
                            @endauth
                        </div>
                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between back-buttons">
                    <a href="{{ route('volunfeeds.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Kembali ke VoluFeed
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
