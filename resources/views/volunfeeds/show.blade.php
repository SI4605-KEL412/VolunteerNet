<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Portfolio - {{ $portfolio->title }}</title>
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
                require('@tailwindcss/typography'), // Untuk kelas .prose
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
                <a href="{{ route('feedback.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('feedback.index') || request()->routeIs('feedback.create') || request()->routeIs('feedback.show') || request()->routeIs('feedback.edit') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-chat-square-text mr-3 text-green-400 group-hover:scale-110 transition-transform"></i>
                    <span>Feedback</span>
                </a>
                <a href="{{ route('volunfeeds.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('volunfeeds.index') || request()->routeIs('volunfeeds.show') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-rss mr-3 text-yellow-400 group-hover:scale-110 transition-transform"></i>
                    <span>VoluFeed</span>
                </a>
                <a href="{{ route('user.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('user.notifications.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-bell mr-3 text-red-400 group-hover:scale-110 transition-transform"></i>
                    <span>Notifications</span>
                    <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">3</span>
                </a>
                <a href="{{ route('forums.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('forums.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-people mr-3 text-purple-400 group-hover:scale-110 transition-transform"></i>
                    <span>Social Network</span>
                </a>
                <a href="{{ route('users.show', Auth::check() ? Auth::id() : 1) }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('users.show') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
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
            
            <div class="mb-10">
                 <h1 class="text-3xl md:text-4xl font-bold text-white text-center sm:text-left">
                    <i class="bi bi-file-earmark-richtext-fill text-yellow-400"></i> Detail Portfolio
                </h1>
            </div>

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 overflow-hidden animate-fade-in">
                {{-- Card Header --}}
                <div class="px-6 py-5 border-b border-slate-700/50 flex flex-col sm:flex-row justify-between items-start sm:items-center bg-slate-800/40">
                    <div>
                        <a href="{{ route('user.profile', ['userId' => $portfolio->user_id]) }}" class="inline-flex items-center font-semibold text-lg text-blue-300 hover:text-blue-200 transition-colors">
                            <i class="bi bi-person-circle mr-2.5 text-xl"></i>{{ $portfolio->username }}
                        </a>
                    </div>
                    <small class="text-xs text-slate-400 mt-2 sm:mt-0">
                        <i class="bi bi-clock-history mr-1"></i>Diposting {{ \Carbon\Carbon::parse($portfolio->created_at)->diffForHumans() }}
                    </small>
                </div>

                {{-- Card Body --}}
                <div class="p-6 md:p-8">
                    <h2 class="text-3xl font-extrabold text-slate-100 mb-5 leading-tight">{{ $portfolio->title }}</h2>
                    
                    <div class="flex flex-wrap gap-3 mb-6">
                        <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-semibold bg-sky-500/20 text-sky-300 ring-1 ring-inset ring-sky-500/40">
                            <i class="bi bi-calendar3 mr-2 text-lg"></i> Event: {{ date('d M Y', strtotime($portfolio->event_date)) }}
                        </span>
                        <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 ring-1 ring-inset ring-emerald-500/40">
                            <i class="bi bi-geo-alt-fill mr-2 text-lg"></i> Lokasi: {{ $portfolio->location }}
                        </span>
                    </div>
                    
                    {{-- Jika ada gambar portfolio --}}
                    {{-- @if($portfolio->image_path)
                    <div class="my-6 rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="Portfolio Image for {{ $portfolio->title }}" class="w-full h-auto object-cover max-h-[500px]">
                    </div>
                    @endif --}}

                    <div class="prose prose-lg prose-invert max-w-none text-slate-200/90 leading-relaxed">
                        {!! nl2br(e($portfolio->description)) !!}
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="px-6 py-5 border-t border-slate-700/50 bg-slate-800/40 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center space-x-3">
                        @auth
                            <form action="{{ route('volunfeeds.toggle-like', $portfolio->id) }}" method="POST" class="inline-flex">
                                @csrf
                                <button type="submit" class="flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 shadow-md hover:shadow-lg
                                    {{ in_array($portfolio->id, $likedPortfolios ?? []) ? 'bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white' : 'bg-slate-600 hover:bg-slate-500 text-slate-200 hover:text-white' }}">
                                    <i class="bi {{ in_array($portfolio->id, $likedPortfolios ?? []) ? 'bi-heart-fill' : 'bi-heart' }} mr-2 text-base"></i>
                                    <span>{{ in_array($portfolio->id, $likedPortfolios ?? []) ? 'Unlike' : 'Like' }}</span>
                                </button>
                            </form>
                        @endauth
                        <div class="flex items-center text-sm text-slate-400">
                            <i class="bi bi-heart-fill text-red-400/80 mr-1.5 text-base"></i> {{ $portfolio->likes_count ?? 0 }} Suka
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('volunfeeds.index') }}" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 font-semibold text-sm shadow-md hover:shadow-lg">
                            <i class="bi bi-arrow-left-circle-fill mr-2"></i> Kembali ke VoluFeed
                        </a>
                    </div>
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