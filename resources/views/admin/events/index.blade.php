@extends('layouts.admin')

@section('page_title', 'Kelola Event')

@section('content')
<div class="flex flex-col min-h-screen bg-slate-50">
    <main class="flex-1 p-4 md:p-10 overflow-y-auto">

        {{-- Header Section --}}
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Kelola Event</h1>
                <p class="text-slate-500 font-medium mt-1">Buat dan atur acara seru AmikomEventHub di sini.</p>
            </div>
            <a href="{{ route('admin.events.create') }}"
                class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Event Baru
            </a>
        </header>

        {{-- Table Section --}}
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-8 py-6 bg-slate-50/50 border-b flex flex-col md:flex-row gap-4">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Cari nama event..."
                        class="w-full pl-12 pr-5 py-3 rounded-2xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <select class="px-5 py-3 rounded-2xl border-slate-200 border bg-white outline-none font-semibold text-slate-600">
                    <option>Semua Kategori</option>
                </select>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4 w-16 text-center">No</th>
                            <th class="px-8 py-4">Poster</th>
                            <th class="px-8 py-4">Event & Kategori</th>
                            <th class="px-8 py-4 text-center">Harga / Kapasitas</th>
                            <th class="px-8 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        @forelse($events as $event)
                        <tr class="hover:bg-slate-50/50 transition group">
                            <td class="px-8 py-6 font-bold text-slate-400 text-center">{{ $loop->iteration }}</td>
                            <td class="px-8 py-6">
                                <div class="relative w-16 h-20 rounded-2xl overflow-hidden shadow-sm border-2 border-white transition group-hover:scale-105">
                                    <img src="{{ asset('storage/' . $event->poster_path) }}"
                                         alt="{{ $event->name }}"
                                         class="w-full h-full object-cover"
                                         onerror="this.src='https://via.placeholder.com/150?text=No+Poster'">
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-black text-slate-800 text-base">{{ $event->name }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold rounded-md uppercase tracking-wider">
                                        {{ $event->category->name ?? 'Uncategorized' }}
                                    </span>
                                    <span class="text-[10px] text-slate-400 font-bold">•</span>
                                    <span class="text-[10px] text-slate-400 font-bold">{{ date('d M Y', strtotime($event->date)) }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <p class="font-bold text-indigo-600">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                <div class="flex items-center justify-center gap-1.5 mt-1">
                                    <div class="w-16 bg-slate-100 rounded-full h-1">
                                        <div class="bg-indigo-400 h-1 rounded-full" style="width: {{ $event->capacity > 0 ? ($event->sold / $event->capacity) * 100 : 0 }}%"></div>
                                    </div>
                                    <p class="text-[10px] text-slate-400 font-bold">Stok: {{ $event->capacity - $event->sold }}/{{ $event->capacity }}</p>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('admin.events.edit', $event->id) }}"
                                        class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-3 bg-rose-50 text-rose-600 rounded-2xl hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="p-4 bg-slate-50 rounded-full mb-4 text-slate-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-bold">Belum ada data event.</p>
                                    <a href="{{ route('admin.events.create') }}" class="text-indigo-600 text-sm font-bold mt-1 hover:underline">Tambah satu sekarang →</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection