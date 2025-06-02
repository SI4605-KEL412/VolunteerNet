@php
    // use Illuminate\Support\Str; // Tidak terlihat digunakan di sini
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Entri Portofolio - User Dashboard</title>
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

        /* Styling untuk input date agar ikon kalender terlihat di tema gelap */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.8) brightness(1.2);
        }
        .required-field::after {
            content: " *";
            color: #f87171; /* Tailwind red-400 */
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
                <a href="{{ route('volunfeeds.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('volunfeeds.*') || request()->routeIs('portfolio.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
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
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 animate-fade-in">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-file-earmark-plus-fill text-yellow-400 mr-3 text-4xl"></i> Tambah Entri Portofolio
                </h1>
                <a href="{{ route('portfolio.index') }}" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-medium text-sm shadow-md">
                    <i class="bi bi-list-ul mr-2"></i>Daftar Portfolio Saya
                </a>
            </div>
            
            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 p-6 md:p-10 animate-fade-in">
                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-red-900/40 p-5 border border-red-700/60 shadow-lg">
                        <div class="flex">
                            <div class="flex-shrink-0 pt-0.5">
                                <i class="bi bi-exclamation-triangle-fill text-red-400 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-red-300">Terjadi kesalahan:</h3>
                                <div class="mt-2 text-sm text-red-300/90">
                                    <ul role="list" class="list-disc space-y-1.5 pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-300 mb-1.5 required-field">Judul Portofolio</label>
                        <input type="text" name="title" id="title" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-100 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 rounded-lg shadow-sm text-base px-4 py-3 @error('title') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('title') }}" required placeholder="Contoh: Partisipasi dalam Bakti Sosial XYZ">
                        @error('title')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-300 mb-1.5">Deskripsi</label>
                        <textarea name="description" id="description" class="form-textarea mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/70 text-slate-100 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 rounded-lg shadow-sm text-sm px-4 py-3 min-h-[150px] resize-y @error('description') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" rows="5" placeholder="Jelaskan kontribusi dan pengalaman Anda dalam kegiatan ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="date" class="block text-sm font-semibold text-slate-300 mb-1.5">Tanggal Kegiatan</label>
                            <input type="date" name="date" id="date" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 text-slate-200 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('date') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('date') }}">
                            @error('date')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-semibold text-slate-300 mb-1.5">Lokasi Kegiatan</label>
                            <input type="text" name="location" id="location" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-100 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('location') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('location') }}" placeholder="Contoh: Desa Sukamaju, Online">
                            @error('location')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="file" class="block text-sm font-semibold text-slate-300 mb-1.5">Upload File Pendukung (Opsional)</label>
                        <input type="file" class="form-input mt-1 block w-full text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-500/20 file:text-yellow-300 hover:file:bg-yellow-600/30 file:transition-colors file:cursor-pointer bg-slate-800/70 border-slate-700 focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 rounded-lg shadow-sm @error('file') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" id="file" name="file" accept=".pdf,.jpg,.jpeg,.png">
                        <small class="mt-1.5 text-xs text-slate-500 block">Format yang didukung: PDF, JPG, PNG. Maksimal ukuran file: 2MB.</small>
                        @error('file')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end items-center pt-6 space-y-4 sm:space-y-0 sm:space-x-4 border-t border-slate-700/50">
                        <a href="{{ route('portfolio.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-semibold text-sm shadow-md">
                            <i class="bi bi-x-lg mr-2"></i> Batal
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-2.5 bg-gradient-to-r from-yellow-500 to-amber-600 text-slate-900 rounded-xl hover:from-yellow-600 hover:to-amber-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-check-circle-fill mr-2"></i> Simpan Portofolio
                        </button>
                    </div>
                </form>
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
```

