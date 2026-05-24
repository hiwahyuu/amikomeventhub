@extends('layouts.admin')

@section('page_title', 'Manajemen Partner')

@section('content')
<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Partner</h1>
        <a href="{{ route('admin.partners.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Tambah Partner
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Search --}}
    <form method="GET" action="{{ route('admin.partners.index') }}" class="mb-4">
        <div class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari nama partner..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-72 focus:outline-none focus:ring-2 focus:ring-indigo-400"
            >
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm transition">
                Cari
            </button>
            @if($search)
                <a href="{{ route('admin.partners.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Tabel --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Logo</th>
                    <th class="px-4 py-3 text-left">Nama Partner</th>
                    <th class="px-4 py-3 text-left">Dibuat</th>
                    <th class="px-4 py-3 text-left">Diperbarui</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-500">{{ $partner->id }}</td>
                    <td class="px-4 py-3">
                        @if($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                 class="w-10 h-10 object-contain rounded">
                        @else
                            <span class="text-gray-300 text-xs">No logo</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $partner->name }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $partner->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $partner->updated_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.partners.edit', $partner) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus partner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-400">
                        {{ $search ? 'Tidak ada hasil untuk "' . $search . '"' : 'Belum ada partner.' }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $partners->appends(['search' => $search])->links() }}
    </div>

</div>
@endsection