<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm" style="border-radius: 0 0 18px 18px;">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('user.dashboard') }}">
            <span style="letter-spacing:2px; font-size:1.5rem;">
                <i class="bi bi-stars me-1"></i>VolunteerNet
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->routeIs('recruitmentUser.index') ? 'active fw-bold' : '' }}" href="{{ route('recruitmentUser.index') }}">
                        <i class="bi bi-calendar2-event"></i> <span>Daftar Event</span>
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link d-flex align-items-center gap-1 {{ request()->routeIs('user.dashboard') ? 'active fw-bold' : '' }}" href="{{ route('user.dashboard') }}">
                        <i class="bi bi-house-door"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mx-1 dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> <span>Akun</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('user.dashboard') }}">
                                <i class="bi bi-person"></i> Profil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>
                    </ul>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>