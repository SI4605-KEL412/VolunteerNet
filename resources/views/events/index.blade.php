<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manage Events - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Bootstrap CSS di-keep untuk Toast/Alert dismiss --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                require('@tailwindcss/line-clamp'),
            ],
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; /* slate-800 */ }
        ::-webkit-scrollbar-thumb { background: #3b82f6; /* blue-500 */ border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; /* blue-600 */ }

        /* Minimal override untuk alert Bootstrap agar sesuai tema gelap */
        .alert-success {
            background-color: rgba(22, 163, 74, 0.2) !important; /* bg-green-700/20 */
            border-color: rgba(22, 163, 74, 0.4) !important; /* border-green-600/40 */
            color: #86efac !important; /* text-green-300 */
        }
        .alert-success .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
         .alert-info {
            background-color: rgba(59, 130, 246, 0.15) !important; /* bg-blue-600/15 */
            border-color: rgba(59, 130, 246, 0.3) !important; /* border-blue-500/30 */
            color: #93c5fd !important; /* text-blue-300 */
        }
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
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="bg-white/5 backdrop-blur-md p-6 rounded-xl shadow-2xl mb-10 border border-slate-700/50 animate-fade-in">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                        <i class="bi bi-calendar-range-fill text-sky-400 mr-3 text-4xl"></i>Daftar Event
                    </h1>
                    <a href="{{ route('events.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-sky-500 to-cyan-600 text-white rounded-xl hover:from-sky-600 hover:to-cyan-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                        <i class="bi bi-plus-circle-dotted mr-2"></i> Buat Event Baru
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-6 animate-fade-in" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
             @if(session('error')) {{-- Tambahkan ini jika Anda menggunakan session error --}}
                <div class="bg-red-800/40 border border-red-600/50 text-red-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                    <span class="text-base">{{ session('error') }}</span>
                </div>
            @endif


            @if($events->isEmpty())
                <div class="bg-white/5 backdrop-blur-sm rounded-xl border border-slate-700/50 p-10 text-center animate-fade-in">
                    <i class="bi bi-calendar-x-fill text-6xl text-slate-500 mb-6"></i>
                    <p class="text-2xl font-semibold text-white mb-2">Tidak Ada Event Ditemukan</p>
                    <p class="text-slate-400">Saat ini belum ada event yang dibuat atau ditemukan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8 animate-fade-in">
                    @foreach($events as $event)
                        <div class="relative bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 flex flex-col overflow-hidden hover:border-sky-500/70 transition-all duration-300 ease-in-out transform hover:-translate-y-1.5">
                            <div class="absolute top-4 right-4 z-10">
                                @if ($event->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-600/30 text-yellow-200 ring-1 ring-inset ring-yellow-500/40">
                                        <i class="bi bi-hourglass-split mr-1.5"></i> Pending
                                    </span>
                                @elseif ($event->status == 'approved')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-600/30 text-green-200 ring-1 ring-inset ring-green-500/40">
                                        <i class="bi bi-check-circle-fill mr-1.5"></i> Approved
                                    </span>
                                @else {{-- rejected or other statuses --}}
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-600/30 text-red-200 ring-1 ring-inset ring-red-500/40">
                                        <i class="bi bi-x-circle-fill mr-1.5"></i> {{ ucfirst($event->status) }}
                                    </span>
                                @endif
                            </div>
                            
                            {{-- Jika ada gambar event:
                            <img src="{{ $event->image_url ?? 'https://via.placeholder.com/400x250/1e293b/94a3b8?text=Event+Image' }}" alt="Event: {{ $event->title }}" class="w-full h-48 object-cover group-hover:opacity-90 transition-opacity">
                            --}}
                            
                            <div class="px-6 py-5 border-b border-slate-700/50 bg-slate-800/20">
                                <h2 class="text-lg font-bold text-slate-50 hover:text-sky-400 transition-colors line-clamp-2 leading-tight">
                                    {{ $event->title }}
                                </h2>
                            </div>

                            <div class="p-6 flex-grow">
                                <div class="text-xs text-slate-400 space-y-2 mb-4">
                                    <div class="flex items-center">
                                        <i class="bi bi-geo-alt-fill mr-2 text-pink-400"></i>
                                        <span>{{ $event->location ?? 'Lokasi tidak tersedia' }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="bi bi-calendar3 mr-2 text-sky-400"></i>
                                        <span>{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->isoFormat('D MMMM YYYY') : 'Tanggal tidak tersedia' }}</span>
                                    </div>
                                     {{-- Jika ada deskripsi singkat
                                    <p class="text-sm text-slate-300 line-clamp-2">{{ Str::limit($event->description, 80) }}</p>
                                    --}}
                                </div>
                            </div>

                            <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-800/30 flex flex-wrap gap-2 justify-start">
                                <a href="{{ route('event.show', $event->event_id) }}" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-sky-600/80 hover:bg-sky-700/90 text-white">
                                    <i class="bi bi-eye-fill mr-1.5"></i> Lihat
                                </a>
                                <a href="{{ route('events.edit', $event->event_id) }}" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-amber-500/80 hover:bg-amber-600/90 text-slate-900">
                                    <i class="bi bi-pencil-square mr-1.5"></i> Edit
                                </a>
                                <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" class="contents" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-rose-600/80 hover:bg-rose-700/90 text-white">
                                        <i class="bi bi-trash3-fill mr-1.5"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                 @if ($events instanceof \Illuminate\Pagination\AbstractPaginator && $events->hasPages())
                    <div class="mt-10">
                        {{ $events->links() }} {{-- Pastikan view pagination sudah di-style untuk Tailwind --}}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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