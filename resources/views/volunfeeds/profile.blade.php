<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Pengguna - {{ $user->name }}</title>
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
                require('@tailwindcss/typography'), // Untuk kelas .prose jika deskripsi portfolio menggunakan HTML
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
        $isOwnProfile = (Auth::check() && Auth::id() == $user->id);
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
                <a href="{{ route('volunfeeds.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ (request()->routeIs('volunfeeds.*') || (!$isOwnProfile && request()->routeIs('user.profile'))) ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
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
                <a href="{{ route('users.show', Auth::check() ? Auth::id() : 1) }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ ($isOwnProfile && request()->routeIs('user.profile')) || request()->routeIs('users.show') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
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
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:grid lg:grid-cols-12 lg:gap-10">
                
                {{-- Kolom Kiri: Profile Card --}}
                <aside class="lg:col-span-4 xl:col-span-3 mb-8 lg:mb-0 animate-fade-in">
                    <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 p-6 sticky top-10">
                        <div class="text-center">
                            <div class="w-28 h-28 mx-auto rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-5xl font-semibold mb-5 shadow-xl ring-4 ring-slate-700/50">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <h1 class="text-2xl font-bold text-slate-50 mb-1">{{ $user->name }}</h1>
                            <p class="text-sm text-slate-400 mb-5">{{ $user->email }}</p>
                        </div>
                        
                        <hr class="border-t border-slate-700 my-5">
                        
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Bergabung Sejak</p>
                                <p class="text-slate-200 font-medium">{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('LL') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Total Portfolio</p>
                                <p class="text-slate-200 font-medium">{{ $portfolios->total() }} Kontribusi</p> {{-- Asumsi $portfolios adalah objek paginator --}}
                            </div>
                        </div>

                        <a href="{{ route('volunfeeds.index') }}" class="mt-8 block w-full text-center px-6 py-3 bg-slate-700/80 hover:bg-slate-600/90 text-slate-200 rounded-xl shadow-md transition-colors font-medium text-sm flex items-center justify-center transform hover:scale-105">
                            <i class="bi bi-arrow-left-circle-fill mr-2.5"></i> Kembali ke VoluFeed
                        </a>
                    </div>
                </aside>

                {{-- Kolom Kanan: VolunFeeds Section --}}
                <main class="lg:col-span-8 xl:col-span-9 animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                        <h2 class="text-3xl font-bold text-white mb-4 sm:mb-0">
                            <i class="bi bi-collection-fill text-yellow-400"></i> Kontribusi {{ $isOwnProfile ? 'Anda' : $user->name }}
                        </h2>
                        @if($isOwnProfile)
                            {{-- Asumsi route('portfolio.create') untuk membuat portfolio baru --}}
                            <a href="{{ route('portfolio.create') }}" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105 shadow-xl inline-flex items-center space-x-2">
                                <i class="bi bi-plus-circle-fill text-xl"></i>
                                <span class="font-semibold">Tambah Portfolio</span>
                            </a>
                        @endif
                    </div>

                    @if (session('success'))
                        <div class="bg-green-800/40 border border-green-600/50 text-green-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3" role="alert">
                            <i class="bi bi-check-circle-fill text-2xl"></i>
                            <span class="text-base">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-800/40 border border-red-600/50 text-red-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3" role="alert">
                            <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                            <span class="text-base">{{ session('error') }}</span>
                        </div>
                    @endif

                    @forelse ($portfolios as $portfolio) {{-- Mengganti $feeds menjadi $portfolios --}}
                        <div class="relative bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 flex flex-col overflow-hidden hover:border-blue-500/70 transition-all duration-300 ease-in-out transform hover:-translate-y-1 mb-8">
                            @if($portfolio->likes_count > 5)
                                <span class="absolute top-4 right-4 bg-gradient-to-r from-red-500 to-orange-500 text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg flex items-center z-10">
                                    <i class="bi bi-fire mr-1.5"></i> Popular
                                </span>
                            @endif
                            
                            {{-- Card Header (Jika perlu menampilkan username lagi, bisa di-enable. Tapi di halaman profil sendiri mungkin redundan) --}}
                            {{-- <div class="px-6 py-5 border-b border-slate-700/50 flex justify-between items-center">
                                <div>
                                    <span class="font-semibold text-blue-400 text-sm">
                                        <i class="bi bi-person-circle mr-1.5"></i>{{ $portfolio->username }}
                                    </span>
                                </div>
                                <small class="text-xs text-slate-400">
                                    {{ \Carbon\Carbon::parse($portfolio->created_at)->diffForHumans() }}
                                </small>
                            </div> --}}

                            <div class="p-6 flex-grow">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="mb-1">
                                        <a href="{{ route('volunfeeds.show', $portfolio->id) }}" class="text-xl sm:text-2xl font-bold text-slate-100 hover:text-yellow-400 transition-colors line-clamp-2">
                                            {{ $portfolio->title }}
                                        </a>
                                    </h3>
                                     <small class="text-xs text-slate-400 whitespace-nowrap pt-1.5 pl-3">
                                        {{ \Carbon\Carbon::parse($portfolio->created_at)->diffForHumans() }}
                                    </small>
                                </div>
                                <p class="text-sm text-slate-300 leading-relaxed line-clamp-3 mb-4">{{ Str::limit($portfolio->description, 200) }}</p>
                                <div class="text-xs text-slate-400 space-y-1.5">
                                    <div class="flex items-center">
                                        <i class="bi bi-calendar3 mr-2 text-sky-400"></i> Event: {{ date('d M Y', strtotime($portfolio->event_date)) }}
                                    </div>
                                    <div class="flex items-center">
                                        <i class="bi bi-geo-alt-fill mr-2 text-emerald-400"></i> Lokasi: {{ $portfolio->location }}
                                    </div>
                                </div>
                            </div>

                            <div class="px-6 py-4 border-t border-slate-700/50 flex justify-between items-center bg-slate-800/30">
                                <div class="flex items-center space-x-3">
                                    @auth
                                    <form action="{{ route('volunfeeds.toggle-like', $portfolio->id) }}" method="POST" class="inline-flex">
                                        @csrf
                                        <button type="submit" class="flex items-center px-3 py-1.5 rounded-lg text-xs font-medium transition-all duration-200 shadow-sm hover:shadow-md
                                            {{ in_array($portfolio->id, $likedPortfolios ?? []) ? 'bg-red-500/80 hover:bg-red-600 text-white' : 'bg-slate-600/70 hover:bg-slate-500/70 text-slate-200 hover:text-white' }}">
                                            <i class="bi {{ in_array($portfolio->id, $likedPortfolios ?? []) ? 'bi-heart-fill' : 'bi-heart' }} mr-1.5"></i> 
                                            <span>{{ in_array($portfolio->id, $likedPortfolios ?? []) ? 'Unlike' : 'Like' }}</span>
                                        </button>
                                    </form>
                                    @endauth
                                    <span class="flex items-center text-xs text-slate-400">
                                        <i class="bi bi-heart-fill text-red-500/70 mr-1"></i> {{ $portfolio->likes_count }} Suka
                                    </span>
                                </div>
                                <a href="{{ route('volunfeeds.show', $portfolio->id) }}" class="inline-flex items-center bg-blue-600/80 hover:bg-blue-700/80 text-white px-4 py-1.5 rounded-lg text-xs font-medium transition-colors shadow-sm hover:shadow-md">
                                    <i class="bi bi-eye-fill mr-1.5"></i> Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="md:col-span-2 lg:col-span-3 text-center py-16 bg-white/5 backdrop-blur-sm rounded-xl border border-slate-700 shadow-xl">
                            <i class="bi bi-journal-richtext text-6xl text-slate-500 mb-6"></i>
                            <p class="text-2xl font-semibold text-white mb-2">Belum Ada Kontribusi</p>
                            @if($isOwnProfile)
                                <p class="text-slate-400 max-w-md mx-auto mb-6">Mulai bagikan pengalaman dan kegiatan inspiratif Anda sekarang!</p>
                                <a href="{{ route('portfolio.create') }}" class="px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105 shadow-xl inline-flex items-center space-x-2 text-base font-semibold">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    <span>Buat Portfolio Pertama</span>
                                </a>
                            @else
                                <p class="text-slate-400 max-w-md mx-auto">Pengguna ini belum membagikan portfolio apapun.</p>
                            @endif
                        </div>
                    @endforelse
                    
                    {{-- Pagination links --}}
                    @if ($portfolios->hasPages())
                        <div class="mt-10">
                            {{-- Ganti 'vendor.pagination.tailwind-dark' dengan path view pagination kustom Anda jika ada, atau gunakan default --}}
                            {{ $portfolios->links() }} 
                        </div>
                    @endif
                </main>
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