<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard</title>
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
                <a href="{{ route('activities.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('activities.index') || request()->routeIs('impacttracker.user.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-calendar-event mr-3 text-blue-400 group-hover:scale-110 transition-transform"></i>
                    <span>Activities</span>
                </a>
                <a href="{{ route('feedback.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('feedback.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-chat-square-text mr-3 text-green-400 group-hover:scale-110 transition-transform"></i>
                    <span>Feedback</span>
                </a>
                <a href="{{ route('volunfeeds.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('volunfeeds.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-rss mr-3 text-yellow-400 group-hover:scale-110 transition-transform"></i>
                    <span>VoluFeed & Portfolio</span>
                </a>
                <a href="{{ route('user.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('user.notifications.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    <i class="bi bi-bell mr-3 text-red-400 group-hover:scale-110 transition-transform"></i>
                    <span>Notifications</span>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">{{ $unreadNotificationsCount }}</span>
                    @else
                         {{-- Contoh statis jika tidak ada var $unreadNotificationsCount --}}
                        <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">3</span>
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
                {{-- TOMBOL BARU UNTUK IMPACT TRACKER --}}
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
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-32 h-32 bg-blue-500 rounded-full opacity-20 animate-float"></div>
                <div class="absolute bottom-20 right-20 w-24 h-24 bg-purple-500 rounded-full opacity-20 animate-bounce-slow"></div>
                <div class="absolute top-1/2 left-10 w-16 h-16 bg-green-500 rounded-full opacity-20 animate-pulse-slow"></div>
                 <div class="absolute bottom-1/3 right-1/4 w-20 h-20 bg-yellow-500 rounded-full opacity-10 animate-float" style="animation-duration: 5s;"></div>
                <div class="absolute top-1/4 left-1/3 w-28 h-28 bg-pink-500 rounded-full opacity-10 animate-pulse-slow" style="animation-duration: 7s;"></div>
            </div>

            <div class="text-center z-10 px-6 animate-fade-in">
                <div class="mb-8">
                    <div class="w-28 h-28 bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500 rounded-full mx-auto mb-8 flex items-center justify-center shadow-2xl animate-pulse-slow ring-4 ring-purple-500/30">
                        {{-- Jika user punya avatar: <img src="{{ Auth::user()->avatar_url }}" alt="User Avatar" class="w-full h-full rounded-full object-cover"> --}}
                        {{-- Jika tidak, pakai ikon: --}}
                        <i class="bi bi-person-fill-check text-5xl text-white"></i>
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-4 bg-gradient-to-r from-sky-300 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                        Welcome, {{ $userName ?? Auth::user()->name }}!
                    </h1>
                    <p class="text-xl lg:text-2xl text-slate-300 mb-10 max-w-3xl mx-auto">
                        Ready to make a difference? Explore opportunities, connect with your community, and track your impact through our platform.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center">
                    <a href="#events-section" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-xl text-lg font-semibold flex items-center justify-center space-x-2">
                        <i class="bi bi-search"></i>
                        <span>Explore Events</span>
                    </a>
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-8 py-4 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-xl hover:from-red-600 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 shadow-xl text-lg font-semibold flex items-center justify-center space-x-2">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </section>

        <section id="events-section" class="py-20 px-6 bg-slate-900/30">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16 animate-fade-in">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-4">Featured Events</h2>
                    <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                        Discover amazing opportunities to make a positive impact in your community.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @forelse ($events as $event)
                        @php
                            $category_slug = Str::slug($event->category ?? 'general');
                            $colors = [
                                'environment' => ['icon' => 'bi-tree-fill', 'text' => 'text-emerald-400', 'bg' => 'bg-emerald-500', 'border_hover' => 'hover:border-emerald-400/50', 'shadow_hover' => 'hover:shadow-emerald-500/20', 'gradient_from' => 'from-emerald-500', 'gradient_to' => 'to-emerald-600', 'hover_gradient_from' => 'hover:from-emerald-600', 'hover_gradient_to' => 'hover:to-emerald-700'],
                                'education' => ['icon' => 'bi-book-half', 'text' => 'text-sky-400', 'bg' => 'bg-sky-500', 'border_hover' => 'hover:border-sky-400/50', 'shadow_hover' => 'hover:shadow-sky-500/20', 'gradient_from' => 'from-sky-500', 'gradient_to' => 'to-sky-600', 'hover_gradient_from' => 'hover:from-sky-600', 'hover_gradient_to' => 'hover:to-sky-700'],
                                'community' => ['icon' => 'bi-people-fill', 'text' => 'text-purple-400', 'bg' => 'bg-purple-500', 'border_hover' => 'hover:border-purple-400/50', 'shadow_hover' => 'hover:shadow-purple-500/20', 'gradient_from' => 'from-purple-500', 'gradient_to' => 'to-purple-600', 'hover_gradient_from' => 'hover:from-purple-600', 'hover_gradient_to' => 'hover:to-purple-700'],
                                'health'    => ['icon' => 'bi-heart-pulse-fill', 'text' => 'text-red-400', 'bg' => 'bg-red-500', 'border_hover' => 'hover:border-red-400/50', 'shadow_hover' => 'hover:shadow-red-500/20', 'gradient_from' => 'from-red-500', 'gradient_to' => 'to-red-600', 'hover_gradient_from' => 'hover:from-red-600', 'hover_gradient_to' => 'hover:to-red-700'],
                                'general'   => ['icon' => 'bi-calendar-event-fill', 'text' => 'text-slate-400', 'bg' => 'bg-slate-500', 'border_hover' => 'hover:border-slate-400/50', 'shadow_hover' => 'hover:shadow-slate-500/20', 'gradient_from' => 'from-slate-500', 'gradient_to' => 'to-slate-600', 'hover_gradient_from' => 'hover:from-slate-600', 'hover_gradient_to' => 'hover:to-slate-700'],
                            ];
                            $colorConfig = $colors[$category_slug] ?? $colors['general'];
                        @endphp

                        <div class="event-card group bg-white/5 backdrop-blur-lg rounded-2xl overflow-hidden hover:bg-white/10 transition-all duration-300 border border-slate-700/50 {{ $colorConfig['border_hover'] }} hover:shadow-2xl {{ $colorConfig['shadow_hover'] }}">
                            {{-- Jika ada gambar event:
                            <img src="{{ $event->image_url ?? 'https://via.placeholder.com/400x250/1e293b/94a3b8?text=Event+Image' }}" alt="Event: {{ $event->title }}" class="w-full h-48 object-cover group-hover:opacity-90 transition-opacity">
                            --}}
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-2">
                                        <i class="bi {{ $colorConfig['icon'] }} {{ $colorConfig['text'] }} text-lg"></i>
                                        <span class="{{ $colorConfig['bg'] }} bg-opacity-80 text-white px-3 py-1 rounded-full text-xs font-semibold">{{ $event->category ?? 'General' }}</span>
                                    </div>
                                    <button class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors group/fav" title="Add to favorites">
                                        <i class="bi bi-heart text-slate-300 group-hover/fav:text-red-400 transition-colors"></i>
                                        {{-- Icon jika sudah difavoritkan: <i class="bi bi-heart-fill text-red-500"></i> --}}
                                    </button>
                                </div>
                                <h3 class="text-xl font-semibold text-white mb-2 group-hover:{{ $colorConfig['text'] }} transition-colors line-clamp-2">{{ $event->title }}</h3>
                                <p class="text-slate-300/90 text-sm mb-4 line-clamp-3 flex-grow">{{ $event->description }}</p>
                                <div class="text-xs text-slate-400 space-y-1.5 mb-5">
                                    <div class="flex items-center">
                                        <i class="bi bi-calendar3 mr-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($event->date ?? $event->start_date)->isoFormat('dddd, D MMMM YYYY') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="bi bi-geo-alt-fill mr-2"></i>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>
                                <a href="{{-- route('events.show', $event->event_id) --}}" class="mt-auto block w-full text-center px-6 py-3 bg-gradient-to-r {{ $colorConfig['gradient_from'] }} {{ $colorConfig['gradient_to'] }} text-white rounded-xl {{ $colorConfig['hover_gradient_from'] }} {{ $colorConfig['hover_gradient_to'] }} transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold">
                                    View Details & Join
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="md:col-span-2 lg:col-span-3 text-center py-12 text-slate-400">
                             <i class="bi bi-calendar-x text-5xl mb-4 text-slate-500"></i>
                            <p class="text-xl">No featured events available at the moment.</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-16 animate-fade-in">
                    <a href="{{ route('events.index') }}" class="px-12 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-xl text-lg font-semibold flex items-center justify-center space-x-2 mx-auto max-w-xs sm:max-w-sm">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <span>See All Events</span>
                    </a>
                </div>
            </div>
        </section>
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
        
        // Navigation item animations
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                 if (!item.classList.contains('bg-slate-700')) { // Jangan animasi item aktif
                    item.style.transform = 'translateX(5px)';
                 }
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateX(0)';
            });
        });

        // Action button animations
        document.querySelectorAll('.action-btn').forEach(btn => {
            const originalBoxShadow = btn.style.boxShadow || '0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05)'; // default shadow-lg
            btn.addEventListener('mouseenter', () => {
                btn.style.boxShadow = '0 20px 25px -5px rgba(0,0,0,0.2), 0 10px 10px -5px rgba(0,0,0,0.1)'; // shadow-2xl
            });
            btn.addEventListener('mouseleave', () => {
                 btn.style.boxShadow = originalBoxShadow;
            });
        });

        // Event card hover effects (JavaScript based, bisa diganti dengan Tailwind group-hover jika lebih sederhana)
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                // card.style.transform = 'translateY(-8px) scale(1.02)'; // Efek ini sudah ada di CSS via hover:
            });
            card.addEventListener('mouseleave', () => {
                // card.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations on scroll (opsional, jika ingin elemen muncul saat di-scroll)
        // const observerOptions = {
        //     threshold: 0.1,
        //     rootMargin: '0px 0px -50px 0px' // elemen akan dianggap intersecting sedikit sebelum benar-benar masuk viewport
        // };

        // const observer = new IntersectionObserver((entries, obs) => {
        //     entries.forEach(entry => {
        //         if (entry.isIntersecting) {
        //             entry.target.classList.remove('opacity-0', 'translate-y-10'); // Hapus class untuk animasi
        //             entry.target.classList.add('animate-fade-in'); // Tambah class animasi Tailwind
        //             obs.unobserve(entry.target); // Hentikan observasi setelah animasi berjalan
        //         }
        //     });
        // }, observerOptions);

        // // Tambahkan class awal untuk animasi pada elemen yang ingin dianimasi
        // document.querySelectorAll('.animate-on-scroll').forEach(el => {
        //    el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700', 'ease-out');
        //    observer.observe(el);
        // });

        // Hapus referensi ke logout-btn karena sudah dihandle onclick
        // document.getElementById('logout-btn').addEventListener('click', ...);

        // Add loading states to buttons (jika tidak ada onclick yang menghandle navigasi/submit)
        document.querySelectorAll('button[type="submit"], a.action-btn, .event-card button, section#events-section .text-center > button').forEach(btn => {
            // Hanya tambahkan event listener jika tidak ada onclick yang sudah ada
            // yang mungkin menghandle navigasi atau form submission dengan cara lain
            if (!btn.onclick && !btn.getAttribute('onclick')) {
                btn.addEventListener('click', function(event) {
                    // Jangan disable tombol yang merupakan bagian dari form submission langsung
                    // Biarkan form yang menghandle ini jika ada @csrf dan method POST
                    if (this.closest('form') && this.type === 'submit') {
                        // Biarkan default browser behavior
                    } else if (this.id !== 'mobile-menu-btn') {
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="bi bi-arrow-clockwise animate-spin mr-2"></i>Loading...';
                        this.disabled = true;

                        // Simulate action and re-enable
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }, 1500); // Durasi loading state
                    }
                });
            }
        });
    </script>
</body>
</html>