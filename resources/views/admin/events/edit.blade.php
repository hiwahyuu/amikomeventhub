@extends('layouts.admin')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Event</h2>
        <p class="text-gray-500">Ubah informasi pada form di bawah untuk memperbarui data event.</p>
    </div>

    {{-- Alarm Penampil Error Upload --}}
    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Gagal menyimpan data!</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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

                {{-- Poster --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Poster Event</label>
                    
                    {{-- Preview poster saat ini --}}
                    @if($event->poster_path)
                    <div class="mb-3">
                        <p class="text-xs text-gray-400 mb-2">Poster saat ini:</p>
                        <img id="preview" src="{{ asset('storage/' . $event->poster_path) }}" 
                             alt="Poster" class="w-40 h-52 object-cover rounded-xl border border-gray-200">
                    </div>
                    @else
                    <div class="mb-3">
                        <img id="preview" src="" alt="" class="hidden w-40 h-52 object-cover rounded-xl border border-gray-200">
                    </div>
                    @endif

                    <input type="file" name="image" accept="image/*" id="imageInput"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti poster. Format: JPG, PNG (maks. 2MB)</p>
                </div>

            </div>

            <div class="mt-8 flex gap-3">
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    Update Event
                </button>
                <a href="{{ route('admin.events.index') }}" class="bg-gray-100 text-gray-600 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Preview gambar sebelum upload
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
});
</script>

@endsection