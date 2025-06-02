<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Impact Tracker - EO Dashboard</title>
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
                // require('@tailwindcss/forms'), // Tidak ada form input langsung di sini
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
    <button id="mobile-menu-btn-eo" class="lg:hidden fixed top-4 left-4 z-[60] bg-purple-600 text-white p-2 rounded-lg shadow-lg">
        <i class="bi bi-list text-xl"></i>
    </button>

    <div id="sidebar-eo" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-slate-800 to-slate-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 shadow-2xl">
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-person-workspace text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-white">EO Panel</h2>
            </div>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('user.dashboardEO') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-grid-1x2-fill mr-3 text-slate-400 group-hover:text-purple-400 transition-colors"></i>
                <span>Dashboard EO</span>
            </a>
            <a href="{{ route('events.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('events.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-calendar-event-fill mr-3 text-slate-400 group-hover:text-purple-400 transition-colors"></i>
                <span>Manage Events</span>
            </a>
            <a href="{{ route('impacttracker.eo.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('impacttracker.eo.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-graph-up-arrow mr-3 text-slate-400 group-hover:text-purple-400 transition-colors"></i>
                <span>Impact Tracker</span>
            </a>
            {{-- Tambahkan link navigasi EO lainnya di sini --}}
        </nav>
    </div>
    <div id="sidebar-overlay-eo" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>


    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <nav aria-label="breadcrumb" class="mb-6 text-sm animate-fade-in">
                <ol class="flex items-center space-x-2 text-slate-400">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-purple-400 transition-colors">Dashboard EO</a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li class="font-medium text-slate-200" aria-current="page">Impact Tracker Event</li>
                </ol>
            </nav>

            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-card-checklist text-purple-400 mr-3 text-4xl"></i> Event untuk Penilaian Impact
                </h1>
                {{-- Tombol aksi di header jika perlu, misal:
                <a href="#" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-medium text-sm shadow-md">
                    <i class="bi bi-plus-circle-fill mr-2"></i> Tambah Sesuatu
                </a> 
                --}}
            </div>
            
            @if(session('success'))
                <div class="bg-green-800/40 border border-green-600/50 text-green-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-check-circle-fill text-2xl"></i>
                    <span class="text-base">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-800/40 border border-red-600/50 text-red-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                    <span class="text-base">{{ session('error') }}</span>
                </div>
            @endif


            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in">
                @if($events->isEmpty())
                    <div class="text-center py-16 px-6">
                        <i class="bi bi-calendar2-x-fill text-6xl text-slate-500 mb-6"></i>
                        <p class="text-2xl font-semibold text-white mb-2">Belum Ada Event</p>
                        <p class="text-slate-400">Tidak ada event yang perlu dinilai impactnya saat ini.</p>
                        {{-- Mungkin tombol untuk membuat event baru jika relevan --}}
                        {{-- <a href="{{ route('events.create') }}" class="mt-6 inline-flex items-center px-7 py-2.5 bg-gradient-to-r from-sky-500 to-cyan-600 text-white rounded-xl hover:from-sky-600 hover:to-cyan-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-calendar-plus-fill mr-2"></i> Buat Event Baru
                        </a> --}}
                    </div>
                @else
                    <ul class="divide-y divide-slate-700/50">
                        @foreach($events as $event)
                            <li class="px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:bg-slate-800/40 transition-colors duration-150">
                                <div class="flex-grow">
                                    <h2 class="text-lg font-semibold text-slate-100">{{ $event->title }}</h2>
                                    <p class="text-xs text-slate-400">
                                        <i class="bi bi-calendar3 mr-1"></i> 
                                        {{ \Carbon\Carbon::parse($event->start_date ?? $event->event_date)->isoFormat('D MMM YYYY') }}
                                        @if(isset($event->end_date) && $event->end_date != ($event->start_date ?? $event->event_date))
                                            &ndash; {{ \Carbon\Carbon::parse($event->end_date)->isoFormat('D MMM YYYY') }}
                                        @endif
                                    </p>
                                </div>
                                <a href="{{ route('impacttracker.eo.create', $event->event_id) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-lg font-semibold text-xs flex-shrink-0">
                                    <i class="bi bi-clipboard2-data-fill mr-2"></i> Nilai Impact Event
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            
            @if ($events instanceof \Illuminate\Pagination\AbstractPaginator && $events->hasPages())
                <div class="mt-10">
                    {{ $events->links() }} {{-- Pastikan view pagination sudah di-style untuk Tailwind --}}
                </div>
            @endif

        </div>
    </div>

    <script>
        // Skrip untuk mobile menu EO
        const mobileMenuBtnEo = document.getElementById('mobile-menu-btn-eo');
        const sidebarEo = document.getElementById('sidebar-eo');
        const sidebarOverlayEo = document.getElementById('sidebar-overlay-eo');
        if (mobileMenuBtnEo && sidebarEo && sidebarOverlayEo) {
            mobileMenuBtnEo.addEventListener('click', () => {
                sidebarEo.classList.toggle('-translate-x-full');
                sidebarOverlayEo.classList.toggle('hidden');
            });
            sidebarOverlayEo.addEventListener('click', () => {
                sidebarEo.classList.add('-translate-x-full');
                sidebarOverlayEo.classList.add('hidden');
            });
        }
        // Skrip untuk animasi item navigasi sidebar EO
        document.querySelectorAll('#sidebar-eo .nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                if (!item.classList.contains('bg-slate-700')) { item.style.transform = 'translateX(4px)'; }
            });
            item.addEventListener('mouseleave', () => { item.style.transform = 'translateX(0)'; });
        });
    </script>
</body>
</html>