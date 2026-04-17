@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">🎫 Tiket Saya</h1>

    {{-- Kartu Tiket --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        {{-- Header Tiket --}}
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6 text-center">
            <h2 class="text-2xl font-bold">Tech Talks 2026</h2>
            <p class="text-indigo-200 text-sm mt-1">Universitas AMIKOM Yogyakarta</p>
        </div>

        {{-- Barcode Area --}}
        <div class="p-6 text-center border-b border-dashed border-gray-300">
            <div class="bg-gray-100 rounded-xl p-4 inline-block">
                <div class="text-5xl">▓▓▓▓▓▓▓</div>
                <div class="text-5xl">▓░░░░░▓</div>
                <div class="text-5xl">▓░▓▓░░▓</div>
                <div class="text-5xl">▓▓▓▓▓▓▓</div>
            </div>
            <p class="text-xs text-gray-400 mt-2 font-mono">EVH-2026-TT-001234</p>
        </div>

        {{-- Info Tiket --}}
        <div class="p-6 space-y-3">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Nama Pemesan</span>
                <span class="font-semibold text-gray-800">Mahasiswa AMIKOM</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Jenis Tiket</span>
                <span class="font-semibold text-indigo-600">Regular</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Tanggal</span>
                <span class="font-semibold text-gray-800">Senin, 20 Mei 2026</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Waktu</span>
                <span class="font-semibold text-gray-800">09.00 – 16.00 WIB</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Lokasi</span>
                <span class="font-semibold text-gray-800">Aula Utama AMIKOM</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Harga</span>
                <span class="font-bold text-green-600">Rp 75.000</span>
            </div>
        </div>

        {{-- Footer Tiket --}}
        <div class="bg-indigo-50 px-6 py-4 text-center">
            <p class="text-xs text-indigo-400">Tunjukkan tiket ini saat registrasi di lokasi event.</p>
        </div>

    </div>

    <div class="flex gap-3 mt-6">
        <a href="/"
           class="flex-1 text-center border-2 border-indigo-600 text-indigo-600 font-semibold py-3 rounded-xl hover:bg-indigo-50 transition">
            ← Kembali
        </a>
        <a href="#"
           class="flex-1 text-center bg-indigo-600 text-white font-semibold py-3 rounded-xl hover:bg-indigo-700 transition">
            Download PDF
        </a>
    </div>
</div>

@endsection