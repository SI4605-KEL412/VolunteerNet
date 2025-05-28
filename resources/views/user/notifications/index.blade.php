@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
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

        .view-icon {
            font-size: 0.85rem;
            color: #7a1523;
        }

        .icon-btn {
            border: none;
            background: transparent;
            padding: 0;
            margin-left: 8px;
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
        <div class="container" style="max-width: 900px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold">My Notifications</h1>
                @if($notifications->where('status', 'unread')->count() > 0)
                    <form action="{{ route('user.notifications.read.all') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-custom-red">Mark All as Read</button>
                    </form>
                @endif
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <ul class="list-group">
                            @foreach($notifications as $notification)
                                <li class="list-group-item d-flex justify-content-between align-items-start {{ $notification->status === 'unread' ? 'list-group-item-primary' : '' }}">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">
                                            @if($notification->status === 'unread')
                                                <i class="bi bi-envelope-fill me-2"></i>
                                            @else
                                                <i class="bi bi-envelope-open me-2"></i>
                                            @endif
                                            {{ $notification->date_sent->format('F j, Y g:i A') }}
                                        </div>
                                        <p class="mb-1 mt-2 d-inline" title="{{ $notification->message }}">
                                            {{ Str::limit($notification->message, 25) }}
                                        </p>
                                        <button class="icon-btn" data-bs-toggle="modal" data-bs-target="#modal{{ $notification->notif_id }}">
                                            <i class="bi bi-eye view-icon"></i>
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
                                    </div>
                                    @if($notification->status === 'unread')
                                        <form action="{{ route('user.notifications.read', $notification->notif_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Mark as Read</button>
                                        </form>
                                    @else
                                        <span class="badge bg-success align-self-center">Read</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-bell-slash" style="font-size: 3rem;"></i>
                            <p class="mt-3">You don't have any notifications yet.</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Back to Dashboard Button -->
            <div class="mt-4">
                <a href="{{ route('user.dashboard') }}" class="btn btn-custom-gray">Back to Dashboard</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
