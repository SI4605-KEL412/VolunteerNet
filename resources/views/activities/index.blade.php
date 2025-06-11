<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Activities</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.5s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar (optional, for WebKit browsers) */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1e293b; /* slate-800 */
        }
        ::-webkit-scrollbar-thumb {
            background: #3b82f6; /* blue-500 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb; /* blue-600 */
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
                {{-- Gunakan 'request()->routeIs('activities.index')' untuk menentukan active state secara dinamis --}}
                <a href="{{ route('activities.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('activities.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-calendar-event mr-3 text-blue-400 group-hover:scale-110 transition-transform"></i>
                    <span>Activities</span>
                </a>
                <a href="{{ route('feedback.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('feedback.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-chat-square-text mr-3 text-green-400 group-hover:scale-110 transition-transform"></i>
                    <span>Feedback</span>
                </a>
                <a href="{{ route('volunfeeds.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('volunfeeds.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-rss mr-3 text-yellow-400 group-hover:scale-110 transition-transform"></i>
                    <span>VoluFeed</span>
                </a>
                <a href="{{ route('user.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('user.notifications.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-bell mr-3 text-red-400 group-hover:scale-110 transition-transform"></i>
                    <span>Notifications</span>
                    <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">3</span> {{-- Example notification count --}}
                </a>
                <a href="{{ route('forums.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('forums.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-people mr-3 text-purple-400 group-hover:scale-110 transition-transform"></i>
                    <span>Social Network</span>
                </a>
                {{-- Pastikan Auth::id() tersedia di view --}}
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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0">Your Activity History</h1>
                {{-- Asumsi 'user.dashboard' adalah nama route untuk halaman utama dashboard --}}
                <a href="{{ route('user.dashboard') }}" class="px-6 py-2 border border-slate-600 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-white transition-colors duration-200 inline-flex items-center space-x-2 transform hover:scale-105">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>

            @if (session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-6 shadow-md animate-fade-in" role="alert">
                {{ session('success') }}
            </div>
            @endif

            {{-- Updated logic for displaying activities --}}
            @if (isset($activities) && $activities->isNotEmpty())
                {{-- If $activities is set and NOT empty, loop through them --}}
                <div class="space-y-4 animate-fade-in">
                    @foreach ($activities as $activity)
                    <div class="activity-card bg-white/10 backdrop-blur-sm rounded-xl overflow-hidden border border-slate-700 hover:border-blue-500/70 transition-all duration-300 shadow-lg hover:shadow-blue-500/20">
                        <div class="p-5 flex items-start space-x-4">
                            <div>
                                <i class="bi {{ $activity->icon ?? 'bi-clock-history' }} text-{{ $activity->color ?? 'blue' }}-400 text-3xl mt-1"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">{!! $activity->description !!}</h3>
                                <p class="text-slate-400 text-sm">{{ \Carbon\Carbon::parse($activity->created_at)->format('d M Y - H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback to static content if $activities is NOT set, or IS empty --}}
                <div class="space-y-4 animate-fade-in">

                    
                    <div class="activity-card bg-white/10 backdrop-blur-sm rounded-xl overflow-hidden border border-slate-700 hover:border-blue-500/70 transition-all duration-300 shadow-lg hover:shadow-blue-500/20">
                        <div class="p-5 flex items-start space-x-4">
                            <div><i class="bi bi-box-arrow-in-right text-blue-400 text-3xl mt-1"></i></div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Login ke sistem</h3>
                                <p class="text-slate-400 text-sm">10 May 2025 - 12:55</p>
                            </div>
                        </div>
                    </div>
                    <div class="activity-card bg-white/10 backdrop-blur-sm rounded-xl overflow-hidden border border-slate-700 hover:border-green-500/70 transition-all duration-300 shadow-lg hover:shadow-green-500/20">
                        <div class="p-5 flex items-start space-x-4">
                            <div><i class="bi bi-eye text-green-400 text-3xl mt-1"></i></div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Melihat detail event <strong>"Bakti Sosial"</strong></h3>
                                <p class="text-slate-400 text-sm">11 May 2025 - 12:55</p>
                            </div>
                        </div>
                    </div>
                    <div class="activity-card bg-white/10 backdrop-blur-sm rounded-xl overflow-hidden border border-slate-700 hover:border-purple-500/70 transition-all duration-300 shadow-lg hover:shadow-purple-500/20">
                        <div class="p-5 flex items-start space-x-4">
                            <div><i class="bi bi-person-check text-purple-400 text-3xl mt-1"></i></div>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">Mendaftar pada event <strong>"Green Earth Project"</strong></h3>
                                <p class="text-slate-400 text-sm">12 May 2025 - 09:55</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <script>
        // Mobile menu functionality
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

        // Navigation item animations (optional subtle effect)
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                if (!item.classList.contains('bg-slate-700')) { // Don't apply to active item
                    item.style.transform = 'translateX(4px)';
                }
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateX(0)';
            });
        });
        
        // Action button animations (similar to original dashboard)
        document.querySelectorAll('.action-btn').forEach(btn => {
            const originalBoxShadow = btn.style.boxShadow || '0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05)'; // Default Tailwind shadow-lg
            btn.addEventListener('mouseenter', () => {
                 btn.style.boxShadow = '0 20px 25px -5px rgba(0,0,0,0.2), 0 10px 10px -5px rgba(0,0,0,0.1)'; // Enhanced shadow
            });
            btn.addEventListener('mouseleave', () => {
                 btn.style.boxShadow = originalBoxShadow;
            });
        });

    </script>
</body>
</html>