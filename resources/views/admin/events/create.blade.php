@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.events.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center gap-1 mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
    <h1 class="text-3xl font-black text-slate-800">Tambah Event Baru</h1>
    <p class="text-slate-500 font-medium mt-1">Isi detail acara AmikomEventHub kamu di bawah ini.</p>
</div>

<div class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-sm border border-slate-100">
    
    {{-- PERBAIKAN ROUTE ADA DI BARIS INI: action="{{ route('admin.events.store') }}" --}}
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            
            {{-- Nama Event --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-3">Nama Event</label>
                <input type="text" name="name" required placeholder="Contoh: Konser Amal Amikom"
                       class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-3">Kategori</label>
                <select name="category_id" required class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
                    <option value="">Pilih Kategori...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-3">Harga Tiket (Rp)</label>
                <input type="number" name="price" required placeholder="Contoh: 50000 (Isi 0 jika gratis)"
                       class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-3">Tanggal Event</label>
                <input type="datetime-local" name="date" required
                       class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-3">Kuota Tiket</label>
                <input type="number" name="capacity" required placeholder="Contoh: 100"
                       class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
            </div>

            {{-- Lokasi --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-3">Lokasi</label>
                <input type="text" name="location" required placeholder="Contoh: Amikom Yogyakarta"
                       class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50">
            </div>

            {{-- Deskripsi --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-3">Deskripsi</label>
                <textarea name="description" rows="4" required placeholder="Ceritakan keseruan event ini..."
                          class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50"></textarea>
            </div>

            {{-- Poster --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-3">Poster Event</label>
                <input type="file" name="image" accept="image/*" required
                       class="w-full px-5 py-4 rounded-2xl border-slate-200 border focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50/50
                              file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                <p class="text-xs text-slate-400 mt-2 font-medium">Format yang didukung: JPG, JPEG, PNG (Maksimal 2MB).</p>
            </div>

        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-indigo-200 text-center w-full sm:w-auto">
                Simpan Event
            </button>
            <a href="{{ route('admin.events.index') }}" class="bg-slate-100 text-slate-600 px-10 py-4 rounded-2xl font-bold hover:bg-slate-200 transition-colors text-center w-full sm:w-auto">
                Batal
            </a>
        </div>
        
    </form>
</div>
@endsection