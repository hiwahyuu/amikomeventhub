@extends('layouts.app')

@section('content')
{{-- Hero Section --}}
<div class="relative bg-indigo-900 py-20 mb-16 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
        </svg>
    </div>
    <div class="container mx-auto px-6 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-black text-white mb-4 tracking-tight">
            Temukan Event Seru di <span class="text-indigo-400">Amikom</span>
        </h1>
        <p class="text-indigo-100 text-lg md:text-xl max-w-2xl mx-auto font-medium">
            Platform nomor satu untuk mencari workshop, konser, dan seminar terbaik di sekitar kampus.
        </p>
    </div>
</div>

<div class="container mx-auto px-6 pb-20">
    {{-- Section Title --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Event Mendatang</h2>
            <p class="text-slate-500 font-medium">Jangan lewatkan kesempatan belajar dan bersenang-senang.</p>
        </div>
        <a href="#" class="hidden md:block text-indigo-600 font-bold hover:underline">Lihat Semua Event →</a>
    </div>

    {{-- Event Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($events as $event)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden">
            {{-- Image Header --}}
            <div class="relative overflow-hidden aspect-[4/5]">
                <img src="{{ asset('storage/' . $event->poster_path) }}" 
                     alt="{{ $event->name }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     onerror="this.src='https://via.placeholder.com/400x500?text=Event+Amikom'">
                
                {{-- Category Badge --}}
                <div class="absolute top-6 left-6">
                    <span class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-2xl text-[10px] font-black uppercase tracking-widest text-indigo-600 shadow-sm">
                        {{ $event->category->name ?? 'Umum' }}
                    </span>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-8">
                <div class="flex items-center gap-2 text-slate-400 text-xs font-bold mb-3 uppercase tracking-wider">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    {{ date('d M Y', strtotime($event->date)) }}
                </div>
                
                <h3 class="text-2xl font-black text-slate-800 mb-4 leading-tight group-hover:text-indigo-600 transition">
                    {{ $event->name }}
                </h3>

                <div class="flex items-center gap-2 text-slate-500 text-sm mb-8 font-medium">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ $event->location }}
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-slate-50">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Harga Tiket</p>
                        <p class="text-2xl font-black text-indigo-600">
                            {{ $event->price == 0 ? 'FREE' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <a href="{{ route('events.show', $event->id) }}"
                        class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center hover:bg-indigo-600 transition-colors shadow-lg shadow-slate-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @empty
        {{-- Jika Tidak Ada Data --}}
        <div class="col-span-full py-20 text-center">
            <div class="inline-flex p-6 bg-slate-100 rounded-full mb-4">
                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800">Belum Ada Event</h3>
            <p class="text-slate-500">Stay tuned! Event seru akan segera hadir di sini.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- ===== SECTION KATEGORI ===== --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Kategori Event</h2>
        <div class="flex flex-wrap justify-center gap-3">
            @forelse($categories as $category)
                <span class="bg-indigo-100 text-indigo-700 px-5 py-2 rounded-full text-sm font-medium">
                    {{ $category->name }}
                </span>
            @empty
                <p class="text-gray-400 text-sm">Belum ada kategori.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== SECTION PARTNER ===== --}}
<section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Partner Kami</h2>
        <p class="text-center text-gray-500 text-sm mb-8">Didukung oleh berbagai partner terpercaya</p>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @forelse($partners as $partner)
                <div class="flex flex-col items-center justify-center p-4 border border-gray-100 rounded-xl hover:shadow-md transition">
                    @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                             class="h-12 object-contain mb-2">
                    @else
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-2">
                            <span class="text-indigo-600 font-bold text-lg">{{ substr($partner->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <span class="text-xs text-gray-600 text-center font-medium">{{ $partner->name }}</span>
                </div>
            @empty
                <p class="col-span-5 text-center text-gray-400 text-sm">Belum ada partner.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection