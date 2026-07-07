<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="flex min-h-screen">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-56 bg-indigo-900 text-white flex flex-col py-8 px-4 fixed h-full shadow-xl">
        
        {{-- Logo --}}
        <div class="flex items-center gap-3 mb-8 px-2">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                <span class="text-indigo-900 font-black text-sm">AH</span>
            </div>
            <div>
                <h1 class="text-sm font-bold leading-tight">AmikomEventHub</h1>
            </div>
        </div>

        <p class="text-indigo-400 text-xs font-semibold uppercase tracking-widest px-2 mb-3">Main Menu</p>

        <nav class="flex flex-col gap-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition text-sm font-medium
               {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.events.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition text-sm font-medium
               {{ request()->routeIs('admin.events.*') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Kelola Event
            </a>
            <a href="{{ route('admin.partners.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition text-sm font-medium
               {{ request()->routeIs('admin.partners.*') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Kelola Partner
            </a>
            <a href="{{ route('admin.transactions.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition text-sm font-medium
               {{ request()->routeIs('admin.transactions.*') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:bg-indigo-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Laporan Transaksi
            </a>
        </nav>

        <div class="mt-auto">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 text-indigo-300 hover:text-white transition text-sm font-medium text-left rounded-lg hover:bg-indigo-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== AREA KONTEN UTAMA ===== --}}
    <div class="ml-56 flex-1 flex flex-col">

        {{-- Top Bar --}}
        <header class="bg-white border-b border-gray-100 px-8 py-4 flex items-center justify-end">
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin Amikom' }}</p>
                    <p class="text-xs text-gray-400">Penyelenggara Utama</p>
                </div>
                {{-- PERUBAHAN: Ikon Avatar diubah agar latar putih, teks biru, dan border biru mirip gambar kedua --}}
                <div class="w-9 h-9 bg-white border border-indigo-600 rounded-full flex items-center justify-center text-indigo-700 font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                </div>
            </div>
        </header>

        {{-- Konten --}}
        <main class="p-8 flex-1">
            @yield('content')
        </main>

    </div>
</div>

</body>
</html>