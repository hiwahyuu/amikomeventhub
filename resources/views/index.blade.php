<!-- @extends('layouts.admin') 

@section('page-title', 'Manajemen Kategori')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-700">Daftar Kategori Event</h2>
    <a href="#"
       class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-indigo-700 transition shadow">
        + Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr class="text-left text-gray-500 border-b">
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Nama Kategori</th>
                <th class="px-6 py-4">Jumlah Event</th>
                <th class="px-6 py-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach([
                ['Seminar', 8, 'indigo'],
                ['Konser', 5, 'pink'],
                ['Workshop', 6, 'green'],
                ['Webinar', 4, 'blue'],
                ['Pameran', 1, 'orange'],
            ] as $i => $kategori)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-gray-400">{{ $i + 1 }}</td>
                <td class="px-6 py-4">
                    <span class="bg-{{ $kategori[2] }}-100 text-{{ $kategori[2] }}-700 px-3 py-1 rounded-full text-xs font-medium">
                        {{ $kategori[0] }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $kategori[1] }} event</td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="#" class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-xs font-medium hover:bg-blue-200 transition">Edit</a>
                        <a href="#" class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-xs font-medium hover:bg-red-200 transition">Hapus</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection