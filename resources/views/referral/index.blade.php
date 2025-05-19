<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Referral Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
            color: #003366;
            min-height: 100vh;
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

        h1 {
            margin-bottom: 2rem;
        }

        .referral-card {
            background: white;
            color: #003366;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
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
            <li class="nav-item">
                <a class="nav-link btn btn-light text-dark mt-3" href="{{ route('referral.index') }}">Kode Referral Saya</a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link btn btn-light text-dark" href="{{ route('admin.dashboard') }}">Go to EO Dashboard</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h1>Referral Saya</h1>

        @if(!$referralCode)
            <div class="alert alert-info">Anda belum memiliki kode referral.</div>
            <form action="{{ route('referral.generate') }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="btn btn-success">Buat Kode Referral</button>
            </form>
        @else
            <div class="referral-card mb-4">
                <h5>Kode Referral Anda: <strong>{{ $referralCode }}</strong></h5>
                <p>Status: Active</p>
            </div>

            @if($referrals->isEmpty())
                <div class="alert alert-warning">Belum ada user yang menggunakan kode referral Anda.</div>
            @else
                @foreach($referrals as $referral)
                    <div class="referral-card">
                        <p>User yang direfer: <strong>{{ $referral->referredUser->name ?? 'user' }}</strong></p>
                        <p>Tanggal Referral: {{ \Carbon\Carbon::parse($referral->date_referred)->format('d M Y') }}</p>
                        @if($referral->reward_earned)
                            <p>Reward Didapat: {{ $referral->reward_earned }}</p>
                        @endif
                    </div>
                @endforeach
            @endif
        @endif

        @php
            use App\Models\ReferralProgram;
            use App\Models\User;

            $referral = ReferralProgram::with('referrer')->where('referred_user_id', auth()->user()->user_id)->first();
        @endphp

        @if(!$referral)
            <div class="referral-card mb-4">
                <h5>Masukkan Kode Referral Orang Lain</h5>
                <form method="POST" action="{{ route('referral.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="referral_code" class="form-label">Kode Referral</label>
                        <input type="text" class="form-control" name="referral_code" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Gunakan Kode Ini</button>
                </form>
            </div>
        @else
            <div class="referral-card mb-4">
                <p class="mb-0">Kamu sudah pernah submit kode referalnya <strong>{{ $referral->referrer->name ?? 'user' }}</strong>.</p>
            </div>
        @endif

        <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-4">Kembali ke Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
