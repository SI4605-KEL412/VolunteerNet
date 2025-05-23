<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EO Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff); /* Biru ke putih */
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

        .card-deck .card {
            margin-bottom: 20px;
        }

        /* Sidebar Styles */
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

        .sidebar a.nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
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
                <a class="nav-link" href="#">Create Event</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Build Portofolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Notification</a>
            </li> -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
       <!-- Hero Section -->
    <div class="hero">
        <h1 class="mb-3">Welcome, {{ $userName }} as EO!</h1>
        <p class="mb-4">This is your dashboard.</p>
        <div class="d-flex flex-column flex-md-row gap-2">
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-danger">Logout</a>

            <a href="{{ route('user.dashboard') }}" class="btn btn-light">Back to User Dashboard</a>
        </div>

    <!-- Logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
        <!-- Top Events Section -->
        <div class="container mt-5">
            <h2 class="text-center mb-4">3 Top Events</h2>
            <div class="row">
                @foreach($events as $event)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                                <a href="#" class="btn btn-primary">View Event</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 text-center">
                <a href="#" class="btn btn-success">See All Events</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
