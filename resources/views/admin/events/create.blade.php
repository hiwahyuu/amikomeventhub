@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-800">Tambah Event Baru</h1>
        <p class="text-slate-500 font-medium">Isi detail acara AmikomEventHub kamu di bawah ini.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Nama Event --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Nama Event</label>
                    <input type="text" name="name" required placeholder="Contoh: Konser Amal Amikom"
                           class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Kategori</label>
                    <select name="category_id" required 
                            class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50 font-semibold text-slate-600">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Harga Tiket (Rp)</label>
                    <input type="number" name="price" required placeholder="0 untuk gratis"
                           class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Tanggal Pelaksanaan</label>
                    <input type="datetime-local" name="date" required 
                           class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
                </div>

                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Kuota Peserta</label>
                    <input type="number" name="capacity" required placeholder="Contoh: 100"
                           class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
                </div>

                {{-- Lokasi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Lokasi Event</label>
                    <input type="text" name="location" required placeholder="Contoh: Cinema Amikom / Zoom Meeting"
                           class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
                </div>

                {{-- Poster --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Upload Poster Event</label>
                    <input type="file" name="poster" class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition">
                </div>
            </div>

            <div class="mt-12 flex gap-4">
                <button type="submit" class="px-10 py-4 bg-indigo-600 text-white rounded-2xl font-black shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
                    Simpan & Publikasikan
                </button>
                <a href="{{ route('events.index') }}" class="px-10 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold hover:bg-slate-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection