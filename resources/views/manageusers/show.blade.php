<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Details: {{ $user->name }} - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.5s ease-out', // Untuk sidebar
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideIn: { '0%': { transform: 'translateX(-100%)' }, '100%': { transform: 'translateX(0)' } },
                    }
                }
            },
            plugins: [
                require('@tailwindcss/typography'), // Untuk styling teks jika ada HTML di profiledetails
            ],
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; /* slate-800 */ }
        ::-webkit-scrollbar-thumb { background: #3b82f6; /* blue-500 */ border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; /* blue-600 */ }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 min-h-screen text-slate-200">
    <button id="mobile-menu-btn-admin" class="lg:hidden fixed top-4 left-4 z-[60] bg-sky-600 text-white p-2 rounded-lg shadow-lg">
        <i class="bi bi-list text-xl"></i>
    </button>

    <div id="sidebar-admin" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-slate-800 to-slate-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 shadow-2xl">
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-sky-500 to-cyan-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-shield-lock-fill text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-white">Admin Panel</h2>
            </div>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-grid-1x2-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Dashboard Utama</span>
            </a>
            <a href="{{ route('manageusers.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('manageusers.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-people-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Users</span>
            </a>
            <a href="{{ route('events.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('events.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-calendar-event-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Events</span>
            </a>
             <a href="{{ route('admin.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.notifications.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-bell-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Notification</span>
            </a>
            {{-- Tambahkan link navigasi admin lainnya di sini --}}
        </nav>
    </div>
    <div id="sidebar-overlay-admin" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>


    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-person-vcard-fill text-sky-400 mr-3 text-4xl"></i> User Details
                </h1>
                {{-- Tombol Kembali ke Daftar User, bukan ke dashboard admin utama --}}
                <a href="{{ route('manageusers.index') }}" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-medium text-sm shadow-md">
                    <i class="bi bi-arrow-left-circle-fill mr-2"></i>Kembali ke Daftar User
                </a>
            </div>

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in">
                <div class="p-6 md:p-8">
                    <div class="md:grid md:grid-cols-12 md:gap-8">
                        <div class="md:col-span-4 text-center md:text-left mb-8 md:mb-0 md:border-r md:border-slate-700/50 md:pr-8">
                            <div class="w-32 h-32 mx-auto md:mx-0 rounded-full bg-gradient-to-br from-sky-500 via-cyan-500 to-blue-600 flex items-center justify-center text-white text-6xl font-semibold mb-5 shadow-xl ring-4 ring-sky-500/30">
                                {{-- Jika ada gambar profil, tampilkan di sini. Jika tidak, gunakan inisial. --}}
                                {{-- <img src="{{ $user->profile_photo_url ?? '' }}" alt="{{ $user->name }}" class="w-full h-full object-cover rounded-full"> --}}
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <h2 class="text-2xl lg:text-3xl font-bold text-slate-50 mb-1">{{ $user->name }}</h2>
                            <p class="text-sm text-sky-300 mb-3">{{ $user->email }}</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                @if($user->role == 'admin') bg-red-500/20 text-red-300 ring-1 ring-inset ring-red-500/40
                                @elseif($user->role == 'eo') bg-amber-500/20 text-amber-300 ring-1 ring-inset ring-amber-500/40
                                @else bg-sky-500/20 text-sky-300 ring-1 ring-inset ring-sky-500/40 @endif">
                                <i class="bi bi-shield-check mr-1.5"></i> {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        <div class="md:col-span-8">
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold text-slate-100 mb-4 pb-2 border-b border-slate-700/50">Informasi Pengguna</h3>
                                <dl class="space-y-3">
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-slate-400">Nama Lengkap</dt>
                                        <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">{{ $user->name }}</dd>
                                    </div>
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-slate-400">Email</dt>
                                        <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">{{ $user->email }}</dd>
                                    </div>
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-slate-400">Role</dt>
                                        <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">{{ ucfirst($user->role) }}</dd>
                                    </div>
                                     <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-slate-400">Terdaftar Sejak</dt>
                                        <dd class="mt-1 text-sm text-slate-300 sm:mt-0 sm:col-span-2">{{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->isoFormat('LL') : '-' }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold text-slate-100 mb-4 pb-2 border-b border-slate-700/50">Detail Profil Tambahan</h3>
                                <div class="prose prose-sm prose-invert max-w-none text-slate-300/90 leading-relaxed">
                                    @if($user->profiledetails)
                                        {!! nl2br(e($user->profiledetails)) !!}
                                    @else
                                        <p class="italic">Tidak ada detail profil tambahan yang diberikan.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-5 border-t border-slate-700/50 bg-slate-800/20 flex flex-col sm:flex-row justify-end items-center gap-3">
                    <a href="{{ route('manageusers.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 font-semibold text-sm shadow-md">
                        <i class="bi bi-list-ul mr-2"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('manageusers.edit', $user->user_id) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                        <i class="bi bi-pencil-square mr-2"></i> Edit Pengguna
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Skrip untuk mobile menu admin
        const mobileMenuBtnAdmin = document.getElementById('mobile-menu-btn-admin');
        const sidebarAdmin = document.getElementById('sidebar-admin');
        const sidebarOverlayAdmin = document.getElementById('sidebar-overlay-admin');
        if (mobileMenuBtnAdmin && sidebarAdmin && sidebarOverlayAdmin) {
            mobileMenuBtnAdmin.addEventListener('click', () => {
                sidebarAdmin.classList.toggle('-translate-x-full');
                sidebarOverlayAdmin.classList.toggle('hidden');
            });
            sidebarOverlayAdmin.addEventListener('click', () => {
                sidebarAdmin.classList.add('-translate-x-full');
                sidebarOverlayAdmin.classList.add('hidden');
            });
        }
        // Skrip untuk animasi item navigasi sidebar
        document.querySelectorAll('#sidebar-admin .nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                if (!item.classList.contains('bg-slate-700')) { item.style.transform = 'translateX(4px)'; }
            });
            item.addEventListener('mouseleave', () => { item.style.transform = 'translateX(0)'; });
        });
    </script>
</body>
</html>