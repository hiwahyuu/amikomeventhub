@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl p-12 mb-10 text-center shadow-lg">
    <h1 class="text-4xl font-bold mb-3">Temukan Event Seru di AMIKOM! 🎉</h1>
    <p class="text-indigo-100 text-lg mb-6">Seminar, konser, workshop, dan banyak lagi menantimu.</p>
    <a href="/event/1"
       class="inline-block bg-white text-indigo-700 font-semibold px-8 py-3 rounded-xl hover:bg-indigo-50 transition shadow">
        Jelajahi Event →
    </a>
</div>

{{-- Event Grid --}}
<h2 class="text-2xl font-bold text-gray-800 mb-6">Event Mendatang</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- Card Event 1 --}}
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="bg-indigo-500 h-40 flex items-center justify-center text-6xl">🎤</div>
        <div class="p-5">
            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full font-medium">Seminar</span>
            <h3 class="font-bold text-gray-800 mt-2 text-lg">Tech Talks 2026</h3>
            <p class="text-gray-500 text-sm mt-1">📅 20 Mei 2026 &nbsp;|&nbsp; 📍 Aula AMIKOM</p>
            <p class="text-gray-600 text-sm mt-2">Seminar teknologi terkini bersama para pakar industri.</p>
            <a href="/event/1"
               class="mt-4 block text-center bg-indigo-600 text-white py-2 rounded-xl hover:bg-indigo-700 transition text-sm font-semibold">
                Lihat Detail
            </a>
        </div>
    </div>

    {{-- Card Event 2 --}}
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="bg-pink-500 h-40 flex items-center justify-center text-6xl">🎵</div>
        <div class="p-5">
            <span class="text-xs bg-pink-100 text-pink-700 px-2 py-1 rounded-full font-medium">Konser</span>
            <h3 class="font-bold text-gray-800 mt-2 text-lg">AMIKOM Music Fest</h3>
            <p class="text-gray-500 text-sm mt-1">📅 15 Juni 2026 &nbsp;|&nbsp; 📍 Lapangan AMIKOM</p>
            <p class="text-gray-600 text-sm mt-2">Festival musik tahunan dengan penampilan band indie lokal.</p>
            <a href="/event/1"
               class="mt-4 block text-center bg-pink-600 text-white py-2 rounded-xl hover:bg-pink-700 transition text-sm font-semibold">
                Lihat Detail
            </a>
        </div>
    </div>

    {{-- Card Event 3 --}}
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="bg-green-500 h-40 flex items-center justify-center text-6xl">💻</div>
        <div class="p-5">
            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-medium">Workshop</span>
            <h3 class="font-bold text-gray-800 mt-2 text-lg">Laravel Bootcamp</h3>
            <p class="text-gray-500 text-sm mt-1">📅 10 Juli 2026 &nbsp;|&nbsp; 📍 Lab Komputer</p>
            <p class="text-gray-600 text-sm mt-2">Workshop intensif membangun aplikasi web dengan Laravel.</p>
            <a href="/event/1"
               class="mt-4 block text-center bg-green-600 text-white py-2 rounded-xl hover:bg-green-700 transition text-sm font-semibold">
                Lihat Detail
            </a>
        </div>
    </div>

</div>

@endsection