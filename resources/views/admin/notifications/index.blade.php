<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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


        /* Button colors */
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

        /* Center the title and button */
        .header-btn-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
         /* Tooltip styles */
        .message-tooltip {
            position: relative;
            display: inline-block;
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
                <a class="nav-link" href="{{ route('admin.notifications.index') }}">Notification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('manageusers.index') }}">Manage Events</a>
            </li>
        </ul>
    </div>

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
        <div class="header-btn-group mb-4">
            <h1>My Notifications</h1>
            <div>
                <a href="{{ route('admin.notifications.create') }}" class="btn btn-custom-red me-2">Send Individual Notification</a>
                <a href="{{ route('admin.notifications.bulk') }}" class="btn btn-custom-gray">Send Bulk Notification</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Notifications</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Date Sent</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $notification)
                                <tr>
                                    <td>{{ $notification->notif_id }}</td>
                                    <td>{{ $notification->user->name ?? 'Unknown User' }}</td>
                                    <td>
                                        {{ Str::limit($notification->message, 25) }}
                                        <button class="border-0 bg-transparent p-0 ms-2" data-bs-toggle="modal" data-bs-target="#modal{{ $notification->notif_id }}">
                                            <i class="bi bi-eye" style="font-size: 0.85rem; color: #7a1523;"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{ $notification->notif_id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Notification Message</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $notification->message }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $notification->date_sent }}</td>
                                    <td>
                                        <span class="badge {{ $notification->status === 'read' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($notification->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No notifications found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Back to Dashboard Button -->
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-custom-gray">Back to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
