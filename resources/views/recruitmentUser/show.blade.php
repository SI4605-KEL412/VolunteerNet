<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Pendaftaran Event - {{ $recruitment->event->title ?? 'Event' }}</title>
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
                require('@tailwindcss/typography'),
            ],
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; }
        /* Button utama agar lebih besar dan konsisten */
        .btn-main {
            min-width: 210px;
            width: 210px;
            max-width: 100%;
            justify-content: center;
            display: flex;
            font-size: 1.08rem !important;
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            border-radius: 0.75rem !important;
            font-weight: 600;
        }
        @media (max-width: 640px) {
            .btn-main {
                min-width: 100%;
                width: 100%;
            }
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

    <div class="lg:ml-64 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl w-full space-y-8 animate-fade-in">
            <div>
                <h1 class="text-center text-3xl md:text-4xl font-extrabold text-white flex items-center justify-center">
                    <i class="bi bi-file-earmark-text-fill text-emerald-400 mr-3 text-4xl"></i> Detail Pendaftaran
                </h1>
            </div>

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 overflow-hidden">
                <div class="px-6 py-5 bg-slate-800/40 border-b border-slate-700/50">
                    <h2 class="text-xl font-semibold text-slate-100 leading-tight">
                        {{ $recruitment->event->title ?? 'Informasi Event Tidak Tersedia' }}
                    </h2>
                    @if(isset($recruitment->event->description))
                    <p class="mt-1 text-sm text-slate-400 line-clamp-2">{{ $recruitment->event->description }}</p>
                    @endif
                </div>

                <dl class="divide-y divide-slate-700/50">
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-400">Tanggal Event</dt>
                        <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">
                            <i class="bi bi-calendar3 mr-1.5 text-sky-400"></i>
                            {{ isset($recruitment->event->start_date) ? \Carbon\Carbon::parse($recruitment->event->start_date)->isoFormat('D MMMM YYYY') : '-' }}
                            @if(isset($recruitment->event->end_date) && $recruitment->event->end_date != $recruitment->event->start_date)
                                &ndash; {{ \Carbon\Carbon::parse($recruitment->event->end_date)->isoFormat('D MMMM YYYY') }}
                            @endif
                        </dd>
                    </div>
                    @if(isset($recruitment->event->location))
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-400">Lokasi Event</dt>
                        <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">
                            <i class="bi bi-geo-alt-fill mr-1.5 text-pink-400"></i>
                            {{ $recruitment->event->location }}
                        </dd>
                    </div>
                    @endif
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-400">Motivasi Anda</dt>
                        <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2 whitespace-pre-line">{{ $recruitment->motivation }}</dd>
                    </div>
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-400">Status Pendaftaran</dt>
                        <dd class="mt-1 text-sm text-slate-200 sm:mt-0 sm:col-span-2">
                            @if($recruitment->status == 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-600/30 text-yellow-200 ring-1 ring-inset ring-yellow-500/40">
                                    <span class="h-2.5 w-2.5 rounded-full bg-yellow-400 mr-2"></span>Pending
                                </span>
                            @elseif($recruitment->status == 'accepted')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-600/30 text-green-200 ring-1 ring-inset ring-green-500/40">
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></span>Diterima
                                </span>
                            @elseif($recruitment->status == 'rejected')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-600/30 text-red-200 ring-1 ring-inset ring-red-500/40">
                                    <span class="h-2.5 w-2.5 rounded-full bg-red-400 mr-2"></span>Ditolak
                                </span>
                            @else
                                <span class="text-slate-400">{{ ucfirst($recruitment->status) }}</span>
                            @endif
                        </dd>
                    </div>
                     @if(isset($recruitment->admin_notes) && !empty($recruitment->admin_notes))
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-400">Catatan dari EO/Admin</dt>
                        <dd class="mt-1 text-sm text-slate-200 italic sm:mt-0 sm:col-span-2 whitespace-pre-line">{{ $recruitment->admin_notes }}</dd>
                    </div>
                    @endif
                    <div class="px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-slate-400">Tanggal Pendaftaran</dt>
                        <dd class="mt-1 text-sm text-slate-300 sm:mt-0 sm:col-span-2">
                            {{ $recruitment->date_applied ? \Carbon\Carbon::parse($recruitment->date_applied)->isoFormat('LLLL') : '-' }}
                        </dd>
                    </div>
                </dl>
                
                <div class="px-6 py-5 border-t border-slate-700/50 bg-slate-800/20 flex flex-col sm:flex-row justify-between items-center gap-3">
                    <a href="{{ route('recruitmentUser.index') }}" class="btn-main bg-slate-700 text-white hover:bg-slate-800 transition-colors duration-200 shadow-md">
                        <i class="bi bi-arrow-left-short mr-2 text-lg"></i> Kembali ke Daftar
                    </a>
                    <a href="{{ route('user.dashboard') }}" class="btn-main bg-sky-700 text-white hover:bg-sky-800 transition-colors duration-200 shadow-md">
                        <i class="bi bi-house-door-fill mr-2 text-lg"></i> Ke Dashboard Utama
                    </a>
                </div>
            </div>
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