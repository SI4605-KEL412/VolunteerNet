<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EO Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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

        .summary-cards, .events-section {
            padding: 20px;
        }

        .btn-custom-red {
            background-color: #9c1f2d;
            color: white;
        }

        .btn-custom-gray {
            background-color: #6c757d;
            color: white;
        }

        .btn-custom-gray:hover {
            background-color: #5a6268;
        }

        .toast-container {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 9999;
            margin: 20px;
        }

        .toast-container .toast {
            background-color: #0056b3;
            color: white;
            border-radius: 8px;
            min-width: 250px;
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
        <div class="container" style="max-width: 900px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold">Manage User</h1>
            </div>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="row">
                    <!-- Total Volunteers -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="card-title mb-0">Volunteers</h5>
                                        <h3 class="mt-2 mb-0">{{ $users->where('role', 'user')->count() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Updated Volunteers -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <i class="fas fa-user-shield fa-2x text-success"></i>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="card-title mb-0">Updated</h5>
                                        <h3 class="mt-2 mb-0">
                                            @php
                                                $updatedCount = 0;
                                                $currentMonth = now()->format('Y-m');
                                                foreach ($users as $user) {
                                                    if (!$user->updated_at || !$user->created_at) continue;
                                                    $isUpdatedThisMonth = $user->updated_at->format('Y-m') === $currentMonth;
                                                    $wasCreatedBefore = $user->created_at->format('Y-m') !== $currentMonth;
                                                    $manualUpdate = session('updated_user_ids') && in_array($user->user_id, session('updated_user_ids'));
                                                    if ($isUpdatedThisMonth && ($wasCreatedBefore || $manualUpdate)) $updatedCount++;
                                                }
                                            @endphp
                                            {{ $updatedCount }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Volunteers -->
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <i class="fas fa-user-edit fa-2x text-danger"></i>
                                    </div>
                                    <div class="col-9">
                                        <h5 class="card-title mb-0">New</h5>
                                        <h3 class="mt-2 mb-0">
                                            @php
                                                $newCount = 0;
                                                $currentMonth = now()->format('Y-m');
                                                foreach ($users as $user) {
                                                    if ($user->role !== 'user' || !$user->created_at) continue;
                                                    if ($user->created_at->format('Y-m') === $currentMonth) $newCount++;
                                                }
                                            @endphp
                                            {{ $newCount }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <form action="{{ route('manageusers.index') }}" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="katakunci" value="{{ $katakunci ?? '' }}" class="form-control" placeholder="Search for name or email..." />
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <!-- User Table -->
        <div class="table-responsive shadow-sm bg-white rounded">
            <table class="table table-hover mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            <td class="py-3 px-4 d-flex align-items-center">
                                <div class="bg-secondary rounded-circle me-3" style="width: 32px; height: 32px;"></div>
                                {{ $item->name }}
                            </td>
                            <td class="align-middle">{{ $item->email }}</td>
                            <td class="align-middle">{{ ucfirst($item->role) }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="User actions">
                                    <a href="{{ route('manageusers.show', $item->user_id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    <a href="{{ route('manageusers.edit', $item->user_id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form onsubmit="return confirm('Are you sure you want to delete this user?');" action="{{ route('manageusers.destroy', $item->user_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4">No volunteers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Toast Notification -->
        @if(session('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
                <div class="toast show bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Notification</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    document.querySelector('.toast').classList.remove('show');
                }, 3000);
            </script>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
