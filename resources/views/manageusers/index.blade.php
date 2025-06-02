<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manage Users - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Bootstrap CSS di-keep untuk Toast --}}
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
                require('@tailwindcss/forms'), // Untuk styling form input pencarian
            ],
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #1e293b; /* slate-800 */ }
        ::-webkit-scrollbar-thumb { background: #3b82f6; /* blue-500 */ border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; /* blue-600 */ }

        /* Override beberapa style Bootstrap untuk toast agar sesuai tema gelap */
        .toast-container .toast {
            background-color: #1e293b !important; /* slate-800 */
            color: #e2e8f0 !important; /* slate-200 */
            border-radius: 0.75rem !important; /* rounded-xl */
            border: 1px solid #334155 !important; /* slate-700 */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important; /* shadow-lg */
        }
        .toast-container .toast-header {
            background-color: #334155 !important; /* slate-700 */
            color: #cbd5e1 !important; /* slate-300 */
            border-bottom: 1px solid #475569 !important; /* slate-600 */
        }
         .toast-container .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%); /* Membuat tombol close Bootstrap menjadi putih */
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-person-lines-fill text-sky-400 mr-3 text-4xl"></i> Manage Users
                </h1>
                {{-- Tombol aksi di header jika perlu, misal:
                <a href="{{ route('manageusers.create') }}" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-sky-500 to-cyan-600 text-white rounded-xl hover:from-sky-600 hover:to-cyan-700 transition-all duration-200 transform hover:scale-105 shadow-xl font-semibold text-sm">
                    <i class="bi bi-person-plus-fill mr-2"></i> Tambah User Baru
                </a> 
                --}}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10 animate-fade-in">
                <div class="bg-gradient-to-br from-blue-700 via-indigo-700 to-purple-800 p-6 rounded-xl shadow-2xl border border-blue-500/50">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-500/30 rounded-full flex items-center justify-center">
                            <i class="bi bi-people-fill text-2xl text-blue-300"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-blue-200 uppercase tracking-wider">Total Volunteers</p>
                            <p class="text-3xl font-bold text-white">{{ $users->where('role', 'user')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-700 via-emerald-700 to-teal-800 p-6 rounded-xl shadow-2xl border border-green-500/50">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-500/30 rounded-full flex items-center justify-center">
                             <i class="bi bi-person-check-fill text-2xl text-green-300"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-green-200 uppercase tracking-wider">Updated This Month</p>
                            @php
                                $updatedCount = 0; $currentMonth = now()->format('Y-m');
                                foreach ($users as $user) {
                                    if (!$user->updated_at || !$user->created_at) continue;
                                    $isUpdatedThisMonth = $user->updated_at->format('Y-m') === $currentMonth;
                                    $wasCreatedBefore = $user->created_at->format('Y-m') !== $currentMonth;
                                    $manualUpdate = session('updated_user_ids') && in_array($user->user_id, session('updated_user_ids'));
                                    if ($isUpdatedThisMonth && ($wasCreatedBefore || $manualUpdate)) $updatedCount++;
                                }
                            @endphp
                            <p class="text-3xl font-bold text-white">{{ $updatedCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-yellow-600 via-amber-700 to-orange-800 p-6 rounded-xl shadow-2xl border border-yellow-500/50">
                     <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-yellow-500/30 rounded-full flex items-center justify-center">
                            <i class="bi bi-person-plus-fill text-2xl text-yellow-300"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-yellow-200 uppercase tracking-wider">New This Month</p>
                             @php
                                $newCount = 0; $currentMonth = now()->format('Y-m');
                                foreach ($users as $user) {
                                    if ($user->role !== 'user' || !$user->created_at) continue;
                                    if ($user->created_at->format('Y-m') === $currentMonth) $newCount++;
                                }
                            @endphp
                            <p class="text-3xl font-bold text-white">{{ $newCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 animate-fade-in overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-700/50">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h2 class="text-xl font-semibold text-slate-100">Daftar Pengguna</h2>
                        <form action="{{ route('manageusers.index') }}" method="get" class="w-full sm:w-auto sm:max-w-xs">
                            <div class="relative">
                                <input type="text" name="katakunci" value="{{ $katakunci ?? '' }}" class="form-input w-full bg-slate-800/70 border-slate-700 placeholder-slate-400/80 text-slate-100 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-4 py-2.5 pr-10" placeholder="Cari nama atau email...">
                                <button type="submit" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-sky-400">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-800/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/60">
                            @forelse ($users as $item)
                                @if($item->role == 'user')
                                <tr class="hover:bg-slate-700/40 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-slate-600 to-slate-700 flex items-center justify-center text-slate-300 font-semibold text-sm mr-3 shadow">
                                                {{ strtoupper(substr($item->name, 0, 1)) }}
                                            </div>
                                            <span class="text-sm font-medium text-slate-100">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $item->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold 
                                            @if($item->role == 'admin') bg-red-500/20 text-red-300 ring-1 ring-inset ring-red-500/30
                                            @elseif($item->role == 'eo') bg-amber-500/20 text-amber-300 ring-1 ring-inset ring-amber-500/30
                                            @else bg-sky-500/20 text-sky-300 ring-1 ring-inset ring-sky-500/30 @endif">
                                            {{ ucfirst($item->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm space-x-2">
                                        <a href="{{ route('manageusers.show', $item->user_id) }}" class="inline-flex items-center bg-sky-600/80 hover:bg-sky-700/90 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md" title="View User">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('manageusers.edit', $item->user_id) }}" class="inline-flex items-center bg-amber-500/80 hover:bg-amber-600/90 text-slate-900 px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md" title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form onsubmit="return confirm('Anda yakin ingin menghapus pengguna ini?');" action="{{ route('manageusers.destroy', $item->user_id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center bg-rose-600/80 hover:bg-rose-700/90 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md" title="Delete User">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-10 text-slate-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="bi bi-people text-5xl text-slate-500 mb-3"></i>
                                            <p>Tidak ada pengguna ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                 @if ($users instanceof \Illuminate\Pagination\AbstractPaginator && $users->hasPages())
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-800/20">
                        {{ $users->appends(request()->except('page'))->links() }} {{-- Menambahkan appends untuk menjaga query string saat paginasi --}}
                    </div>
                @endif
            </div>

             <div class="toast-container fixed bottom-0 end-0 p-3 z-[10000]">
                @if(session('success'))
                    <div id="successToast" class="toast align-items-center show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body flex items-center">
                                <i class="bi bi-check-circle-fill text-green-400 text-xl mr-2"></i>
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>


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

        // Auto-hide toast jika ada
        const successToast = document.getElementById('successToast');
        if (successToast) {
            // Bootstrap 5 Toast instance
            var toast = new bootstrap.Toast(successToast);
            toast.show();
        }
    </script>
</body>
</html>