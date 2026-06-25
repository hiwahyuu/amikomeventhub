@extends('layouts.app')

@section('title', $event->name . ' - AmikomEventHub')

@section('content')

<main class="max-w-4xl mx-auto px-6 py-20">

    {{-- Tombol Kembali --}}
    <a href="{{ route('home') }}"
        class="text-indigo-600 font-bold flex items-center gap-2 mb-8">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Beranda
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- Poster Event --}}
        <div>
            <img src="{{ ($event->poster_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($event->poster_path))
                ? asset('storage/' . $event->poster_path)
                : 'https://placehold.co/600x400' }}"
                alt="{{ $event->name }}"
                class="w-full rounded-3xl object-cover shadow-lg">
        </div>

        {{-- Detail Event --}}
        <div class="flex flex-col justify-between">
            <div>
                {{-- Kategori --}}
                <span class="text-xs font-black uppercase tracking-widest text-indigo-500 bg-indigo-50 px-3 py-1 rounded-full">
                    {{ $event->category->name ?? 'Uncategorized' }}
                </span>

                {{-- Nama Event --}}
                <h1 class="text-3xl font-extrabold mt-4 mb-3">{{ $event->name }}</h1>

                {{-- Deskripsi --}}
                <p class="text-slate-500 leading-relaxed">{{ $event->description }}</p>

                {{-- Info Event --}}
                <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-3 text-slate-600">
                        <span class="text-xl">📅</span>
                        <span class="font-medium">
                            {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }} WIB
                        </span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-600">
                        <span class="text-xl">📍</span>
                        <span class="font-medium">{{ $event->location }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-600">
                        <span class="text-xl">🎟️</span>
                        <span class="font-medium">
                            Sisa tiket: {{ $event->capacity - $event->sold }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Harga & Tombol Beli --}}
            <div class="mt-8 p-6 bg-indigo-50 rounded-2xl">
                <p class="text-sm text-slate-500 uppercase font-bold tracking-wide">Harga Tiket</p>
                <p class="text-3xl font-black text-indigo-600 mt-1">
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                </p>

                @if(($event->capacity - $event->sold) > 0)
                    <a href="{{ route('checkout.create', $event->id) }}"
                        class="mt-4 block w-full text-center py-4 bg-indigo-600 text-white rounded-2xl font-black text-lg shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                        🎟️ Beli Tiket Sekarang
                    </a>
                @else
                    <button disabled
                        class="mt-4 block w-full text-center py-4 bg-slate-300 text-slate-500 rounded-2xl font-black text-lg cursor-not-allowed">
                        Tiket Habis
                    </button>
                @endif
            </div>
        </div>

    </div>

</main>

@endsection