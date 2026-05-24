@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Event</h2>
        <p class="text-gray-500">Ubah informasi pada form di bawah untuk memperbarui data event.</p>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
        {{-- Form action diarahkan ke route update dengan membawa ID event --}}
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- WAJIB: Laravel butuh ini untuk mengenali request Update --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nama Event --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Event</label>
                    <input type="text" name="name" value="{{ $event->name }}" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" required 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Tiket (Rp)</label>
                    <input type="number" name="price" value="{{ $event->price }}" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Event</label>
                    {{-- Format tanggal disesuaikan agar terbaca oleh input datetime-local --}}
                    <input type="datetime-local" name="date" value="{{ date('Y-m-d\TH:i', strtotime($event->date)) }}" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>

                {{-- Kapasitas --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kuota Tiket</label>
                    <input type="number" name="capacity" value="{{ $event->capacity }}" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>

                {{-- Lokasi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                    <input type="text" name="location" value="{{ $event->location }}" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" 
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">{{ $event->description }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    Update Event
                </button>
                <a href="{{ route('events.index') }}" class="bg-gray-100 text-gray-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection