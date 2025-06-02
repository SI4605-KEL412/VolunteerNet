@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manage Notifications - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Bootstrap CSS di-keep untuk Modal dan Alert dismiss --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                require('@tailwindcss/line-clamp'), // Untuk line-clamp pada pesan notifikasi
            ],
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; /* slate-800 */ }
        ::-webkit-scrollbar-thumb { background: #3b82f6; /* blue-500 */ border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; /* blue-600 */ }

        /* Override beberapa style Bootstrap agar sesuai tema gelap */
        .alert-success {
            background-color: rgba(22, 163, 74, 0.2) !important; /* bg-green-700/20 */
            border-color: rgba(22, 163, 74, 0.4) !important; /* border-green-600/40 */
            color: #86efac !important; /* text-green-300 */
        }
        .alert-success .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .modal-backdrop.show { opacity: 0.7 !important; }
        .modal.fade .modal-dialog { transition: transform .3s ease-out; transform: translate(0,-50px); }
        .modal.show .modal-dialog { transform: none; }
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
        </nav>
    </div>
    <div id="sidebar-overlay-admin" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>


    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-broadcast-pin text-sky-400 mr-3 text-4xl"></i> Manage Notifications
                </h1>
                <div class="flex flex-col sm:flex-row gap-3 mt-4 sm:mt-0">
                    <a href="{{ route('admin.notifications.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-xl hover:from-red-600 hover:to-pink-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                        <i class="bi bi-send-plus-fill mr-2"></i> Kirim Notifikasi Individual
                    </a>
                    <a href="{{ route('admin.notifications.bulk') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-slate-500 to-slate-600 text-white rounded-xl hover:from-slate-600 hover:to-slate-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                        <i class="bi bi-megaphone-fill mr-2"></i> Kirim Notifikasi Bulk
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-6 animate-fade-in" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
             @if(session('error'))
                <div class="bg-red-800/40 border border-red-600/50 text-red-300 px-5 py-4 rounded-xl mb-6 shadow-lg flex items-center space-x-3 animate-fade-in" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-2xl"></i>
                    <span class="text-base">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in overflow-hidden">
                 <div class="px-6 py-4 border-b border-slate-700/50">
                    <h2 class="text-xl font-semibold text-slate-100">Semua Notifikasi Terkirim</h2>
                </div>
                {{-- Pastikan $notifications adalah Paginator instance dari controller --}}
                @if($notifications->isEmpty())
                    <div class="text-center py-16 px-6">
                        <i class="bi bi-bell-slash-fill text-6xl text-slate-500 mb-6"></i>
                        <p class="text-2xl font-semibold text-white mb-2">Tidak Ada Notifikasi</p>
                        <p class="text-slate-400">Belum ada notifikasi yang dikirimkan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-slate-800/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">User (Penerima)</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Pesan</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Tanggal Kirim</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/60">
                                @foreach($notifications as $notification)
                                <tr class="hover:bg-slate-700/40 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-400">#{{ $notification->notif_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-200">
                                        {{ $notification->user->name ?? ($notification->user_id ? 'User ID: '.$notification->user_id : 'Semua User') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-300">
                                        <span class="line-clamp-1" title="{{ $notification->message }}">{{ Str::limit($notification->message, 35) }}</span>
                                        <button type="button" class="ml-1 text-sky-400 hover:text-sky-300 text-xs focus:outline-none" data-bs-toggle="modal" data-bs-target="#modal{{ $notification->notif_id }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <div class="modal fade" id="modal{{ $notification->notif_id }}" tabindex="-1" aria-labelledby="modalLabel{{ $notification->notif_id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content bg-slate-800 text-slate-200 rounded-xl shadow-xl border border-slate-700">
                                                    <div class="modal-header px-6 py-4 border-b border-slate-700">
                                                        <h5 class="modal-title text-lg font-semibold text-slate-100 flex items-center" id="modalLabel{{ $notification->notif_id }}">
                                                            <i class="bi bi-chat-left-text-fill mr-2 text-sky-400"></i> Detail Pesan Notifikasi
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-6 text-sm text-slate-300 leading-relaxed whitespace-pre-wrap" style="max-height: 60vh; overflow-y: auto;">
                                                        {{ $notification->message }}
                                                    </div>
                                                    <div class="modal-footer px-6 py-4 border-t border-slate-700">
                                                        <button type="button" class="px-5 py-2 bg-slate-600 hover:bg-slate-500 text-slate-200 rounded-lg text-sm font-medium transition-colors" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">{{ \Carbon\Carbon::parse($notification->date_sent)->isoFormat('D MMM YY, HH:mm') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($notification->status === 'read' || $notification->status === 'Read')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-700/40 text-green-300 ring-1 ring-inset ring-green-600/50">
                                                <i class="bi bi-check-circle-fill mr-1.5"></i>Read
                                            </span>
                                        @elseif($notification->status === 'unread' || $notification->status === 'Unread' || $notification->status === 'sent' || $notification->status === 'Sent')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-700/40 text-sky-300 ring-1 ring-inset ring-sky-600/50">
                                                <i class="bi bi-send-check-fill mr-1.5"></i>Sent / Unread
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-600/50 text-slate-300 ring-1 ring-inset ring-slate-500/50">
                                                {{ ucfirst($notification->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            
            {{-- Tampilkan link paginasi jika $notifications adalah instance Paginator dan memiliki halaman --}}
            @if ($notifications instanceof \Illuminate\Pagination\AbstractPaginator && $notifications->hasPages())
                <div class="mt-10">
                    {{-- 
                        PENTING: Untuk tampilan pagination yang sesuai tema gelap Tailwind,
                        Anda mungkin perlu mem-publish view pagination bawaan Laravel:
                        `php artisan vendor:publish --tag=laravel-pagination`
                        Kemudian edit file di `resources/views/vendor/pagination/tailwind.blade.php`
                        (atau buat file kustom sendiri dan panggil seperti `->links('pagination.custom-tailwind')`).
                    --}}
                    {{ $notifications->links() }}
                </div>
            @endif

            <div class="mt-10 text-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-8 py-3 border border-slate-600/80 text-slate-300 rounded-xl hover:bg-slate-700/70 hover:text-white hover:border-slate-500 transition-all duration-200 font-semibold text-sm shadow-lg transform hover:scale-105">
                    <i class="bi bi-arrow-left-circle-fill mr-2.5"></i> Kembali ke Dashboard EO
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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