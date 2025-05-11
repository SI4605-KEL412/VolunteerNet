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
                <a class="nav-link" href="#">Manage Events</a>
            </li>
        </ul>
    </div>

<!-- Main Content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header d-flex justify-content-between align-items-center">
                    <h1 class="fw-bold">Edit User</h1>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('manageusers.update', $user->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Role Section - Revisi -->
                    <div class="mb-3"> <!-- Samakan dengan spacing form lainnya -->
                        <label for="role" class="form-label fw-bold">Role</label> <!-- Tambah fw-bold untuk konsistensi -->
                        <div class="form-control bg-light">{{ ucfirst($user->role) }}</div>
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profile Details Section - Revisi -->
                    <div class="mb-3"> <!-- Gunakan mb-3 bukan form-group -->
                        <label for="profiledetails" class="form-label fw-bold">Profile Details</label>
                        <textarea class="form-control @error('profiledetails') is-invalid @enderror" id="profiledetails" name="profiledetails" rows="3">{{ old('profiledetails', $user->profiledetails) }}</textarea>
                        @error('profiledetails')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('manageusers.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update User
                        </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
