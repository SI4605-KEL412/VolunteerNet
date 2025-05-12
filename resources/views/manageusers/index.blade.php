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

        .sidebar a.nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
        }

        .summary-cards {
            padding: 20px;
        }

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
        </ul>
    </div>

 <!-- Main Content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h1 class="fw-bold">User Management</h1>
                </div>
                <div class="mb-3">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    </div>
        </div>
        <!-- Improved Summary Cards that account for identical timestamps -->
        <div class="summary-cards">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title mb-0">Total Volunteers</h5>
                                    <h3 class="mt-2 mb-0">{{ $users->where('role', 'user')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    <i class="fas fa-user-shield fa-2x text-success"></i>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title mb-0">Updated Volunteers</h5>
                                    <h3 class="mt-2 mb-0">
                                        @php
                                        $updatedCount = 0;
                                        $currentMonth = now()->format('Y-m');

                                        foreach ($users as $user) {
                                            // First check that both date fields exist
                                            if (!$user->updated_at || !$user->created_at) {
                                                continue; // Skip this user if dates are null
                                            }

                                            // Now safely use format() since we've verified dates aren't null
                                            $isUpdatedThisMonth = $user->updated_at->format('Y-m') === $currentMonth;
                                            $wasCreatedBeforeThisMonth = $user->created_at->format('Y-m') !== $currentMonth;
                                            $isManuallyMarkedAsUpdated = session('updated_user_ids') && in_array($user->user_id, session('updated_user_ids'));

                                            // Count user as updated if updated this month AND either:
                                            if ($isUpdatedThisMonth && ($wasCreatedBeforeThisMonth || $isManuallyMarkedAsUpdated)) {
                                                $updatedCount++;
                                            }
                                        }
                                        @endphp
                                        {{ $updatedCount }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    <i class="fas fa-user-edit fa-2x text-danger"></i>
                                </div>
                                <div class="col-9">
                                    <h5 class="card-title mb-0">New Volunteers</h5>
                                        <h3 class="mt-2 mb-0">
                                            @php
                                            $newCount = 0;
                                            $currentMonth = now()->format('Y-m');
                                            foreach ($users as $user) {
                                                // Skip users with null created_at dates
                                                if ($user->role !== 'user' || !$user->created_at) {
                                                    continue;
                                                }

                                                // Count users created this month
                                                if ($user->created_at->format('Y-m') === $currentMonth) {
                                                    $newCount++;
                                                }
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
            <!-- Search and filter -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">User List</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('manageusers.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="katakunci" value="{{ $katakunci ?? '' }}" class="form-control" placeholder="Search for name or email...">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">

                        </div>
                    </div>
                    <!-- User listing table with volunteer-only filter -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    @if($item->role == 'user') <!-- Only display users with role 'user' (volunteer) -->
                                    <tr>
                                        <td class="py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle me-3" style="width: 32px; height: 32px;"></div>
                                                {{ $item->name }}
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $item->email }}</td>
                                        <td class="align-middle">
                                            {{ ucfirst($item->role) }}
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group">
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

            @if(session('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
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
                setTimeout(function() {
                    document.querySelector('.toast').classList.remove('show');
                }, 3000);
            </script>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
