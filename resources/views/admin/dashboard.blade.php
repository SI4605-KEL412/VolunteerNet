<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
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
                <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-shield-check text-white"></i>
                </div>
                <h2 class="text-xl font-bold text-white">Admin Dashboard</h2>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <!-- Regular Navigation Items -->
            <div class="space-y-1">
                <a href="{{ route('manageusers.index') }}" class="nav-item group flex items-center px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="bi bi-people mr-3 text-blue-400 group-hover:scale-110 transition-transform"></i>
                    <span>Manage Users</span>
                </a>
                <a href="{{ route('events.index') }}" class="nav-item group flex items-center px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="bi bi-calendar-event mr-3 text-green-400 group-hover:scale-110 transition-transform"></i>
                    <span>Manage Events</span>
                </a>
                <a href="{{ route('admin.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="bi bi-bell mr-3 text-yellow-400 group-hover:scale-110 transition-transform"></i>
                    <span>Manage Notifications</span>
                    <span class="ml-auto bg-yellow-500 text-xs px-2 py-1 rounded-full">12</span>
                </a>
                <a href="{{ route('eo.recruitment.index') }}" class="nav-item group flex items-center px-4 py-3 text-slate-300 hover:text-white hover:bg-slate-700 rounded-lg transition-all duration-200">
                    <i class="bi bi-person-plus mr-3 text-purple-400 group-hover:scale-110 transition-transform"></i>
                    <span>EO Recruitments</span>
                </a>
            </div>

            <!-- Special Action Buttons -->
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
                <div class="absolute top-20 left-20 w-32 h-32 bg-red-500 rounded-full opacity-10 animate-float"></div>
                <div class="absolute bottom-20 right-20 w-24 h-24 bg-pink-500 rounded-full opacity-10 animate-bounce-slow"></div>
                <div class="absolute top-1/2 left-10 w-16 h-16 bg-purple-500 rounded-full opacity-10 animate-pulse-slow"></div>
            </div>

            <div class="text-center z-10 px-6 animate-fade-in">
                <div class="mb-8">
                    <div class="w-24 h-24 bg-gradient-to-r from-red-500 to-pink-600 rounded-full mx-auto mb-6 flex items-center justify-center shadow-2xl animate-pulse-slow">
                        <i class="bi bi-shield-check text-3xl text-white"></i>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 bg-gradient-to-r from-red-400 via-pink-400 to-purple-400 bg-clip-text text-transparent">
                        Welcome, Admin!
                    </h1>
                    <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
                        Manage your platform with comprehensive admin tools. Monitor users, events, and system performance.
                    </p>
                </div>

                <!-- Quick Stats -->

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="window.location.href='{{ route('manageusers.index') }}'" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-xl">
                        <i class="bi bi-people mr-2"></i>
                        Manage Users
                    </button>
                    <button onclick="window.location.href='{{ route('events.index') }}'" class="px-8 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105 shadow-xl">
                        <i class="bi bi-calendar-event mr-2"></i>
                        Manage Events
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

        <!-- Management Overview Section -->
        <section id="management-section" class="py-20 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4">Management Overview</h2>
                    <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                        Quick access to your most important administrative tasks
                    </p>
                </div>

                <!-- Management Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <!-- Users Management Card -->
                    <div class="management-card group bg-white/10 backdrop-blur-sm rounded-2xl overflow-hidden hover:bg-white/20 transition-all duration-300 border border-white/20 hover:border-blue-400/50 hover:shadow-2xl hover:shadow-blue-500/20">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <i class="bi bi-people text-blue-400 text-2xl"></i>
                                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">Users</span>
                                </div>
                                <div class="text-2xl font-bold text-blue-400">1,234</div>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2 group-hover:text-blue-400 transition-colors">User Management</h3>
                            <p class="text-slate-300 mb-4">Monitor and manage all registered users, their activities, and permissions.</p>
                            
                            <div class="grid grid-cols-2 gap-2 mb-4 text-sm">
                                <div class="bg-white/5 rounded-lg p-2">
                                    <div class="text-green-400 font-bold">+45</div>
                                    <div class="text-slate-400">New Today</div>
                                </div>
                                <div class="bg-white/5 rounded-lg p-2">
                                    <div class="text-blue-400 font-bold">892</div>
                                    <div class="text-slate-400">Active</div>
                                </div>
                            </div>

                            <button onclick="window.location.href='{{ route('manageusers.index') }}'" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                <i class="bi bi-arrow-right mr-2"></i>
                                Manage Users
                            </button>
                        </div>
                    </div>

                    <!-- Events Management Card -->
                    <div class="management-card group bg-white/10 backdrop-blur-sm rounded-2xl overflow-hidden hover:bg-white/20 transition-all duration-300 border border-white/20 hover:border-green-400/50 hover:shadow-2xl hover:shadow-green-500/20">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <i class="bi bi-calendar-event text-green-400 text-2xl"></i>
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">Events</span>
                                </div>
                                <div class="text-2xl font-bold text-green-400">567</div>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2 group-hover:text-green-400 transition-colors">Event Management</h3>
                            <p class="text-slate-300 mb-4">Oversee all events, approve new submissions, and monitor event performance.</p>
                            
                            <div class="grid grid-cols-2 gap-2 mb-4 text-sm">
                                <div class="bg-white/5 rounded-lg p-2">
                                    <div class="text-yellow-400 font-bold">23</div>
                                    <div class="text-slate-400">Pending</div>
                                </div>
                                <div class="bg-white/5 rounded-lg p-2">
                                    <div class="text-green-400 font-bold">544</div>
                                    <div class="text-slate-400">Approved</div>
                                </div>
                            </div>

                            <button onclick="window.location.href='{{ route('events.index') }}'" class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105">
                                <i class="bi bi-arrow-right mr-2"></i>
                                Manage Events
                            </button>
                        </div>
                    </div>

                    <!-- Notifications Management Card -->
                    <div class="management-card group bg-white/10 backdrop-blur-sm rounded-2xl overflow-hidden hover:bg-white/20 transition-all duration-300 border border-white/20 hover:border-yellow-400/50 hover:shadow-2xl hover:shadow-yellow-500/20">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <i class="bi bi-bell text-yellow-400 text-2xl"></i>
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">Alerts</span>
                                </div>
                                <div class="text-2xl font-bold text-yellow-400">12</div>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2 group-hover:text-yellow-400 transition-colors">Notifications</h3>
                            <p class="text-slate-300 mb-4">Send system-wide notifications and manage communication with users.</p>
                            
                            <div class="grid grid-cols-2 gap-2 mb-4 text-sm">
                                <div class="bg-white/5 rounded-lg p-2">
                                    <div class="text-red-400 font-bold">5</div>
                                    <div class="text-slate-400">Critical</div>
                                </div>
                                <div class="bg-white/5 rounded-lg p-2">
                                    <div class="text-yellow-400 font-bold">7</div>
                                    <div class="text-slate-400">Pending</div>
                                </div>
                            </div>

                            <button onclick="window.location.href='{{ route('admin.notifications.index') }}'" class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 text-white py-3 rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 transform hover:scale-105">
                                <i class="bi bi-arrow-right mr-2"></i>
                                Manage Notifications
                            </button>
                        </div>
                    </div>
                </div>

                <!-- System Status Section -->
                <div class="text-center">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 max-w-2xl mx-auto">
                        <h3 class="text-2xl font-bold text-white mb-4">System Status</h3>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-green-500 rounded-full mx-auto mb-2 flex items-center justify-center">
                                    <i class="bi bi-check-circle text-white text-2xl"></i>
                                </div>
                                <div class="text-green-400 font-bold">Operational</div>
                                <div class="text-slate-400 text-sm">All Systems</div>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-500 rounded-full mx-auto mb-2 flex items-center justify-center">
                                    <i class="bi bi-server text-white text-2xl"></i>
                                </div>
                                <div class="text-blue-400 font-bold">99.9%</div>
                                <div class="text-slate-400 text-sm">Uptime</div>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-purple-500 rounded-full mx-auto mb-2 flex items-center justify-center">
                                    <i class="bi bi-speedometer2 text-white text-2xl"></i>
                                </div>
                                <div class="text-purple-400 font-bold">Fast</div>
                                <div class="text-slate-400 text-sm">Response Time</div>
                            </div>
                        </div>
                    </div>
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

        // Management card hover effects
        document.querySelectorAll('.management-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
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

        // Observe all management cards
        document.querySelectorAll('.management-card').forEach(card => {
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