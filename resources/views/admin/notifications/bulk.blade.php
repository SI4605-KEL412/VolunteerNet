<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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

        .sidebar .nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .btn-custom-red {
            background-color: #9c1f2d;
            color: white;
        }

        .btn-custom-red:hover {
            background-color: #7a1523;
        }

        .btn-custom-gray {
            background-color: #6c757d;
            color: white;
        }

        .btn-custom-gray:hover {
            background-color: #5a6268;
        }

        .header-btn-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
                <a class="nav-link" href="{{ route('manageusers.index') }}" href="#">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Manage Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.notifications.index') }}">Manage Notification</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Send Bulk Notification</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            This notification will be sent to all users with the 'user' role.
                        </div>

                        <form action="{{ route('admin.notifications.bulk.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror" required></textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.notifications.index') }}" class="btn btn-custom-gray">Cancel</a>
                                <button type="submit" class="btn btn-primary">Send to All Users</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
