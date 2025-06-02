<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buat Feedback Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Font Awesome untuk rating bintang interaktif --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; /* slate-800 */ }
        ::-webkit-scrollbar-thumb { background: #3b82f6; /* blue-500 */ border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; /* blue-600 */ }

        /* Styling untuk rating bintang interaktif (diadaptasi untuk tema gelap) */
        .star-rating-input {
            direction: rtl; /* Bintang kanan = 1 */
            font-size: 2rem; /* Sesuaikan ukuran bintang jika perlu */
            unicode-bidi: bidi-override;
            display: inline-flex; /* Agar bisa di-center dengan text-align pada parent */
        }
        .star-rating-input input[type="radio"] {
            display: none;
        }
        .star-rating-input label {
            color: #4b5563; /* slate-600 untuk bintang kosong default */
            cursor: pointer;
            transition: color 0.2s;
            padding: 0 0.125rem; /* Sedikit padding antar bintang */
        }
        .star-rating-input label:hover,
        .star-rating-input label:hover ~ label,
        .star-rating-input input[type="radio"]:checked ~ label {
            color: #facc15; /* yellow-400 untuk bintang terpilih/hover */
        }
        /* Untuk input datetime-local agar teksnya terlihat di tema gelap */
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(0.8) brightness(1.2);
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
                <a href="{{ route('feedback.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('feedback.index') || request()->routeIs('feedback.create') || request()->routeIs('feedback.show') || request()->routeIs('feedback.edit') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
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
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-white">Buat Feedback Baru</h1>
                 <a href="{{ route('feedback.index') }}" class="inline-flex items-center px-6 py-2 border border-slate-600 text-slate-300 rounded-lg hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105">
                    <i class="bi bi-list-ul mr-2"></i>
                    <span>Daftar Feedback</span>
                </a>
            </div>
            
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

            @if(session('success'))
                <div class="mb-6 rounded-xl bg-green-900/40 p-5 border border-green-700/60 shadow-lg animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 pt-0.5">
                            <i class="bi bi-check-circle-fill text-green-400 text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-green-300">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white/10 backdrop-blur-md shadow-2xl rounded-2xl border border-slate-700/50 p-6 md:p-10 animate-fade-in">
                <form action="{{ route('feedback.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="event_id" class="block text-sm font-semibold text-slate-300 mb-1.5">Pilih Event</label>
                        <select name="event_id" id="event_id" class="mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400 text-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-lg shadow-sm text-sm px-4 py-3" required>
                            <option value="" class="text-slate-500 bg-slate-900">-- Pilih Event --</option>
                            @forelse($events as $event) {{-- Asumsi variabel $events dikirim dari controller --}}
                                <option value="{{ $event->event_id }}" {{ old('event_id') == $event->event_id ? 'selected' : '' }} class="text-slate-200 bg-slate-800">{{ $event->title }}</option>
                            @empty
                                <option disabled class="text-slate-500 bg-slate-900">Tidak ada event tersedia</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="text-center"> {{-- Wrapper untuk centering --}}
                        <label class="block text-sm font-semibold text-slate-300 mb-1.5">Rating</label>
                        <div class="star-rating-input mt-1">
                            {{-- Font Awesome tetap dipakai di sini untuk rating interaktif --}}
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                                <label for="star{{ $i }}" title="{{ $i }} stars"><i class="fas fa-star"></i></label>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label for="comments" class="block text-sm font-semibold text-slate-300 mb-1.5">Komentar</label>
                        <textarea class="mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-lg shadow-sm text-sm px-4 py-3 min-h-[120px] resize-y" name="comments" id="comments" rows="4" maxlength="500" placeholder="Tulis komentar Anda di sini (opsional)...">{{ old('comments') }}</textarea>
                    </div>

                    <div>
                        <label for="date_given" class="block text-sm font-semibold text-slate-300 mb-1.5">Tanggal Diberikan</label>
                        <input type="datetime-local" class="mt-1 block w-full bg-slate-800/70 border-slate-700 placeholder-slate-400 text-slate-200 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-lg shadow-sm text-sm px-4 py-3" name="date_given" id="date_given" value="{{ old('date_given', now()->format('Y-m-d\TH:i')) }}" required>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end items-center pt-6 space-y-4 sm:space-y-0 sm:space-x-4 border-t border-slate-700/50">
                        {{-- Tombol Batal opsional, bisa ditambahkan jika perlu --}}
                        {{-- <a href="{{ route('feedback.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-semibold text-sm shadow-md">
                            <i class="bi bi-x-lg mr-2"></i> Batal
                        </a> --}}
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                            <i class="bi bi-send-fill mr-2"></i> Kirim Feedback
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