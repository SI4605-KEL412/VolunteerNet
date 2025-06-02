@php
    use Illuminate\Support\Str; // Dipertahankan jika ada penggunaan Str di bagian lain
    use App\Models\ReferralProgram;
    use App\Models\User; // Dipertahankan jika digunakan oleh model ReferralProgram
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Referral Saya</title>
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
                require('@tailwindcss/forms'),
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
                <a href="{{ route('portfolio.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('portfolio.index') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                    {{-- Ganti ikon jika perlu, misal: bi-collection atau bi-person-badge --}}
                    <i class="bi bi-person-vcard mr-3 text-orange-400 group-hover:scale-110 transition-transform"></i>
                    <span>Build Portfolio</span>
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
                {{-- Tombol "Kode Referral Saya" dari HTML asli Anda sedikit berbeda strukturnya. Saya akan gunakan versi action-btn agar konsisten --}}
                <a href="{{ route('referral.index') }}" class="action-btn {{ request()->routeIs('referral.index') ? 'ring-2 ring-sky-400 bg-gradient-to-r from-blue-600 to-blue-700' : 'bg-gradient-to-r from-blue-500 to-blue-600' }} block w-full text-center px-4 py-3 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-share-fill mr-2"></i>
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
                <a href="{{ route('admin.dashboard') }}" class="action-btn block w-full text-center px-4 py-3 bg-gradient-to-r from-slate-600 to-slate-700 text-white rounded-lg hover:from-slate-700 hover:to-slate-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="bi bi-gear mr-2"></i>
                    <span>Go to EO Dashboard</span>
                </a>
            </div>
        </nav>
    </div>
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-gift-fill text-blue-400 mr-3 text-4xl"></i> Program Referral Saya
                </h1>
                 <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-medium text-sm shadow-md">
                    <i class="bi bi-arrow-left-circle-fill mr-2"></i>Dashboard Utama
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-800/40 border border-green-600/50 text-green-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-check-circle-fill text-2xl"></i>
                    <span class="text-base">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-800/40 border border-red-600/50 text-red-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                    <span class="text-base">{{ session('error') }}</span>
                </div>
            @endif

            <section class="mb-12 animate-fade-in">
                <h2 class="text-2xl font-semibold text-slate-100 mb-5 flex items-center">
                    <i class="bi bi-upc-scan mr-3 text-sky-400"></i> Kode Referral Pribadi Anda
                </h2>
                @if(!$referralCode) {{-- Jika user belum punya kode referral --}}
                    <div class="bg-slate-800/50 backdrop-blur-sm p-6 rounded-xl shadow-lg border border-slate-700/50 text-center">
                        <p class="text-slate-300 mb-4">Anda belum memiliki kode referral. Buat sekarang untuk mulai mengundang teman!</p>
                        <form action="{{ route('referral.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-200 transform hover:scale-105 shadow-xl inline-flex items-center space-x-2 font-semibold">
                                <i class="bi bi-magic mr-2"></i>Buat Kode Referral
                            </button>
                        </form>
                    </div>
                @else {{-- Jika user sudah punya kode referral --}}
                    <div class="bg-gradient-to-br from-blue-700 via-indigo-700 to-purple-800 p-8 rounded-xl shadow-2xl text-center border border-blue-500/50">
                        <p class="text-sm text-blue-200 mb-2 uppercase tracking-wider">Kode Referral Anda</p>
                        <div class="relative group">
                            <div id="referralCodeText" class="text-3xl md:text-4xl font-bold text-yellow-300 tracking-wider font-mono my-3 p-4 bg-black/30 rounded-lg inline-block relative select-all">
                                {{ $referralCode }}
                            </div>
                            <button onclick="copyToClipboard('{{ $referralCode }}')" class="absolute -top-2 -right-2 md:top-1/2 md:-translate-y-1/2 md:right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2 bg-yellow-400 hover:bg-yellow-500 text-slate-900 rounded-full shadow-lg" title="Salin Kode">
                                <i class="bi bi-clipboard-check-fill text-lg"></i>
                            </button>
                        </div>
                        <p class="text-sm text-blue-300"><i class="bi bi-patch-check-fill text-green-400 mr-1"></i> Status: Aktif</p>
                        <p class="text-xs text-blue-400 mt-3">Bagikan kode ini kepada teman Anda!</p>
                    </div>
                @endif
            </section>

            @if($referralCode) {{-- Hanya tampilkan jika user punya kode referral --}}
            <section class="mb-12 animate-fade-in" style="animation-delay: 0.1s;">
                <h2 class="text-2xl font-semibold text-slate-100 mb-5 mt-10 pt-6 border-t border-slate-700/50 flex items-center">
                    <i class="bi bi-people-fill mr-3 text-green-400"></i> Pengguna yang Bergabung dengan Kode Anda
                </h2>
                @if($referrals->isEmpty())
                    <div class="bg-amber-800/30 backdrop-blur-sm p-6 rounded-xl shadow-lg border border-amber-700/50 text-center">
                        <i class="bi bi-person-fill-x text-4xl text-amber-400 mb-3"></i>
                        <p class="text-amber-200">Belum ada pengguna yang menggunakan kode referral Anda.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($referrals as $referral)
                            <div class="bg-slate-800/60 backdrop-blur-sm p-5 rounded-xl shadow-lg border border-slate-700/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                <div>
                                    <p class="text-slate-100 font-semibold flex items-center"><i class="bi bi-person-check-fill mr-2 text-sky-400"></i>{{ $referral->referredUser->name ?? 'Pengguna' }}</p>
                                    <p class="text-xs text-slate-400 mt-1">Tanggal Bergabung: {{ \Carbon\Carbon::parse($referral->date_referred)->isoFormat('LL') }}</p>
                                </div>
                                @if($referral->reward_earned)
                                    <p class="text-sm text-green-400 font-semibold bg-green-500/10 px-3 py-1 rounded-full whitespace-nowrap"><i class="bi bi-award-fill mr-1.5"></i>Reward: {{ $referral->reward_earned }}</p>
                                @else
                                     <p class="text-sm text-slate-500 font-medium bg-slate-700/50 px-3 py-1 rounded-full whitespace-nowrap">Belum ada reward</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                     @if ($referrals instanceof \Illuminate\Pagination\AbstractPaginator && $referrals->hasPages())
                        <div class="mt-6">
                            {{ $referrals->links() }} {{-- Pastikan view pagination sudah di-style untuk Tailwind --}}
                        </div>
                    @endif
                @endif
            </section>
            @endif

            @php
                // Logika ini dipertahankan sesuai permintaan untuk tidak mengubah flow
                $referral = \App\Models\ReferralProgram::with('referrer')->where('referred_user_id', auth()->user()->user_id)->first();
            @endphp

            <section class="animate-fade-in" style="animation-delay: 0.2s;">
                 <h2 class="text-2xl font-semibold text-slate-100 mb-5 mt-10 pt-6 border-t border-slate-700/50 flex items-center">
                    <i class="bi bi-key-fill mr-3 text-amber-400"></i> Gunakan Kode Referral Teman
                </h2>
                @if($referral) {{-- Jika user SUDAH menggunakan kode referral orang lain ($referral dari blok @php di atas ada isinya) --}}
                     <div class="bg-slate-800/50 backdrop-blur-sm p-6 rounded-xl shadow-lg border border-slate-700/50 text-center">
                        <i class="bi bi-check-circle-fill text-4xl text-green-400 mb-3"></i>
                        <p class="text-slate-200">Anda telah menggunakan kode referral dari <strong class="text-amber-300">{{ $referral->referrer->name ?? 'seseorang' }}</strong>.</p>
                        <p class="text-xs text-slate-400 mt-1">Kode yang digunakan: <code class="px-1.5 py-0.5 bg-slate-700 text-amber-400 rounded-md font-mono">{{ $referral->referral_code_used ?? ($referral->referral_code ?? 'N/A') }}</code></p>
                    </div>
                @else {{-- Jika user BELUM menggunakan kode referral orang lain (hasil dari blok @php di atas adalah null), tampilkan form --}}
                    <div class="bg-slate-800/60 backdrop-blur-sm p-6 md:p-8 rounded-xl shadow-lg border border-slate-700/50">
                        <form method="POST" action="{{ route('referral.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="referral_code_input" class="block text-sm font-semibold text-slate-300 mb-1.5">Masukkan Kode Referral</label>
                                <input type="text" class="form-input mt-1 block w-full bg-slate-700/70 border-slate-600 placeholder-slate-400/80 text-slate-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 rounded-lg shadow-sm text-base px-4 py-3" name="referral_code" id="referral_code_input" value="{{ old('referral_code') }}" required placeholder="Contoh: TEMANANDA123">
                                @error('referral_code')
                                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end pt-2">
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-2.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-xl hover:from-amber-600 hover:to-orange-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                                    <i class="bi bi-patch-check-fill mr-2"></i>Gunakan Kode Ini
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </section>
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

        // Skrip untuk copy to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                const button = event.target.closest('button');
                const icon = button.querySelector('i');
                const originalIconClass = icon.className;
                icon.className = 'bi bi-check-all text-lg text-green-500';
                button.disabled = true;
                setTimeout(() => {
                    icon.className = originalIconClass;
                    button.disabled = false;
                }, 2000);
            }, function(err) {
                alert('Gagal menyalin kode referral.');
                console.error('Could not copy text: ', err);
            });
        }
    </script>
</body>
</html>