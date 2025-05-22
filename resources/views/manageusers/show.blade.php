<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EO Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
            color: #003366;
            margin: 0;
            padding: 0;
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

        .sidebar .nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
        }

        .summary-cards,
        .events-section {
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex justify-content-between align-items-center p-3">
            <span class="text-white fs-4 fw-bold">Dashboard</span>
        </div>
        <ul class="nav flex-column p-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('manageusers.index') }}">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events.index') }}">Manage Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.notifications.index') }}">Manage Notification</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold mb-0">User Details</h1>
            </div>

            <!-- User Profile Card -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <!-- User Avatar and Name -->
                        <div class="col-md-3 text-center">
                            <div class="bg-secondary rounded-circle mb-3 d-flex justify-content-center align-items-center mx-auto" style="width: 120px; height: 120px;">
                                <i class="fas fa-user text-white" style="font-size: 50px;"></i>
                            </div>
                            <h4>{{ $user->name }}</h4>
                            <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                        </div>

                        <!-- User Details -->
                        <div class="col-md-9">
                            <!-- Basic Info -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">User Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">Name:</div>
                                        <div class="col-md-9">{{ $user->name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">Email:</div>
                                        <div class="col-md-9">{{ $user->email }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 fw-bold">Role:</div>
                                        <div class="col-md-9">{{ ucfirst($user->role) }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Details -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Profile Details</h5>
                                </div>
                                <div class="card-body">
                                    <p class="profiledetails">{{ $user->profile_detail ?: 'No profile details provided.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('manageusers.index') }}" class="btn btn-outline-secondary me-2">Back to List</a>
                        <a href="{{ route('manageusers.edit', $user->id) }}" class="btn btn-primary">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
