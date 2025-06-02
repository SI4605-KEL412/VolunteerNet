@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Pendaftar Event - EO Dashboard</title>
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
            <a href="{{ route('eo.recruitment.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('eo.recruitment.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-person-check-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Pendaftar</span>
            </a>
             <a href="{{ route('admin.notifications.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.notifications.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-bell-fill mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Manage Notification</span>
            </a>
            <a href="{{ route('impacttracker.eo.index') }}" class="nav-item group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('impacttracker.eo.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                <i class="bi bi-graph-up-arrow mr-3 text-slate-400 group-hover:text-sky-400 transition-colors"></i>
                <span>Impact Tracker</span>
            </a>
        </nav>
    </div>
    <div id="sidebar-overlay-admin" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>


    <div class="lg:ml-64 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0 flex items-center">
                    <i class="bi bi-person-check-fill text-sky-400 mr-3 text-4xl"></i> Daftar Pendaftar Event Anda
                </h1>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-2.5 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700 hover:text-white transition-colors duration-200 transform hover:scale-105 font-medium text-sm shadow-md">
                    <i class="bi bi-arrow-left-circle-fill mr-2"></i>Dashboard EO
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

            @if($recruitments->isEmpty())
                <div class="text-center py-16 bg-white/5 backdrop-blur-sm rounded-xl border border-slate-700 shadow-xl animate-fade-in">
                    <i class="bi bi-people-fill text-6xl text-slate-500 mb-6"></i>
                    <p class="text-2xl font-semibold text-white mb-2">Belum Ada Pendaftar</p>
                    <p class="text-slate-400">Saat ini belum ada pendaftar untuk event yang Anda kelola.</p>
                </div>
            @else
                <div class="space-y-6 animate-fade-in">
                    @foreach ($recruitments as $recruitment)
                        <div class="bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl border border-slate-700/50 overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3 pb-3 border-b border-slate-700/50">
                                    <div>
                                        <h2 class="text-xl font-semibold text-slate-100">{{ $recruitment->user->name ?? 'Nama User Tidak Tersedia' }}</h2>
                                        <p class="text-sm text-sky-400 font-medium">
                                            Event: <span class="text-slate-300">{{ $recruitment->event->title ?? '-' }}</span>
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            Tanggal Daftar: {{ $recruitment->date_applied ? \Carbon\Carbon::parse($recruitment->date_applied)->isoFormat('D MMMM YYYY, HH:mm') : '-' }}
                                        </p>
                                    </div>
                                    <div class="mt-3 sm:mt-0">
                                        @if($recruitment->status == 'accepted')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-600/30 text-green-200 ring-1 ring-inset ring-green-500/40">
                                                <i class="bi bi-check-circle-fill mr-1.5"></i>Diterima
                                            </span>
                                        @elseif($recruitment->status == 'rejected')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-red-600/30 text-red-200 ring-1 ring-inset ring-red-500/40">
                                                <i class="bi bi-x-circle-fill mr-1.5"></i>Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-600/30 text-yellow-200 ring-1 ring-inset ring-yellow-500/40">
                                                <i class="bi bi-hourglass-split mr-1.5"></i>Pending
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <p class="text-sm font-medium text-slate-400 mb-1">Motivasi Pendaftar:</p>
                                    <p class="text-sm text-slate-200 leading-relaxed whitespace-pre-line line-clamp-3">{{ $recruitment->motivation ?? '-' }}</p>
                                </div>
                                
                                @if(isset($recruitment->admin_notes) && !empty($recruitment->admin_notes))
                                <div class="mb-4 p-3 bg-slate-700/30 rounded-lg border border-slate-600/50">
                                    <p class="text-sm font-medium text-slate-400 mb-1">Catatan Anda (EO/Admin):</p>
                                    <p class="text-sm text-slate-300 italic whitespace-pre-line line-clamp-2">{{ $recruitment->admin_notes }}</p>
                                </div>
                                @endif

                                {{-- Tombol Aksi Tambahan untuk EO --}}
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <a href="{{ route('eo.recruitment.show', $recruitment->recruitment_id) }}" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-sky-600/80 hover:bg-sky-700/90 text-white">
                                        <i class="bi bi-eye-fill mr-1.5"></i> Lihat Detail
                                    </a>
                                    {{-- Tombol Edit mungkin hanya relevan jika ada data pendaftaran lain yang bisa diubah selain status/catatan --}}
                                    {{-- <a href="{{ route('eo.recruitment.edit', $recruitment->recruitment_id) }}" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-amber-500/80 hover:bg-amber-600/90 text-slate-900">
                                        <i class="bi bi-pencil-square mr-1.5"></i> Edit Data
                                    </a> --}}
                                    <form action="{{ route('eo.recruitment.destroy', $recruitment->recruitment_id) }}" method="POST" class="contents" onsubmit="return confirm('Anda yakin ingin menghapus data pendaftaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-sm hover:shadow-md bg-rose-600/80 hover:bg-rose-700/90 text-white">
                                            <i class="bi bi-trash3-fill mr-1.5"></i> Hapus Data
                                        </button>
                                    </form>
                                </div>


                                @if($recruitment->status == 'pending')
                                    <form action="{{ route('eo.recruitment.update', $recruitment->recruitment_id) }}" method="POST" class="mt-4 pt-4 border-t border-slate-700/50 space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
                                            <div class="sm:col-span-4">
                                                <label for="status-{{$recruitment->recruitment_id}}" class="block text-xs font-medium text-slate-400 mb-1">Ubah Status:</label>
                                                <select name="status" id="status-{{$recruitment->recruitment_id}}" class="form-select block w-full bg-slate-700/60 border-slate-600 text-slate-200 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-3 py-2" required>
                                                    <option value="" disabled selected class="text-slate-500 bg-slate-800">-- Pilih Aksi --</option>
                                                    <option value="accepted" class="bg-slate-800">Terima</option>
                                                    <option value="rejected" class="bg-slate-800">Tolak</option>
                                                </select>
                                            </div>
                                            <div class="sm:col-span-5">
                                                 <label for="admin_notes-{{$recruitment->recruitment_id}}" class="block text-xs font-medium text-slate-400 mb-1">Catatan (Opsional):</label>
                                                <input type="text" name="admin_notes" id="admin_notes-{{$recruitment->recruitment_id}}" class="form-input block w-full bg-slate-700/60 border-slate-600 placeholder-slate-400/70 text-slate-100 focus:border-sky-500 focus:ring-1 focus:ring-sky-500 rounded-lg shadow-sm text-sm px-3 py-2" placeholder="Tambahkan catatan...">
                                            </div>
                                            <div class="sm:col-span-3">
                                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-sky-500 to-cyan-600 text-white rounded-xl hover:from-sky-600 hover:to-cyan-700 transition-all duration-200 transform hover:scale-105 shadow-lg font-semibold text-xs">
                                                    <i class="bi bi-check-lg mr-1.5"></i>Simpan Status
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($recruitments instanceof \Illuminate\Pagination\AbstractPaginator && $recruitments->hasPages())
                    <div class="mt-10">
                        {{ $recruitments->links() }} 
                    </div>
                @endif
            @endif
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
