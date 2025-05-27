<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm" style="border-radius: 0 0 18px 18px;">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('user.dashboard') }}">
            <span style="letter-spacing:2px; font-size:1.3rem;">VolunteerNet</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item mx-1">
                    <a class="nav-link {{ request()->routeIs('recruitmentUser.index') ? 'active fw-bold' : '' }}" href="{{ route('recruitmentUser.index') }}">
                        <i class="bi bi-calendar2-event"></i> Daftar Event
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active fw-bold' : '' }}" href="{{ route('user.dashboard') }}">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">