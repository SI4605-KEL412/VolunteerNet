<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kirim Notifikasi Individual - Admin Dashboard</title>
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
         /* Styling untuk option pada select di tema gelap */
        select option {
            background-color: #1e293b; /* slate-800 atau warna background dropdown yang diinginkan */
            color: #e2e8f0; /* slate-200 atau warna teks yang diinginkan */
        }
        select option:disabled {
            color: #64748b; /* slate-500 */
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 min-h-screen text-slate-200">
    <button id="mobile-menu-btn-admin" class="lg:hidden fixed top-4 left-4 z-[60] bg-sky-600 text-white p-2 rounded-lg shadow-lg">
        <i class="bi bi-list text-xl"></i>
    </button>

    <div id="sidebar-admin" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-slate-800 to-slate-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 shadow-2xl">
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-sky-500 to-cyan-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-shield-lock-fill text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-white">Admin Panel</h2>
            </div>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-grid-1x2-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Dashboard Utama</span>
            </a>
            <a href="{{ route('manageusers.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('manageusers.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-people-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Users</span>
            </a>
            <a href="{{ route('events.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('events.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-calendar-event-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Events</span>
            </a>
             <a href="{{ route('admin.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.notifications.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-bell-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Notification</span>
            </a>
            {{-- Tambahkan link navigasi admin lainnya di sini --}}
        </nav>
    </div>
    <div id="sidebar-overlay-admin" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>


    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 animate-fade-in">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-send-plus-fill text-sky-400 mr-3 text-4xl"></i> Kirim Notifikasi
                </h1>
                <a href="{{ route('admin.notifications.index') }}" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-medium text-sm shadow-md">
                    <i class="bi bi-list-ul mr-2"></i>Daftar Notifikasi
                </a>
            </div>
            
            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 p-6 md:p-10 animate-fade-in">
                 {{-- Alert Error dari Bootstrap akan di-override oleh style Tailwind jika ada --}}
                @if ($errors->any())
                    <div class="mb-6 rounded-xl bg-red-900/40 p-5 border border-red-700/60 shadow-lg">
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
                
                <form action="{{ route('admin.notifications.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="user_id" class="block text-sm font-semibold text-slate-300 mb-1.5">Penerima Notifikasi (User)</label>
                        <select name="user_id" id="user_id" class="form-select mt-1 block w-full bg-slate-800/70 border-slate-700 text-slate-200 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('user_id') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" required>
                            <option value="" class="bg-slate-900 text-slate-500">-- Pilih User --</option>
                            @foreach($users as $user) {{-- Asumsi variabel $users dikirim dari controller --}}
                                <option value="{{ $user->user_id }}" {{ (isset($preselectedUserId) && $preselectedUserId == $user->user_id) || old('user_id') == $user->user_id ? 'selected' : '' }} class="bg-slate-800 text-slate-200">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-slate-300 mb-1.5">Isi Pesan Notifikasi</label>
                        <textarea name="message" id="message" rows="5" class="form-textarea mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/70 text-slate-100 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 min-h-[150px] resize-y @error('message') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" required placeholder="Tulis pesan notifikasi Anda di sini...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 border-t border-slate-700/50">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-sky-500 to-cyan-600 text-white rounded-xl hover:from-sky-600 hover:to-cyan-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-send-fill mr-2"></i> Kirim Notifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Skrip untuk mobile menu admin
        const mobileMenuBtnAdmin = document.getElementById('mobile-menu-btn-admin');
        const sidebarAdmin = document.getElementById('sidebar-admin');
        const sidebarOverlayAdmin = document.getElementById('sidebar-overlay-admin');
        if (mobileMenuBtnAdmin && sidebarAdmin && sidebarOverlayAdmin) {
            mobileMenuBtnAdmin.addEventListener('click', () => {
                sidebarAdmin.classList.toggle('-translate-x-full');
                sidebarOverlayAdmin.classList.toggle('hidden');
            });
            sidebarOverlayAdmin.addEventListener('click', () => {
                sidebarAdmin.classList.add('-translate-x-full');
                sidebarOverlayAdmin.classList.add('hidden');
            });
        }
        // Skrip untuk animasi item navigasi sidebar
        document.querySelectorAll('#sidebar-admin .nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                if (!item.classList.contains('bg-slate-700')) { item.style.transform = 'translateX(4px)'; }
            });
            item.addEventListener('mouseleave', () => { item.style.transform = 'translateX(0)'; });
        });
    </script>
</body>
</html>