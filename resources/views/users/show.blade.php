<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
            color: #003366;
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

        .user-detail-label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }

        .user-detail-item {
            margin-bottom: 1rem;
        }

        .btn-action {
            padding: 8px 24px;
            border-radius: 6px;
            font-weight: 500;
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
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('activities.index') }}">Activities</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('feedback.index') }}">Feedback</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('volunfeeds.index') }}">VoluFeed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.notifications.index') }}">Notification</a>
        </li>
        <!-- Tombol Referral -->
        <li class="nav-item mt-3">
            <a class="nav-link btn btn-info text-white" href="{{ route('referral.index') }}">Kode Referral Saya</a>
        </li>
        <!-- Tombol Sertifikat -->
        <li class="nav-item mt-3">
            <a class="nav-link btn btn-warning text-white" href="{{ route('certifications.index') }}">Sertifikat Saya</a>
        </li>
        <!-- Link Social Network -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('forums.index') }}">Social Network</a>
        </li>
        <!-- Detail -->
        <li class="nav-item">
            <a class="nav-link active" href="#">Profile</a>
        </li> --}}
        <!-- Link ke EO Dashboard -->
        {{-- <li class="nav-item mt-3">
            <a class="nav-link btn btn-light text-dark" href="{{ route('user.dashboardEO') }}">Go to EO Dashboard</a>
        </li> --}}
    </ul>
</div>

<!-- Main Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">Detail Pengguna</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-action">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Profil Pengguna</h5>
        </div>
        <div class="card-body">

            <!-- Form Edit Nama -->
            <form action="{{ route('users.updateName', $user->user_id) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <label for="name" class="form-label"><strong>Nama</strong></label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $user->name) }}"
                               class="form-control @error('name') is-invalid @enderror"
                               required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-action">
                            <i class="fas fa-save me-2"></i>Simpan Nama
                        </button>
                        <a href="{{ route('users.show', $user->user_id) }}" class="btn btn-secondary btn-action">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </div>
                </div>
            </form>

            <hr />

            <div class="user-detail-item">
                <span class="user-detail-label">Email</span>
                <span>{{ $user->email }}</span>
            </div>

            <div class="user-detail-item">
                <span class="user-detail-label">Role</span>
                <span class="badge bg-primary text-white">{{ ucfirst($user->role) }}</span>
            </div>

            <div class="user-detail-item">
                <span class="user-detail-label">Points</span>
                <span class="text-primary fw-bold">{{ number_format($user->points) }}</span>
            </div>

            <div class="user-detail-item">
                <span class="user-detail-label">Terdaftar Sejak</span>
                <span class="text-muted">{{ $user->created_at->format('d M Y') }}</span>
            </div>

            <div class="user-detail-item">
                <span class="user-detail-label">Terakhir Diubah</span>
                <span class="text-muted">{{ $user->updated_at->diffForHumans() }}</span>
            </div>

            <!-- Jika ada referral program -->
            @if($user->referralProgram)
                <div class="user-detail-item">
                    <span class="user-detail-label">Kode Referral</span>
                    <span><code>{{ $user->referralProgram->referral_code }}</code></span>
                </div>
            @endif

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>