<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-indigo-900 text-white flex flex-col py-8 px-4 fixed h-full shadow-xl">
        <div class="text-center mb-10">
            <h1 class="text-xl font-bold">🎫 EventHub</h1>
            <p class="text-indigo-300 text-xs mt-1">Admin Panel</p>
        </div>

        <nav class="flex flex-col gap-2">
            <a href="/admin"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                📊 Dashboard
            </a>
            <a href="/admin/events"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                📅 Manajemen Event
            </a>
            <a href="/admin/transactions"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                💳 Transaksi
            </a>
            <a href="/admin/categories"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                🏷️ Kategori
            </a>
        </nav>

        <div class="mt-auto">
            <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-indigo-700 transition text-sm text-indigo-300">
                ← Kembali ke Situs
            </a>
        </div>
    </aside>

    {{-- ===== AREA KONTEN UTAMA ===== --}}
    <div class="ml-64 flex-1 flex flex-col">

        {{-- Top Bar --}}
        <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700">@yield('page-title', 'Dashboard')</h2>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Admin</span>
                <div class="w-9 h-9 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm">A</div>
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