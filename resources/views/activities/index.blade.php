<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activities</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* warna biru muda yang lembut */
            color: #003366;
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

        .sidebar a.nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .table thead {
            background-color: #004080;
            color: white;
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
                <a class="nav-link" href="{{ route('portfolio.index') }}">Build Portfolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Notification</a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link btn btn-light text-dark" href="{{ route('admin.dashboard') }}">Go to EO Dashboard</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h2 class="text-center mb-4">Your Activity History</h2>
            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary mb-3">← Kembali ke Dashboard</a>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($activities->isEmpty())
    <!-- <div class="text-center mb-4">
        <p class="text-muted">Belum ada aktivitas yang tercatat.</p>
    </div> -->

    <div class="container">
        <div class="row row-cols-1 g-3">
            <div class="col">
                <div class="card shadow-sm border-0 bg-white rounded">
                    <div class="card-body">
                        <h6 class="card-title text-primary mb-1">Login ke sistem</h6>
                        <p class="card-subtitle text-muted small">10 May 2025 - 12:55</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-0 bg-white rounded">
                    <div class="card-body">
                        <h6 class="card-title text-primary mb-1">Melihat detail event <strong>"Bakti Sosial"</strong></h6>
                        <p class="card-subtitle text-muted small">11 May 2025 - 12:55</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm border-0 bg-white rounded">
                    <div class="card-body">
                        <h6 class="card-title text-primary mb-1">Mendaftar pada event <strong>"Green Earth Project"</strong></h6>
                        <p class="card-subtitle text-muted small">12 May 2025 - 09:55</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
