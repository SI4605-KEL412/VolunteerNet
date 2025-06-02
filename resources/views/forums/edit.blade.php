@php
    // Tidak ada penggunaan Str di sini, jadi bisa dihapus jika tidak ada di tempat lain
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Topik Forum - {{ $forum->title }}</title>
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
                require('@tailwindcss/forms'), // Untuk styling form yang lebih baik
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
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-white flex items-center">
                    <i class="bi bi-pencil-square text-yellow-400 mr-3"></i> Edit Topik Forum
                </h1>
                 <a href="{{ route('forums.show', $forum) }}" class="inline-flex items-center px-6 py-2 border border-slate-600 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 text-sm">
                    <i class="bi bi-eye-fill mr-2"></i>
                    <span>Lihat Topik</span>
                </a>
            </div>
            
            {{-- Pesan Error Validasi (Contoh) --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-900/40 p-5 border border-red-700/60 shadow-lg animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0 pt-0.5">
                            <i class="bi bi-exclamation-triangle-fill text-red-400 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-red-300">Input Tidak Valid</h3>
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

            <div class="bg-white/10 backdrop-blur-md shadow-2xl rounded-2xl border border-slate-700/50 p-6 md:p-10 animate-fade-in">
                <form action="{{ route('forums.update', $forum) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-300 mb-1.5">Judul Topik</label>
                        <input type="text" name="title" id="title" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-100 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 rounded-lg shadow-sm text-base px-4 py-3" value="{{ old('title', $forum->title) }}" required>
                        @error('title')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-semibold text-slate-300 mb-1.5">Isi Topik</label>
                        <textarea name="content" id="content" rows="8" class="form-textarea mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-200 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 rounded-lg shadow-sm text-base px-4 py-3 min-h-[200px] resize-y" required>{{ old('content', $forum->content) }}</textarea>
                         @error('content')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Contoh jika ada field kategori --}}
                    {{-- <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-300 mb-1.5">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select mt-1 block w-full bg-slate-800/70 border-slate-700 text-slate-200 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 rounded-lg shadow-sm text-base px-4 py-3">
                            <option value="">Pilih Kategori (Opsional)</option>
                            @foreach($categories as $category) {{-- Asumsi $categories di-pass dari controller --}}
                                {{-- <option value="{{ $category->id }}" {{ old('category_id', $forum->category_id) == $category->id ? 'selected' : '' }} class="bg-slate-800">{{ $category->name }}</option> --}}
                            {{-- @endforeach
                        </select>
                    </div> --}}


                    <div class="flex flex-col sm:flex-row justify-end items-center pt-6 space-y-4 sm:space-y-0 sm:space-x-4 border-t border-slate-700/50">
                        <a href="{{ route('forums.show', $forum) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-semibold text-sm shadow-md">
                            <i class="bi bi-x-lg mr-2"></i> Batal
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-yellow-500 to-amber-600 text-slate-900 rounded-xl hover:from-yellow-600 hover:to-amber-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-check-circle-fill mr-2"></i> Update Topik
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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