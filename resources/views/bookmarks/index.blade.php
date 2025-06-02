@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Event yang Dibookmark</title>
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
                require('@tailwindcss/line-clamp'),
            ],
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; /* slate-800 */ }
        ::-webkit-scrollbar-thumb { background: #3b82f6; /* blue-500 */ border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; /* blue-600 */ }
         /* Minimal override untuk alert Bootstrap agar sesuai tema gelap (jika masih digunakan) */
        .alert-success {
            background-color: rgba(22, 163, 74, 0.2) !important;
            border-color: rgba(22, 163, 74, 0.4) !important;
            color: #86efac !important;
        }
        .alert-danger { /* Untuk session error jika ada */
            background-color: rgba(220, 53, 69, 0.15) !important;
            border-color: rgba(220, 53, 69, 0.3) !important;
            color: #f6aeb3 !important;
        }
        .alert-info { /* Untuk pesan "belum ada entri" jika menggunakan alert Bootstrap */
             background-color: rgba(59, 130, 246, 0.15) !important;
            border-color: rgba(59, 130, 246, 0.3) !important;
            color: #93c5fd !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 min-h-screen text-slate-200">
    <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-2 rounded-lg shadow-lg">
        <i class="bi bi-list text-xl"></i>
    </button>

    <div id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-slate-800 to-slate-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 shadow-2xl">
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-speedometer2 text-white"></i>
                </div>
                <h2 class="text-xl font-bold text-white">Dashboard</h2>
            </div>
        </div>
        <nav class="p-4 space-y-2">
            <div class="space-y-1">
                 <a href="{{ route('activities.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('activities.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-calendar-event mr-3 text-blue-400 group-hover:scale-110 transition-transform"></i>
                    <span>Activities</span>
                </a>
                <a href="{{ route('feedback.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('feedback.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-chat-square-text mr-3 text-green-400 group-hover:scale-110 transition-transform"></i>
                    <span>Feedback</span>
                </a>
                <a href="{{ route('volunfeeds.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('volunfeeds.*') || request()->routeIs('bookmarks.index') || request()->routeIs('portfolio.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-rss mr-3 text-yellow-400 group-hover:scale-110 transition-transform"></i>
                    <span>VoluFeed & Portfolio</span>
                </a>
                <a href="{{ route('user.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('user.notifications.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-bell mr-3 text-red-400 group-hover:scale-110 transition-transform"></i>
                    <span>Notifications</span>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('forums.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('forums.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-people mr-3 text-purple-400 group-hover:scale-110 transition-transform"></i>
                    <span>Social Network</span>
                </a>
                 <a href="{{ route('users.show', Auth::check() ? Auth::id() : 1) }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ (Auth::check() && Auth::id() == (request()->route('user') ? request()->route('user')->user_id : (isset($user) ? $user->user_id : null)) && (request()->routeIs('users.show') || request()->routeIs('user.profile'))) ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-person-circle mr-3 text-indigo-400 group-hover:scale-110 transition-transform"></i>
                    <span>Profile Details</span>
                </a>
            </div>
            <div class="pt-4 space-y-3 border-t border-slate-700">
                <a href="{{ route('referral.index') }}" class="action-btn {{ request()->routeIs('referral.index') ? 'ring-2 ring-sky-400 bg-gradient-to-r from-blue-600 to-blue-700' : 'bg-gradient-to-r from-blue-500 to-blue-600' }} block w-full text-center px-4 py-3 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-share-fill mr-2"></i>
                    <span>Kode Referral Saya</span>
                </a>
                <a href="{{ route('recruitmentUser.index') }}" class="action-btn {{ request()->routeIs('recruitmentUser.*') ? 'ring-2 ring-emerald-400 bg-gradient-to-r from-emerald-600 to-emerald-700' : 'bg-gradient-to-r from-emerald-500 to-emerald-600' }} block w-full text-center px-4 py-3 text-white rounded-lg hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-person-plus-fill mr-2"></i>
                    <span>Recruitment Event</span>
                </a>
                <a href="{{ route('certifications.index') }}" class="action-btn {{ request()->routeIs('certifications.index') || request()->routeIs('certifications.events') ? 'ring-2 ring-amber-400 bg-gradient-to-r from-amber-600 to-amber-700' : 'bg-gradient-to-r from-amber-500 to-amber-600' }} block w-full text-center px-4 py-3 text-white rounded-lg hover:from-amber-600 hover:to-amber-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-award-fill mr-2"></i>
                    <span>Sertifikat Saya</span>
                </a>
                <a href="{{ route('impacttracker.user.index') }}" class="action-btn {{ request()->routeIs('impacttracker.user.index') ? 'ring-2 ring-teal-400 bg-gradient-to-r from-teal-600 to-teal-700' : 'bg-gradient-to-r from-teal-500 to-teal-600' }} block w-full text-center px-4 py-3 text-white rounded-lg hover:from-teal-600 hover:to-teal-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-bar-chart-line-fill mr-2"></i>
                    <span>Impact Tracker Saya</span>
                </a>
                 <a href="{{ route('user.dashboardEO') }}" class="action-btn block w-full text-center px-4 py-3 bg-gradient-to-r from-slate-600 to-slate-700 text-white rounded-lg hover:from-slate-700 hover:to-slate-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-gear mr-2"></i>
                    <span>Go to EO Dashboard</span>
                </a>
            </div>
        </nav>
    </div>
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-bookmark-heart-fill text-pink-400 mr-3 text-4xl"></i> 
                    Event yang Dibookmark 
                    @if ($bookmarks instanceof \Illuminate\Pagination\AbstractPaginator && $bookmarks->total() > 0)
                        <span class="ml-3 inline-flex items-center justify-center px-3 py-1 text-sm font-medium text-pink-300 bg-pink-700/30 rounded-full ring-1 ring-inset ring-pink-600/50">
                            {{ $bookmarks->total() }}
                        </span>
                    @elseif ($bookmarks->isNotEmpty())
                         <span class="ml-3 inline-flex items-center justify-center px-3 py-1 text-sm font-medium text-pink-300 bg-pink-700/30 rounded-full ring-1 ring-inset ring-pink-600/50">
                            {{ $bookmarks->count() }}
                        </span>
                    @endif
                </h1>
                <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-medium text-sm shadow-md">
                    <i class="bi bi-house-door-fill mr-2"></i>Kembali ke Beranda
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-800/40 border border-green-600/50 text-green-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-check-circle-fill text-2xl"></i>
                    <span class="text-base">{{ session('success') }}</span>
                </div>
            @elseif(session('error'))
                <div class="bg-red-800/40 border border-red-600/50 text-red-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                    <span class="text-base">{{ session('error') }}</span>
                </div>
            @endif

            @if($bookmarks->isEmpty())
                <div class="text-center py-16 bg-white/5 backdrop-blur-sm rounded-xl border border-slate-700 shadow-xl animate-fade-in">
                    <i class="bi bi-bookmark-x-fill text-6xl text-slate-500 mb-6"></i>
                    <p class="text-2xl font-semibold text-white mb-2">Belum Ada Event yang Dibookmark</p>
                    <p class="text-slate-400 max-w-md mx-auto mb-6">Mulai bookmark event menarik untuk dilihat kembali nanti!</p>
                    <a href="{{ route('events.index') }}" class="px-8 py-3 bg-gradient-to-r from-sky-500 to-blue-600 text-white rounded-xl hover:from-sky-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-xl inline-flex items-center space-x-2 text-base font-semibold">
                        <i class="bi bi-search"></i>
                        <span>Cari Event</span>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8 animate-fade-in">
                    @foreach($bookmarks as $bookmark)
                        @if($bookmark->event) {{-- Pastikan event masih ada --}}
                        <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 flex flex-col overflow-hidden hover:border-pink-500/70 transition-all duration-300 ease-in-out transform hover:-translate-y-1.5">
                            <div class="flex flex-col flex-grow p-6">
                                <div class="mb-3">
                                    <h2 class="text-xl font-bold text-slate-50 hover:text-pink-400 transition-colors line-clamp-2 mb-1">
                                        {{-- PERBAIKAN ROUTE DI SINI --}}
                                        <a href="{{ route('event.show', $bookmark->event->event_id) }}">
                                            {{ $bookmark->event->title ?? '-' }}
                                        </a>
                                    </h2>
                                    <p class="text-sm text-slate-300 leading-relaxed line-clamp-3">{{ Str::limit($bookmark->event->description ?? '', 100) }}</p>
                                </div>
                                <div class="text-xs text-slate-400 space-y-1.5 mb-4">
                                    <div class="flex items-center">
                                        <i class="bi bi-calendar3 mr-2 text-sky-400"></i>
                                        {{ isset($bookmark->event->start_date) ? \Carbon\Carbon::parse($bookmark->event->start_date)->isoFormat('D MMM YY') : '-' }}
                                    </div>
                                    @if(isset($bookmark->event->location))
                                    <div class="flex items-center">
                                        <i class="bi bi-geo-alt-fill mr-2 text-emerald-400"></i> {{ $bookmark->event->location }}
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="mt-auto pt-4 border-t border-slate-700/50 flex flex-wrap gap-2 justify-start">
                                    {{-- PERBAIKAN ROUTE DI SINI --}}
                                    <a href="{{ route('event.show', $bookmark->event->event_id) }}" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-sky-600/80 hover:bg-sky-700/90 text-white">
                                        <i class="bi bi-info-circle-fill mr-1.5"></i> Detail Event
                                    </a>
                                    <form action="{{ route('bookmarks.destroy', $bookmark->bookmark_id) }}" method="POST" class="contents" onsubmit="return confirm('Anda yakin ingin menghapus bookmark ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-rose-600/80 hover:bg-rose-700/90 text-white">
                                            <i class="bi bi-bookmark-x-fill mr-1.5"></i> Hapus Bookmark
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                {{-- Paginasi --}}
                @if ($bookmarks instanceof \Illuminate\Pagination\AbstractPaginator && $bookmarks->hasPages())
                    <div class="mt-10">
                        {{ $bookmarks->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        if (mobileMenuBtn && sidebar && sidebarOverlay) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            });
            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });
        }
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                if (!item.classList.contains('bg-slate-700')) { item.style.transform = 'translateX(4px)'; }
            });
            item.addEventListener('mouseleave', () => { item.style.transform = 'translateX(0)'; });
        });
         document.querySelectorAll('.action-btn').forEach(btn => {
            const originalBoxShadow = btn.style.boxShadow || '0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05)';
            btn.addEventListener('mouseenter', () => { btn.style.boxShadow = '0 20px 25px -5px rgba(0,0,0,0.2), 0 10px 10px -5px rgba(0,0,0,0.1)'; });
            btn.addEventListener('mouseleave', () => { btn.style.boxShadow = originalBoxShadow; });
        });
    </script>
</body>
</html>
