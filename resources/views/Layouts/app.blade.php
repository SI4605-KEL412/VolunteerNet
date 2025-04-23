<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VolunteerNet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .sidebar {
            background-color: #002244;
            min-height: 100vh;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #001b3a;
            padding-left: 8px;
        }
        .topbar {
            background-color: #002244;
            color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">VolunteerNet</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('events.index') }}" class="nav-link">Events</a></li>
                <li class="nav-item"><a href="{{ route('bookmark.index') }}" class="nav-link">Bookmarks</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Settings</a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="col-md-10 p-0">
            <nav class="navbar topbar px-4 py-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h5 text-white">Welcome, {{ Auth::user()->name ?? 'Guest' }}</span>
                    <div>
                        <a href="#" class="text-white me-3"><i class="bi bi-bell-fill"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-person-circle"></i></a>
                    </div>
                </div>
            </nav>
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
</div>
</body>
</html>
