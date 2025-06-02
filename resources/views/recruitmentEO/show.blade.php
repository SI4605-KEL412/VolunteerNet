@php
    // use Illuminate\Support\Str; // Tidak terlihat digunakan di sini
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Pendaftar: {{ $recruitment->user->name }} - EO Dashboard</title>
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
                require('@tailwindcss/typography'), // Untuk styling teks jika ada HTML
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
                <i class="bi bi-pers