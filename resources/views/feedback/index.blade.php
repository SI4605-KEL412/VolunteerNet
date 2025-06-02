<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Font Awesome untuk rating bintang --}}
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
        ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #2563eb; }
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 sm:mb-0">Daftar Feedback</h1>
                <a href="{{ route('feedback.create') }}" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200 transform hover:scale-105 shadow-xl inline-flex items-center space-x-2">
                    <i class="bi bi-plus-circle-fill text-xl"></i>
                    <span class="font-semibold">Buat Feedback Baru</span>
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-6 shadow-md animate-fade-in" role="alert">
                    <i class="bi bi-check-circle-fill mr-2"></i>{{ session('success') }}
                </div>
            @endif

            <div class="bg-white/10 backdrop-blur-md shadow-2xl rounded-2xl border border-slate-700/50">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-800/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Event</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">User</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Rating</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Komentar</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/60">
                            @forelse($feedbacks as $feedback)
                            <tr class="hover:bg-slate-700/40 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $feedback->event_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-200 font-medium">{{ $feedback->event->title ?? 'Event #' . $feedback->event_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-300">{{ $feedback->user->name ?? 'User #' . $feedback->user_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $feedback->rating ? ' text-yellow-400' : ' text-slate-600' }}"></i>
                                    @endfor
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-300 max-w-xs truncate hover:whitespace-normal">{{ $feedback->comments }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">{{ \Carbon\Carbon::parse($feedback->date_given)->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm space-x-2">
                                    @if($feedback->feedback_id)
                                        <a href="{{ route('feedback.show', $feedback->feedback_id) }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors shadow-md hover:shadow-lg">
                                            <i class="bi bi-eye-fill mr-1.5"></i>Lihat
                                        </a>
                                        <a href="{{ route('feedback.edit', $feedback->feedback_id) }}" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-slate-900 px-3 py-1.5 rounded-lg text-xs font-medium transition-colors shadow-md hover:shadow-lg">
                                            <i class="bi bi-pencil-fill mr-1.5"></i>Edit
                                        </a>
                                        <form action="{{ route('feedback.destroy', $feedback->feedback_id) }}" method="POST" class="inline-block align-middle" onsubmit="return confirm('Anda yakin ingin menghapus feedback ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors shadow-md hover:shadow-lg">
                                                <i class="bi bi-trash3-fill mr-1.5"></i>Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-slate-500 italic">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="bi bi-chat-square-quote text-5xl text-slate-500 mb-3"></i>
                                        <p class="font-semibold text-lg">Belum ada data feedback.</p>
                                        <p class="text-sm">Berikan feedback pertama Anda sekarang!</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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