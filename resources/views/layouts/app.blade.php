<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AmikomEventHub - Temukan Event Seru!')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

    <!-- Navigation -->
    <nav class="glass sticky top-8 z-40 mx-4 mt-4 px-6 py-4 rounded-2xl border border-white/20 shadow-lg flex justify-between items-center">
        <div class="flex items-center gap-2">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">AH</div>
                <span class="text-xl font-bold tracking-tight">AmikomEventHub</span>
            </a>
        </div>
        <div class="hidden md:flex gap-8 font-medium">
            <a href="{{ route('home') }}" class="text-indigo-600">Jelajahi</a>
            {{-- Menu Kategori dihapus agar tampilan lebih bersih --}}
            <a href="#" class="hover:text-indigo-600 transition">Tentang Kami</a>
        </div>
    </nav>

    {{-- Hero Section & Events Grid — hanya tampil di homepage --}}
    @hasSection('is_home')

        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1 space-y-8">
                <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1 Event Platform</span>
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                    Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
                </h1>
                <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
                    Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan Midtrans.
                </p>
                <div class="flex gap-4">
                    <a href="#events" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                        Mulai Jelajah
                    </a>
                    <a href="#" class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                        Cara Pesan
                    </a>
                </div>
            </div>
            <div class="flex-1 relative">
                <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
                <img src="assets/concert.png" alt="Concert" class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">
                <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                            <p class="font-bold">Pembayaran Aman via Midtrans</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Events Grid -->
        <section id="events" class="max-w-7xl mx-auto px-6 py-20">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold mb-2">Event Mendatang</h2>
                    <p class="text-slate-500 font-medium">Jangan lewatkan kesempatan belajar dan bersenang-senang.</p>
                </div>
                <a href="#" class="text-indigo-600 font-bold">Lihat Semua Event →</a>
            </div>
            @yield('content')
        </section>

        {{-- Kategori --}}
        @isset($categories)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-2 text-center">Kategori Event</h2>
                <p class="text-center text-slate-500 mb-8">Temukan event sesuai minatmu</p>
                <div class="flex flex-wrap justify-center gap-3">
                    @forelse($categories as $category)
                        <span class="bg-indigo-100 text-indigo-700 px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-indigo-200 transition cursor-pointer">
                            {{ $category->name }}
                        </span>
                    @empty
                        <p class="text-gray-400 text-sm">Belum ada kategori.</p>
                    @endforelse
                </div>
            </div>
        </section>
        @endisset

        {{-- Partner --}}
        @isset($partners)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-2 text-center">Partner Kami</h2>
                <p class="text-center text-slate-500 mb-10">Didukung oleh berbagai partner terpercaya</p>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @forelse($partners as $partner)
                        <div class="flex flex-col items-center justify-center p-6 border border-gray-100 rounded-2xl hover:shadow-lg transition">
                            @if($partner->logo_url ?? false)
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-12 object-contain mb-3">
                            @else
                                <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center mb-3">
                                    <span class="text-indigo-600 font-bold text-xl">{{ substr($partner->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <span class="text-sm text-gray-600 text-center font-semibold">{{ $partner->name }}</span>
                        </div>
                    @empty
                        <p class="col-span-5 text-center text-gray-400 text-sm">Belum ada partner.</p>
                    @endforelse
                </div>
            </div>
        </section>
        @endisset

    @else
        {{-- Halaman selain homepage (detail event, checkout, dll) --}}
        @yield('content')
    @endif

    <!-- Footer -->
    <footer class="bg-indigo-900 text-indigo-100 py-20 px-6 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4 col-span-2">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">AH</div>
                    <span class="text-2xl font-bold text-white">AmikomEventHub</span>
                </div>
                <p class="max-w-xs text-indigo-300">Platform reservasi tiket event online terbaik untuk mahasiswa dan penyelenggara profesional.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                    <li><a href="#" class="hover:text-white transition">Semua Event</a></li>
                    <li><a href="#" class="hover:text-white transition">Cara Bayar</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li>support@eventtiket.com</li>
                    <li>+62 812 3456 7890</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-indigo-800 text-center text-indigo-400 text-sm">
            &copy; 2024 AmikomEventHub. Built with Laravel & Tailwind CSS.
        </div>
    </footer>

</body>
</html>