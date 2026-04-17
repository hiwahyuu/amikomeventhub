<!-- @extends('layouts.app') 
@section('content')

<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">🛒 Checkout</h1>

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Detail Pesanan</h2>
        <div class="flex justify-between items-center py-3 border-b">
            <div>
                <p class="font-medium text-gray-800">Tech Talks 2026 — Regular</p>
                <p class="text-sm text-gray-500">📅 20 Mei 2026 | 📍 Aula AMIKOM</p>
            </div>
            <p class="font-bold text-indigo-600">Rp 75.000</p>
        </div>
        <div class="flex justify-between items-center pt-4 font-bold text-lg">
            <span>Total</span>
            <span class="text-indigo-600">Rp 75.000</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Data Pemesan</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                <input type="text" placeholder="Masukkan nama lengkap"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                <input type="email" placeholder="email@contoh.com"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">No. HP</label>
                <input type="tel" placeholder="08xx-xxxx-xxxx"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Metode Pembayaran</h2>
        <div class="grid grid-cols-3 gap-3">
            <label class="border-2 border-indigo-500 rounded-xl p-3 text-center cursor-pointer bg-indigo-50">
                <input type="radio" name="payment" class="hidden" checked>
                <p class="font-semibold text-indigo-700 text-sm">Transfer Bank</p>
            </label>
            <label class="border border-gray-200 rounded-xl p-3 text-center cursor-pointer hover:border-indigo-400">
                <input type="radio" name="payment" class="hidden">
                <p class="font-semibold text-gray-600 text-sm">GoPay</p>
            </label>
            <label class="border border-gray-200 rounded-xl p-3 text-center cursor-pointer hover:border-indigo-400">
                <input type="radio" name="payment" class="hidden">
                <p class="font-semibold text-gray-600 text-sm">OVO</p>
            </label>
        </div>
    </div>

    <a href="/my-ticket"
       class="block text-center bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 transition text-lg shadow-lg">
        Konfirmasi & Bayar
    </a>
    <a href="/event/1" class="block text-center text-gray-500 text-sm mt-3 hover:text-gray-700">← Kembali ke Detail Event</a>
</div>

@endsection