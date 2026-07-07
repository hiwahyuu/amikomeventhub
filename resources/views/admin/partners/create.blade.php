@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.partners.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center gap-1 mb-2">
        &larr; Kembali
    </a>
    <h2 class="text-2xl font-bold text-gray-800">Tambah Partner</h2>
</div>

<div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 max-w-2xl">
    {{-- Jangan lupa enctype="multipart/form-data" wajib ada untuk upload file --}}
    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Partner</label>
            <input type="text" name="name" required placeholder="Contoh: Tokopedia, Gojek"
                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
        </div>

        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Logo Partner</label>
            
            {{-- Area Drag & Drop --}}
            <div id="dropzone" class="w-full relative border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 hover:bg-indigo-50 hover:border-indigo-400 transition duration-300 flex flex-col items-center justify-center min-h-[200px]">
                
                {{-- Input file disembunyikan tapi direntangkan memenuhi area dropzone --}}
                <input type="file" name="logo" id="file-upload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" required>
                
                {{-- Tampilan saat belum ada gambar (Ikon & Teks) --}}
                <div id="upload-ui" class="space-y-3 pointer-events-none">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="text-sm text-gray-600">
                        <span class="font-bold text-indigo-600">Klik untuk pilih</span> atau seret file ke sini
                    </div>
                    <p class="text-xs text-gray-400 font-medium">Format: PNG, JPG, JPEG (Maks 2MB)</p>
                </div>

                {{-- Tempat Preview Gambar --}}
                <img id="image-preview" src="" alt="Preview Logo" class="hidden max-h-40 rounded-xl object-contain z-10 pointer-events-none shadow-sm">
            </div>
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition w-full sm:w-auto">
            Simpan Partner
        </button>
    </form>
</div>

{{-- Script Javascript untuk fitur Drag & Drop --}}
<script>
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('file-upload');
    const uploadUI = document.getElementById('upload-ui');
    const imagePreview = document.getElementById('image-preview');

    // 1. Efek styling saat file melayang di atas zona (Drag Over)
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-indigo-500', 'bg-indigo-100');
    });

    // 2. Hilangkan efek saat file keluar dari zona (Drag Leave)
    dropzone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-indigo-500', 'bg-indigo-100');
    });

    // 3. Saat file dilepas/dijatuhkan ke zona (Drop)
    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-indigo-500', 'bg-indigo-100');
        
        // Masukkan file yang di-drop ke dalam input file hidden
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            showPreview(fileInput.files[0]);
        }
    });

    // 4. Saat file dipilih lewat klik tombol "Choose File"
    fileInput.addEventListener('change', function() {
        if (this.files.length) {
            showPreview(this.files[0]);
        }
    });

    // Fungsi utama untuk memunculkan gambar preview
    function showPreview(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden'); // Munculkan gambar
                uploadUI.classList.add('hidden');        // Sembunyikan ikon upload
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection