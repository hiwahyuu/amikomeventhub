@extends('layouts.admin')

@section('page_title', 'Edit Kategori')

@section('content')
<div class="p-6 max-w-lg">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Kategori</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                Update Kategori
            </button>
        </form>
    </div>

</div>
@endsection