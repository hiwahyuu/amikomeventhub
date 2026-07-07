@extends('layouts.app')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<div class="relative bg-white pt-16 pb-20 lg:pt-24 lg:pb-28 overflow-hidden">
    <div class="container mx-auto px-6 max-w-7xl relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
            
            {{-- Bagian Kiri (Teks) --}}
            <div class="max-w-2xl">
                <span class="inline-block py-1.5 px-4 rounded-full bg-indigo-50 text-indigo-600 text-xs font-bold tracking-wider mb-6 uppercase">
                    #1 Event Platform
                </span>
                
                <h1 class="text-5xl lg:text-6xl font-black text-slate-800 leading-[1.1] mb-6 tracking-tight">
                    Temukan & <br>
                    Pesan <br>
                    <span class="text-indigo-600">Tiket Event</span> <br>
                    Impianmu.
                </h1>
                
                <p class="text-slate-500 text-lg mb-10 leading-relaxed max-w-lg">
                    Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan Midtrans.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#events" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:-translate-y-1 hover:shadow-xl hover:bg-indigo-700 transition-all text-center">
                        Mulai Jelajah
                    </a>
                    <a href="#" class="bg-white text-slate-700 border border-slate-200 px-8 py-4 rounded-2xl font-bold hover:bg-slate-50 hover:-translate-y-1 transition-all text-center">
                        Cara Pesan
                    </a>
                </div>
            </div>

            {{-- Bagian Kanan (Gambar Hero) --}}
            <div class="relative lg:ml-auto w-full max-w-md mx-auto lg:mx-0 mt-12 lg:mt-0">
                
                {{-- PERBAIKAN: Memanggil langsung dari variabel $heroEvent yang kebal filter --}}
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl aspect-[4/5] transform lg:rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img src="{{ $heroEvent ? asset('storage/' . $heroEvent->poster_path) : 'https://placehold.co/600x800' }}" 
                         alt="Hero Event" 
                         class="w-full h-full object-cover">
                </div>

                {{-- Floating Badge Trust --}}
                <div class="absolute -bottom-6 -left-6 sm:-left-12 bg-white p-5 rounded-2xl shadow-xl border border-slate-50 flex items-center gap-4 z-20 hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Terverifikasi</p>
                        <p class="font-bold text-slate-800 text-sm sm:text-base">Pembayaran Aman via Midtrans</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ===== SECTION KATEGORI ===== --}}
<section class="py-16 bg-white border-t border-slate-50">
    <div class="container mx-auto px-6 max-w-7xl text-center">
        <h2 class="text-3xl font-bold text-slate-800 mb-2">Jelajahi Kategori</h2>
        <p class="text-slate-500 text-sm mb-10">Temukan event yang paling sesuai dengan minat dan passion-mu.</p>
        
        <div class="flex flex-wrap justify-center gap-3 md:gap-4">
            {{-- Tombol SEMUA --}}
            <a href="{{ url('/') }}#events" 
               class="{{ $activeCategory == 'all' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-white text-slate-600 border border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }} px-6 py-2.5 rounded-full text-sm font-bold hover:-translate-y-1 transition-all">
                Semua
            </a>
            
            {{-- Tombol Filter dari Database --}}
            @foreach($categories as $category)
                <a href="{{ url('/?category=' . $category->id) }}#events" 
                   class="{{ $activeCategory == $category->id ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-white text-slate-600 border border-slate-200 hover:border-indigo-600 hover:text-indigo-600' }} px-6 py-2.5 rounded-full text-sm font-bold hover:-translate-y-1 transition-all">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== SECTION EVENT TERDEKAT ===== --}}
<section id="events" class="py-16 bg-slate-50">
    <div class="container mx-auto px-6 max-w-7xl">
        
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-slate-800 mb-2">
                {{ $activeCategory == 'all' ? 'Event Terdekat' : 'Hasil Pencarian' }}
            </h2>
            <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($events as $event)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col overflow-hidden group">
                
                <div class="relative h-64 overflow-hidden bg-slate-100">
                    <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path) : 'https://placehold.co/400x300' }}" 
                         alt="{{ $event->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    
                    <div class="absolute top-5 left-5">
                        <span class="px-4 py-1.5 bg-white/95 backdrop-blur-sm rounded-full text-[10px] font-black uppercase tracking-widest text-indigo-600 shadow-sm">
                            {{ $event->category->name ?? 'Umum' }}
                        </span>
                    </div>
                </div>

                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-slate-800 mb-3 leading-snug group-hover:text-indigo-600 transition-colors line-clamp-2">
                        {{ $event->name }}
                    </h3>
                    
                    <div class="flex items-center gap-2 text-slate-400 text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ date('d F Y', strtotime($event->date)) }}
                    </div>

                    <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div>
                            <p class="text-xl md:text-2xl font-black text-indigo-600">
                                {{ $event->price == 0 ? 'FREE' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <a href="{{ route('events.show', $event->id) }}" class="px-5 py-2.5 bg-indigo-50 text-indigo-600 rounded-xl text-sm font-bold hover:bg-indigo-600 hover:text-white transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>

            </div>
            @empty
            <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-100">
                <div class="inline-flex p-4 bg-slate-50 rounded-full mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Belum Ada Event</h3>
                <p class="text-slate-500 text-sm">Stay tuned! Event seru akan segera hadir.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== SECTION PARTNER ===== --}}
<section class="py-16 bg-white mb-10">
    <div class="container mx-auto px-6 max-w-7xl">
        <h2 class="text-3xl font-bold text-slate-800 mb-2 text-center">Partner Kami</h2>
        <p class="text-center text-slate-500 text-sm mb-12">Didukung oleh berbagai partner terpercaya</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse($partners ?? [] as $partner)
                <div class="flex flex-col items-center justify-center p-6 bg-white border border-slate-100 rounded-3xl hover:shadow-xl hover:border-indigo-100 hover:-translate-y-2 transition-all duration-500 group cursor-pointer">
                    @if($partner->logo_url)
                        <div class="w-24 h-24 rounded-full overflow-hidden mb-5 shadow-sm border-2 border-slate-50 group-hover:border-indigo-100 group-hover:shadow-indigo-100/50 transition-all duration-500">
                            <img src="{{ asset('storage/' . $partner->logo_url) }}" alt="{{ $partner->name }}"
                                 class="w-full h-full object-cover grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500">
                        </div>
                    @else
                        <div class="w-24 h-24 bg-slate-50 group-hover:bg-indigo-50 rounded-full flex items-center justify-center mb-5 border-2 border-slate-50 group-hover:border-indigo-100 transition-all duration-500">
                            <span class="text-slate-400 group-hover:text-indigo-600 font-black text-3xl transition-colors duration-500">{{ substr($partner->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <span class="text-sm text-slate-500 group-hover:text-indigo-700 text-center font-bold transition-colors duration-500">{{ $partner->name }}</span>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 text-sm">Belum ada partner.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection 