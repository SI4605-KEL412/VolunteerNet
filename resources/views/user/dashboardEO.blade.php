<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EO Dashboard</title>
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
</head>

<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 min-h-screen">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-2 rounded-lg shadow-lg">
        <i class="bi bi-list text-xl"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-slate-800 to-slate-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 shadow-2xl">
        <!-- Sidebar Header -->
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-briefcase text-white"></i>
                </div>
                <h2 class="text-xl font-bold text-white">EO Dashboard</h2>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <!-- Regular Navigation Items -->
            <div class="space-y-1">
                <a href="{{ route('events.create') }}" class="nav-item group flex items-center px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="bi bi-plus-circle mr-3 text-green-400 group-hover:scale-110 transition-transform"></i>
                    <span>Create Event</span>
                </a>
                <a href="{{ route('impacttracker.eo.index') }}" class="nav-item group flex items-center px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="bi bi-graph-up mr-3 text-blue-400 group-hover:scale-110 transition-transform"></i>
                    <span>Impact Tracker</span>
                </a>
            </div>

            <!-- Special Action Buttons -->
            <div class="pt-4 space-y-3 border-t border-slate-700">
                <a href="{{ route('user.dashboard') }}" class="action-btn block w-full px-4 py-3 bg-gradient-to-r from-slate-600 to-slate-700 text-white rounded-lg hover:from-slate-700 hover:to-slate-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-arrow-left mr-2"></i>
                    <span>Back to User Dashboard</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen">
        <!-- Hero Section -->
        <section class="relative h-screen flex items-center justify-center overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-32 h-32 bg-orange-500 rounded-full opacity-10 animate-float"></div>
                <div class="absolute bottom-20 right-20 w-24 h-24 bg-red-500 rounded-full opacity-10 animate-bounce-slow"></div>
                <div class="absolute top-1/2 left-10 w-16 h-16 bg-yellow-500 rounded-full opacity-10 animate-pulse-slow"></div>
            </div>

            <div class="text-center z-10 px-6 animate-fade-in">
                <div class="mb-8">
                    <div class="w-24 h-24 bg-gradient-to-r from-orange-500 to-red-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-2xl animate-pulse-slow">
                        <i class="bi bi-briefcase text-3xl text-white"></i>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 bg-gradient-to-r from-orange-400 via-red-400 to-purple-400 bg-clip-text text-transparent">
                        Welcome, {{ $userName }}!
                    </h1>
                    <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
                        Your Event Organizer dashboard. Create, manage, and track the impact of your events.
                    </p>
                </div>

                <!-- Quick Stats -->

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="window.location.href='{{ route('events.create') }}'" class="px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:from-orange-600 hover:to-orange-700 transition-all duration-200 transform hover:scale-105 shadow-xl">
                        <i class="bi bi-plus-circle mr-2"></i>
                        Create New Event
                    </button>
                    <button onclick="window.location.href='#events-section'" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-xl">
                        <i class="bi bi-eye mr-2"></i>
                        View All Events
                    </button>
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-8 py-4 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 transform hover:scale-105 shadow-xl">
                        <i class="bi bi-box-arrow-right mr-2"></i>
                        Logout
                    </button>
                </div>

                <!-- Logout Form (Hidden) -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </section>

        <!-- Top Events Section -->
        <section id="events-section" class="py-20 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4">Your Top Events</h2>
                    <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                        Monitor and manage your most successful events
                    </p>
                </div>

                <!-- Events Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach ($events as $event)
                        @php
                            $color = match($loop->index % 3) {
                                0 => 'orange',
                                1 => 'emerald',
                                2 => 'purple'
                            };

                            $icon = match($loop->index % 3) {
                                0 => 'bi-star-fill',
                                1 => 'bi-trophy',
                                2 => 'bi-award'
                            };
                        @endphp

                        <div class="event-card group bg-white/10 backdrop-blur-sm rounded-2xl overflow-hidden hover:bg-white/20 transition-all duration-300 border border-white/20 hover:border-{{ $color }}-400/50 hover:shadow-2xl hover:shadow-{{ $color }}-500/20">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-2">
                                        <i class="bi {{ $icon }} text-{{ $color }}-400 text-lg"></i>
                                        <span class="bg-{{ $color }}-500 text-white px-3 py-1 rounded-full text-sm">Top Event</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                            <i class="bi bi-pencil text-white"></i>
                                        </button>
                                        <button class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                            <i class="bi bi-three-dots text-white"></i>
                                        </button>
                                    </div>
                                </div>
                                <h3 class="text-xl font-semibold text-white mb-2 group-hover:text-{{ $color }}-400 transition-colors">{{ $event->title }}</h3>
                                <p class="text-slate-300 mb-4 line-clamp-3">{{ Str::limit($event->description, 100) }}</p>
                                
                                <!-- Event Stats -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="bg-white/5 rounded-lg p-2 text-center">
                                        <div class="text-{{ $color }}-400 font-bold">{{ rand(20, 80) }}</div>
                                        <div class="text-xs text-slate-400">Participants</div>
                                    </div>
                                    <div class="bg-white/5 rounded-lg p-2 text-center">
                                        <div class="text-{{ $color }}-400 font-bold">{{ rand(4, 5) }}.{{ rand(0, 9) }}</div>
                                        <div class="text-xs text-slate-400">Rating</div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between mb-4 text-slate-400 text-sm">
                                    <div class="flex items-center">
                                        <i class="bi bi-calendar mr-1"></i>
                                        <span>{{ \Carbon\Carbon::parse($event->date ?? now())->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="bi bi-geo-alt mr-1"></i>
                                        <span>{{ $event->location ?? 'Online' }}</span>
                                    </div>
                                </div>
                                <button class="w-full bg-gradient-to-r from-{{ $color }}-500 to-{{ $color }}-600 text-white py-3 rounded-lg hover:from-{{ $color }}-600 hover:to-{{ $color }}-700 transition-all duration-200 transform hover:scale-105">
                                    <i class="bi bi-eye mr-2"></i>
                                    View Details
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Events Button -->
                <div class="text-center">
                    <button onclick="window.location.href='#'" class="px-12 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-xl">
                        <i class="bi bi-grid mr-2"></i>
                        See All Events
                    </button>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Navigation item animations
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.style.transform = 'translateX(8px)';
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateX(0)';
            });
        });

        // Action button animations
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                btn.style.boxShadow = '0 20px 40px rgba(0,0,0,0.3)';
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
            });
        });

        // Event card hover effects
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe all event cards
        document.querySelectorAll('.event-card').forEach(card => {
            observer.observe(card);
        });

        // Add loading states to buttons
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.id !== 'mobile-menu-btn' && !this.onclick && !this.getAttribute('onclick')) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-arrow-clockwise animate-spin mr-2"></i>Loading...';
                    this.disabled = true;

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 2000);
                }
            });
        });
    </script>
</body>

</html>