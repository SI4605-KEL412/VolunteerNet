@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Notifikasi Saya</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideIn: { '0%': { transform: 'translateX(-100%)' }, '100%': { transform: 'translateX(0)' } },
                    }
                }
            },
            plugins: [
                require('@tailwindcss/line-clamp'), // Untuk line-clamp
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
    @php
        // Variabel $unreadNotificationsCount diasumsikan sudah di-pass dari controller
        // Jika tidak, Anda bisa menghitungnya di sini jika $notifications adalah collection semua data.
        // Namun, untuk paginasi, $notifications akan menjadi Paginator instance.
        // Contoh: $unreadNotificationsCount = $unreadNotificationsCount ?? Auth::user()->unreadNotifications()->count();
    @endphp
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
                <a href="{{ route('volunfeeds.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('volunfeeds.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-rss mr-3 text-yellow-400 group-hover:scale-110 transition-transform"></i>
                    <span>VoluFeed</span>
                </a>
                <a href="{{ route('user.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('user.notifications.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-bell mr-3 text-red-400 group-hover:scale-110 transition-transform"></i>
                    <span>Notifications</span>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">{{ $unreadNotificationsCount }}</span>
                    @endif
                </a>
                <a href="{{ route('forums.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('forums.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-people mr-3 text-purple-400 group-hover:scale-110 transition-transform"></i>
                    <span>Social Network</span>
                </a>
                <a href="{{ route('users.show', Auth::check() ? Auth::id() : 1) }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ (Auth::check() && request()->user()->id == (request()->route('userId') ?? Auth::id()) && (request()->routeIs('users.show') || request()->routeIs('user.profile'))) ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-person-circle mr-3 text-indigo-400 group-hover:scale-110 transition-transform"></i>
                    <span>Profile Details</span>
                </a>
            </div>
            <div class="pt-4 space-y-3 border-t border-slate-700">
                 <a href="{{ route('referral.index') }}" class="action-btn block w-full text-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-share mr-2"></i>
                    <span>Kode Referral Saya</span>
                </a>
                <a href="{{ route('recruitmentUser.index') }}" class="action-btn block w-full text-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-lg hover:from-emerald-600 hover:to-emerald-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-person-plus mr-2"></i>
                    <span>Recruitment Event</span>
                </a>
                <a href="{{ route('certifications.index') }}" class="action-btn block w-full text-center px-4 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-lg hover:from-amber-600 hover:to-amber-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-award mr-2"></i>
                    <span>Sertifikat Saya</span>
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-bell-fill text-red-400 mr-3"></i> Notifikasi Saya
                </h1>
                @if($notifications->where('status', 'unread')->count() > 0)
                    <form action="{{ route('user.notifications.read.all') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white rounded-xl shadow-lg transition-all text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
                            <i class="bi bi-check2-all"></i>
                            <span>Tandai Semua Dibaca</span>
                        </button>
                    </form>
                @endif
            </div>

            @if(session('success'))
                <div class="bg-green-800/40 border border-green-600/50 text-green-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-check-circle-fill text-2xl"></i>
                    <span class="text-base">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in">
                {{-- Pastikan $notifications adalah Paginator instance dari controller --}}
                @if($notifications->count() > 0)
                    <ul class="divide-y divide-slate-700/50">
                        @foreach($notifications as $notification)
                            <li class="px-5 py-4 flex flex-col sm:flex-row justify-between items-start gap-x-4 gap-y-3 transition-colors duration-150 {{ $notification->status === 'unread' ? 'bg-slate-800/60 hover:bg-slate-700/70' : 'hover:bg-slate-800/40' }}">
                                <div class="flex items-start flex-grow min-w-0"> {{-- min-w-0 untuk line-clamp --}}
                                    <i class="bi {{ $notification->status === 'unread' ? 'bi-envelope-fill text-blue-400 animate-pulse' : 'bi-envelope-open-fill text-slate-500' }} text-2xl mr-4 pt-1 flex-shrink-0"></i>
                                    <div class="flex-grow">
                                        <p class="text-xs font-medium text-slate-400/90 mb-0.5">{{ $notification->date_sent->format('F j, Y, g:i A') }}</p>
                                        <p class="text-sm text-slate-100 font-semibold mb-1 line-clamp-2 leading-snug" title="{{ $notification->message }}">
                                            {{ $notification->message }}
                                        </p>
                                        <button type="button" class="text-xs text-sky-400 hover:text-sky-300 font-medium focus:outline-none inline-flex items-center group" data-bs-toggle="modal" data-bs-target="#modal{{ $notification->notif_id }}">
                                            Lihat Selengkapnya <i class="bi bi-box-arrow-up-right text-xs ml-1 group-hover:translate-x-0.5 transition-transform"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="sm:ml-4 mt-3 sm:mt-0 flex-shrink-0 self-center sm:self-start">
                                    @if($notification->status === 'unread')
                                        <form action="{{ route('user.notifications.read', $notification->notif_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3.5 py-1.5 border border-sky-600/80 text-sky-400/90 hover:bg-sky-500/20 hover:text-sky-300 rounded-lg text-xs font-semibold transition-colors whitespace-nowrap shadow-sm hover:shadow-md">
                                                Tandai Dibaca
                                            </button>
                                        </form>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-700/40 text-green-300 ring-1 ring-inset ring-green-600/50 whitespace-nowrap">
                                            <i class="bi bi-check-circle-fill mr-1.5"></i>Sudah Dibaca
                                        </span>
                                    @endif
                                </div>
                            </li>

                            <div class="modal fade" id="modal{{ $notification->notif_id }}" tabindex="-1" aria-labelledby="modalLabel{{ $notification->notif_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content bg-slate-800 text-slate-200 rounded-xl shadow-xl border border-slate-700">
                                        <div class="modal-header px-6 py-4 border-b border-slate-700">
                                            <h5 class="modal-title text-lg font-semibold text-slate-100 flex items-center" id="modalLabel{{ $notification->notif_id }}">
                                                <i class="bi bi-chat-left-text-fill mr-2 text-blue-400"></i> Detail Notifikasi
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-6 text-sm text-slate-300 leading-relaxed whitespace-pre-wrap" style="max-height: 60vh; overflow-y: auto;">
                                            <p class="mb-2 text-xs text-slate-400">Dikirim: {{ $notification->date_sent->format('F j, Y, g:i A') }}</p>
                                            <hr class="border-slate-700 my-3">
                                            {{ $notification->message }}
                                        </div>
                                        <div class="modal-footer px-6 py-4 border-t border-slate-700">
                                            <button type="button" class="px-5 py-2 bg-slate-600 hover:bg-slate-500 text-slate-200 rounded-lg text-sm font-medium transition-colors" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-16">
                        <i class="bi bi-bell-slash-fill text-6xl text-slate-500 mb-6"></i>
                        <p class="text-2xl font-semibold text-white mb-2">Tidak Ada Notifikasi</p>
                        <p class="text-slate-400">Anda belum memiliki notifikasi saat ini.</p>
                    </div>
                @endif
            </div>
            
            {{-- Tampilkan link paginasi jika ada dan $notifications adalah Paginator --}}
            @if ($notifications instanceof \Illuminate\Pagination\AbstractPaginator && $notifications->hasPages())
                <div class="mt-10">
                     {{-- Pastikan Anda telah mem-publish view pagination dan menyesuaikannya untuk tema gelap,
                         atau gunakan view pagination kustom Anda. Contoh: 'vendor.pagination.tailwind-dark' --}}
                    {{ $notifications->links() }}
                </div>
            @endif


            <div class="mt-10 text-center">
                <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-8 py-3 border border-slate-600/80 text-slate-300 rounded-xl hover:bg-slate-700/70 hover:text-white hover:border-slate-500 transition-all duration-200 font-semibold text-sm shadow-lg transform hover:scale-105">
                    <i class="bi bi-arrow-left-circle-fill mr-2.5"></i> Kembali ke Dashboard Utama
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Skrip untuk mobile menu
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
        // Skrip untuk animasi item navigasi sidebar
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                if (!item.classList.contains('bg-slate-700')) { item.style.transform = 'translateX(4px)'; }
            });
            item.addEventListener('mouseleave', () => { item.style.transform = 'translateX(0)'; });
        });
        // Skrip untuk animasi tombol aksi sidebar
         document.querySelectorAll('.action-btn').forEach(btn => {
            const originalBoxShadow = btn.style.boxShadow || '0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05)';
            btn.addEventListener('mouseenter', () => { btn.style.boxShadow = '0 20px 25px -5px rgba(0,0,0,0.2), 0 10px 10px -5px rgba(0,0,0,0.1)'; });
            btn.addEventListener('mouseleave', () => { btn.style.boxShadow = originalBoxShadow; });
        });
    </script>
</body>
</html>