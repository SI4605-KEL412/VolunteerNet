<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buat Event Baru - EO Dashboard</title>
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
    <button id="mobile-menu-btn-admin" class="lg:hidden fixed top-4 left-4 z-[60] bg-sky-600 text-white p-2 rounded-lg shadow-lg">
        <i class="bi bi-list text-xl"></i>
    </button>

    <div id="sidebar-admin" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-slate-800 to-slate-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 shadow-2xl">
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-sky-500 to-cyan-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-shield-lock-fill text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-white">EO Panel</h2>
            </div>
        </div>
        <nav class="p-4 space-y-2">
            {{-- Navigasi khusus Admin/EO --}}
            <a href="{{ route('events.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('events.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-calendar-event-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Events</span>
            </a>
            {{-- Tambahkan link navigasi admin lainnya di sini --}}
             {{-- <a href="{{ route('some.other.admin.route') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 text-slate-300 hover:text-white hover:bg-slate-700">
                <i class="bi bi-gear-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Settings</span>
            </a> --}}

            <div class="pt-4 border-t border-slate-700 mt-4">
                 <a href="{{ route('user.dashboardEO') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 text-slate-400 hover:text-sky-300 hover:bg-slate-700/50 text-sm">
                    <i class="bi bi-arrow-left-circle-fill mr-2"></i>
                    <span>Kembali ke EO Dashboard</span>
                </a>
            </div>
        </nav>
    </div>
    <div id="sidebar-overlay-admin" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>


    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <nav aria-label="breadcrumb" class="mb-6 text-sm animate-fade-in">
                <ol class="flex items-center space-x-2 text-slate-400">
                    <li>
                        <a href="{{ route('events.index') }}" class="hover:text-sky-400 transition-colors">Daftar Event</a>
                    </li>
                    <li>
                        <i class="bi bi-chevron-right text-xs"></i>
                    </li>
                    <li class="font-medium text-slate-200" aria-current="page">Buat Event Baru</li>
                </ol>
            </nav>

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in">
                <div class="px-6 py-5 border-b border-slate-700/50">
                    <h1 class="text-2xl font-semibold text-slate-100 flex items-center">
                        <i class="bi bi-calendar-plus-fill mr-3 text-sky-400"></i>Buat Event Baru
                    </h1>
                </div>

                <form action="{{ route('events.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="rounded-md bg-red-900/30 p-4 border border-red-700/50">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-exclamation-triangle-fill text-red-400 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-300">Terdapat {{ $errors->count() }} error pada input Anda:</h3>
                                    <div class="mt-2 text-sm text-red-400">
                                        <ul role="list" class="list-disc space-y-1 pl-5">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-300 mb-1.5 required-field">Judul Event</label>
                        <input type="text" name="title" id="title" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-100 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-base px-4 py-3 @error('title') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('title') }}" required placeholder="Contoh: Workshop Digital Marketing">
                        @error('title')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-300 mb-1.5">Deskripsi</label>
                        <textarea name="description" id="description" class="form-textarea mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-200 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 min-h-[150px] resize-y @error('description') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" rows="5" placeholder="Jelaskan detail mengenai event ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-semibold text-slate-300 mb-1.5">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 text-slate-200 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('start_date') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('start_date') }}">
                            @error('start_date')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-semibold text-slate-300 mb-1.5">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 text-slate-200 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('end_date') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('end_date') }}">
                            @error('end_date')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-semibold text-slate-300 mb-1.5">Lokasi</label>
                        <input type="text" name="location" id="location" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-100 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('location') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('location') }}" placeholder="Contoh: Gedung Serbaguna, Online via Zoom">
                        @error('location')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-300 mb-1.5">Status</label>
                        <select name="status" id="status" class="form-select mt-1 block w-full bg-slate-800/70 border-slate-700 text-slate-200 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('status') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror">
                            <option value="" class="bg-slate-800 text-slate-400">Pilih Status</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }} class="bg-slate-800">Pending</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }} class="bg-slate-800">Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }} class="bg-slate-800">Rejected</option>
                        </select>
                        @error('status')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="organizer_id" class="block text-sm font-semibold text-slate-300 mb-1.5">ID Organizer (Opsional)</label>
                        <input type="number" name="organizer_id" id="organizer_id" class="form-input mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-100 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-3 @error('organizer_id') border-red-500/70 focus:border-red-500 focus:ring-red-500 @enderror" value="{{ old('organizer_id') }}" placeholder="Masukkan ID numerik organizer">
                        @error('organizer_id')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex flex-col sm:flex-row justify-end items-center pt-6 space-y-4 sm:space-y-0 sm:space-x-4 border-t border-slate-700/50">
                        <a href="{{ route('events.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-semibold text-sm shadow-md">
                            <i class="bi bi-x-lg mr-2"></i> Batal
                        </a>
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-2.5 bg-gradient-to-r from-sky-500 to-cyan-600 text-white rounded-xl hover:from-sky-600 hover:to-cyan-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-check-circle-fill mr-2"></i> Simpan Event
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
        // Skrip untuk animasi item navigasi sidebar (jika diperlukan untuk sidebar admin)
        document.querySelectorAll('#sidebar-admin .nav-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                if (!item.classList.contains('bg-slate-700')) { item.style.transform = 'translateX(4px)'; }
            });
            item.addEventListener('mouseleave', () => { item.style.transform = 'translateX(0)'; });
        });
    </script>
</body>
</html>