@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10 md:py-16">
    <div class="container mx-auto px-4 max-w-6xl">
        
        {{-- Tombol Kembali --}}
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-indigo-600 font-medium hover:text-indigo-800 transition-colors mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Beranda
        </a>

        <div class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-sm border border-slate-100">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-14">

                {{-- ===== KOLOM KIRI (Poster & Penyelenggara) ===== --}}
                <div class="lg:col-span-5">
                    {{-- Poster Event --}}
                    <div class="rounded-[2rem] p-3 border border-slate-100 bg-white shadow-2xl shadow-slate-200/50 mb-8">
                        <img src="{{ asset('storage/' . $event->poster_path) }}" 
                             alt="{{ $event->name }}" 
                             class="w-full h-auto rounded-3xl object-cover aspect-[4/5]"
                             onerror="this.src='https://via.placeholder.com/400x500?text=Event+Amikom'">
                    </div>

                    {{-- Card Penyelenggara --}}
                    <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100">
                        <h4 class="text-sm font-bold text-slate-800 mb-4">Penyelenggara</h4>
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-black text-xl shadow-inner">
                                AH
                            </div>
                            <div>
                                <p class="font-bold text-slate-800 text-lg">Amikom Event Hub</p>
                                <p class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Verified Organizer
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== KOLOM KANAN (Detail & Pembayaran) ===== --}}
                <div class="lg:col-span-7 flex flex-col justify-center">
                    
                    {{-- Badge Kategori --}}
                    <div class="mb-4">
                        <span class="inline-block px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">
                            {{ $event->category->name ?? 'UMUM' }}
                        </span>
                    </div>

                    {{-- Judul Event --}}
                    <h1 class="text-4xl md:text-5xl font-black text-slate-800 uppercase leading-tight mb-6">
                        {{ $event->name }}
                    </h1>

                    {{-- Waktu & Lokasi --}}
                    <div class="flex flex-wrap gap-6 text-slate-500 font-medium mb-10">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ date('l, d M Y', strtotime($event->date)) }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $event->location }}
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-10">
                        <h3 class="text-xl font-bold text-slate-800 mb-4">Deskripsi Event</h3>
                        <div class="text-slate-600 leading-relaxed">
                            {{ $event->description ?? 'Deskripsi event belum tersedia.' }}
                        </div>
                    </div>

                    {{-- Card Harga & Tombol Pesan (Desain Baru) --}}
                    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-3xl p-8 md:p-10 text-white shadow-2xl shadow-indigo-200 flex flex-col md:flex-row items-start md:items-center justify-between mb-10 relative overflow-hidden">
                        {{-- Hiasan Background Abstrak --}}
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-5"></div>
                        <div class="absolute bottom-0 right-1/2 w-40 h-40 rounded-full bg-white opacity-5"></div>

                        <div class="relative z-10">
                            <p class="text-indigo-100 text-xs font-bold uppercase tracking-wider mb-2">Harga Tiket</p>
                            <div class="mb-3">
                                <span class="text-4xl md:text-5xl font-black">
                                    {{ $event->price == 0 ? 'FREE' : 'Rp ' . number_format($event->price, 0, ',', '.') }}
                                </span>
                                <span class="text-lg font-medium text-indigo-100">/ orang</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-indigo-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Sisa stok: <span class="font-bold underline text-white">{{ $event->capacity }} Tiket lagi!</span>
                            </div>
                        </div>

                        <div class="mt-8 md:mt-0 relative z-10 w-full md:w-auto">
                            @if($event->capacity > 0)
                                <a href="{{ route('checkout.create', $event->id) }}" class="block text-center w-full md:w-auto bg-white text-indigo-600 px-10 py-4 rounded-xl font-bold hover:bg-gray-50 transition-colors shadow-lg hover:shadow-xl hover:-translate-y-1 transform duration-200">
                                    Pesan Sekarang
                                </a>
                            @else
                                <button disabled class="block text-center w-full md:w-auto bg-white/20 text-indigo-100 px-10 py-4 rounded-xl font-bold cursor-not-allowed">
                                    Tiket Habis
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Kebijakan Tiket --}}
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Kebijakan Tiket</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-slate-600 font-medium">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                E-Ticket akan dikirimkan otomatis setelah pembayaran berhasil.
                            </li>
                            <li class="flex items-start gap-3 text-slate-600 font-medium">
                                <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Tiket dapat discan di pintu masuk (Check-in).
                            </li>
                            <li class="flex items-start gap-3 text-red-500 font-medium">
                                <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Tiket yang sudah dibeli tidak dapat direfund.
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection