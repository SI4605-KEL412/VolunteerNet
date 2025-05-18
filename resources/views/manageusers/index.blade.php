<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EO Dashboard - User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
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
        .sidebar a.nav-link:hover {
            background-color: #0056b3;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="d-flex justify-content-between align-items-center p-3">
            <span class="fs-4 fw-bold">Dashboard</span>
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="fw-bold">User Management</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-users fa-2x text-primary me-3"></i>
                        <div>
                            <h5>Total Volunteers</h5>
                            <h3>{{ $totalVolunteers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-shield fa-2x text-success me-3"></i>
                        <div>
                            <h5>Updated Volunteers</h5>
                            <h3>{{ $updatedVolunteers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-edit fa-2x text-danger me-3"></i>
                        <div>
                            <h5>New Volunteers</h5>
                            <h3>{{ $newVolunteers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and User Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">User List</h5>

                <form action="{{ route('manageusers.index') }}" method="get" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="katakunci" value="{{ $katakunci ?? '' }}" class="form-control" placeholder="Search for name or email..." />
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

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
                                @if($item->role == 'user') <!-- Only volunteers -->
                                <tr>
                                    <td class="py-3 px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary rounded-circle me-3" style="width: 32px; height: 32px;"></div>
                                            {{ $item->name }}
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $item->email }}</td>
                                    <td class="align-middle">{{ ucfirst($item->role) }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group">
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
            </div>
        </div>

        <!-- Success message -->
        @if(session('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
