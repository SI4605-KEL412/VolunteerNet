<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Event: {{ $event->title }} - Admin Dashboard</title>
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
                require('@tailwindcss/typography'), // Untuk styling konten deskripsi
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <nav aria-label="breadcrumb" class="mb-6 text-sm animate-fade-in">
                <ol class="flex items-center space-x-2 text-slate-400">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-400 transition-colors">Dashboard Admin</a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li>
                        <a href="{{ route('events.index') }}" class="hover:text-sky-400 transition-colors">Daftar Event</a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li class="font-medium text-slate-200 truncate max-w-xs" aria-current="page" title="{{ $event->title }}">Detail Event</li>
                </ol>
            </nav>

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in overflow-hidden">
                <div class="px-6 py-5 bg-slate-800/40 border-b border-slate-700/50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <h1 class="text-2xl lg:text-3xl font-bold text-slate-50 leading-tight flex items-center">
                            <i class="bi bi-calendar2-week-fill mr-3 text-sky-400"></i>{{ $event->title }}
                        </h1>
                        <div>
                            @if ($event->status == 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-600/30 text-yellow-200 ring-1 ring-inset ring-yellow-500/40">
                                    <i class="bi bi-hourglass-split mr-1.5"></i> Pending
                                </span>
                            @elseif ($event->status == 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-600/30 text-green-200 ring-1 ring-inset ring-green-500/40">
                                    <i class="bi bi-check-circle-fill mr-1.5"></i> Approved
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-600/30 text-red-200 ring-1 ring-inset ring-red-500/40">
                                    <i class="bi bi-x-circle-fill mr-1.5"></i> {{ ucfirst($event->status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <dl class="divide-y divide-slate-700/50">
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-slate-400 flex items-center"><i class="bi bi-text-paragraph mr-2 text-lg"></i>Deskripsi</dt>
                            <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2 prose prose-sm prose-invert max-w-none text-slate-200/90 leading-relaxed">
                                {!! nl2br(e($event->description)) !!}
                            </dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-slate-400 flex items-center"><i class="bi bi-geo-alt-fill mr-2 text-lg"></i>Lokasi</dt>
                            <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">{{ $event->location ?? '-' }}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-slate-400 flex items-center"><i class="bi bi-calendar-range mr-2 text-lg"></i>Tanggal Mulai</dt>
                            <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->isoFormat('LLLL') : '-' }}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-slate-400 flex items-center"><i class="bi bi-calendar-check mr-2 text-lg"></i>Tanggal Selesai</dt>
                            <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->isoFormat('LLLL') : '-' }}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-slate-400 flex items-center"><i class="bi bi-person-video3 mr-2 text-lg"></i>ID Organizer</dt>
                            <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">{{ $event->organizer_id ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
                 <div class="px-6 py-5 border-t border-slate-700/50 bg-slate-800/20 flex flex-col sm:flex-row justify-end items-center gap-3">
                    <a href="{{ route('events.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 font-semibold text-sm shadow-md">
                        <i class="bi bi-list-ul mr-2"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('events.edit', $event->event_id) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                        <i class="bi bi-pencil-square mr-2"></i> Edit Event
                    </a>
                    <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" class="w-full sm:w-auto contents" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-red-600 to-rose-700 text-white rounded-xl hover:from-red-700 hover:to-rose-800 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-trash3-fill mr-2"></i> Hapus Event
                        </button>
                    </form>
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