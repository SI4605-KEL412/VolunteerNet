<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Certifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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

        .sidebar a.nav-link:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
        }

        .table thead {
            background-color: #004080;
            color: white;
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
                <a class="nav-link" href="{{ route('feedback.index') }}">Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('portfolio.index') }}">Build Portfolio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.notifications.index') }}">Notification</a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link btn btn-info text-white" href="{{ route('referral.index') }}">Kode Referral Saya</a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link btn btn-light text-dark" href="{{ route('admin.dashboard') }}">Go to EO Dashboard</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2 class="mb-4">Daftar Sertifikat Saya</h2>

        <!-- Tombol ke halaman Certification Events -->
        <a href="{{ route('certifications.events') }}" class="btn btn-primary mb-3">
            Lihat Event & Generate Sertifikat
        </a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($certifications->isEmpty())
        <div class="alert alert-info">
            Belum ada sertifikat yang diterbitkan.
        </div>
        @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Judul Sertifikat</th>
                    <th>Event</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certifications as $cert)
                <tr>
                    <td>{{ $cert->title }}</td>
                    <td>{{ $cert->event->title ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($cert->issued_date)->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('certifications.destroy', $cert->cert_id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
