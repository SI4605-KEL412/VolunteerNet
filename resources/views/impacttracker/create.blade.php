@php
    // use Illuminate\Support\Str; // Tidak terlihat digunakan di sini
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Penilaian Impact Event: {{ $event->name }} - EO Dashboard</title>
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
                require('@tailwindcss/forms'), // Untuk styling form
            ],
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; /* slate-800 */ }
        ::-webkit-scrollbar-thumb { background: #3b82f6; /* blue-500 */ border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; /* blue-600 */ }

        /* Styling untuk input number agar ikon panah terlihat di tema gelap */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 0.3; /* Defaultnya terlalu gelap di dark mode */
        }
         input[type="number"]:hover::-webkit-inner-spin-button,
        input[type="number"]:hover::-webkit-outer-spin-button {
            opacity: 0.5;
        }
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <nav aria-label="breadcrumb" class="mb-6 text-sm animate-fade-in">
                <ol class="flex items-center space-x-2 text-slate-400">
                    <li>
                        <a href="{{ route('user.dashboardEO') }}" class="hover:text-purple-400 transition-colors">Dashboard EO</a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li>
                        <a href="{{ route('impacttracker.eo.index') }}" class="hover:text-purple-400 transition-colors">Impact Tracker</a>
                    </li>
                    <li><i class="bi bi-chevron-right text-xs"></i></li>
                    <li class="font-medium text-slate-200" aria-current="page">Penilaian: {{ $event->name }}</li>
                </ol>
            </nav>

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in">
                <div class="px-6 py-5 border-b border-slate-700/50">
                    <h1 class="text-2xl font-semibold text-slate-100 flex items-center">
                        <i class="bi bi-clipboard2-data-fill mr-3 text-purple-400"></i>Penilaian Impact: {{ $event->name }}
                    </h1>
                </div>

                <form method="POST" action="{{ route('impacttracker.eo.store', $event->event_id) }}" class="p-0">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-slate-800/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">User</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Jam Kontribusi</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Tugas Selesai</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Social Impact Score</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/60">
                                @forelse($users as $user)
                                    @php
                                        $impact = $user->impacttracker->where('event_id', $event->event_id)->first();
                                    @endphp
                                    <tr class="hover:bg-slate-700/40 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-100">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="number" step="0.1" name="users[{{ $user->user_id }}][hours_contributed]" value="{{ old('users.'.$user->user_id.'.hours_contributed', ($impact->hours_contributed ?? '')) }}" class="form-input w-full bg-slate-700/60 border-slate-600 placeholder-slate-400/80 text-slate-100 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 rounded-md shadow-sm text-sm px-3 py-2">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="number" name="users[{{ $user->user_id }}][tasks_completed]" value="{{ old('users.'.$user->user_id.'.tasks_completed', ($impact->tasks_completed ?? '')) }}" class="form-input w-full bg-slate-700/60 border-slate-600 placeholder-slate-400/80 text-slate-100 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 rounded-md shadow-sm text-sm px-3 py-2">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="number" step="0.1" name="users[{{ $user->user_id }}][social_impact_score]" value="{{ old('users.'.$user->user_id.'.social_impact_score', ($impact->social_impact_score ?? '')) }}" class="form-input w-full bg-slate-700/60 border-slate-600 placeholder-slate-400/80 text-slate-100 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 rounded-md shadow-sm text-sm px-3 py-2">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-slate-400">
                                            <div class="flex flex-col items-center justify-center">
                                                <i class="bi bi-people text-4xl text-slate-500 mb-3"></i>
                                                <p>Tidak ada user terdaftar untuk event ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($users->isNotEmpty())
                    <div class="px-6 py-5 border-t border-slate-700/50 bg-slate-800/20 flex flex-col sm:flex-row justify-end items-center gap-4">
                        <a href="{{ route('impacttracker.eo.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 font-semibold text-sm shadow-md">
                            <i class="bi bi-x-lg mr-2"></i> Batal
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-xl hover:from-purple-600 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-check-circle-fill mr-2"></i> Simpan Penilaian
                        </button>
                    </div>
                    @endif
                </form>
            </div>
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