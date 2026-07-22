@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 max-w-2xl">
        
        <div class="text-center mb-8">
            <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 text-sm font-bold inline-flex items-center gap-1 hover:text-indigo-800 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Event
            </a>
            <h1 class="text-3xl font-black text-slate-800">Checkout</h1>
            <p class="text-slate-500 text-sm mt-1">Lengkapi data Anda untuk mendapatkan tiket.</p>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm mb-6">
            <h2 class="text-sm font-bold text-slate-800 mb-6">Pesanan Anda</h2>

            <div class="flex items-center gap-4 mb-6">
                <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) ? asset('storage/' . $event->poster_path) : 'https://placehold.co/200x200' }}" alt="Poster" class="w-16 h-16 object-cover rounded-xl border border-slate-100">
                <div>
                    <h3 class="font-bold text-slate-800 text-sm md:text-base">{{ $event->title }}</h3>
                    <p class="text-xs text-slate-500 mt-1">{{ date('d M Y', strtotime($event->date)) }} &bull; {{ $event->location }}</p>
                    <p class="text-sm font-bold text-indigo-600 mt-1.5">1 x {{ $event->price == 0 ? 'FREE' : 'Rp ' . number_format($event->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-5 mb-4 space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Harga Tiket</span>
                    <span class="font-medium text-slate-600">{{ $event->price == 0 ? 'Rp 0' : 'Rp ' . number_format($event->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Biaya Layanan</span>
                    <span class="font-medium text-slate-600">Rp 5.000</span>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-5 flex justify-between items-center">
                <span class="font-bold text-slate-800 text-lg">Total Bayar</span>
                <span class="font-black text-indigo-600 text-xl">
                    Rp {{ number_format($event->price + 5000, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm">
            <h2 class="text-indigo-600 italic underline font-bold mb-8">Data Pemesan</h2>

            {{-- KOTAK ERROR: Akan muncul jika Midtrans menolak, stok habis, atau promo salah --}}
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 text-red-600 border border-red-200 rounded-xl font-bold text-sm">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 text-red-600 border border-red-200 rounded-xl font-bold text-sm">
                    ⚠️ Ada input yang salah:
                    <ul class="list-disc pl-5 mt-1 font-normal text-xs">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('checkout.store', $event->id) }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="customer_name" required placeholder="Masukkan nama sesuai identitas" value="{{ old('customer_name') }}"
                           class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm transition">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-2">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-2">Email Aktif</label>
                        <input type="email" name="customer_email" required placeholder="contoh@gmail.com" value="{{ old('customer_email') }}"
                               class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm transition">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-2">No. WhatsApp</label>
                        <input type="text" name="customer_phone" required placeholder="08xxxxxxx" value="{{ old('customer_phone') }}"
                               class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm transition">
                    </div>
                </div>
                
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mb-6">*E-Ticket akan dikirim ke email ini</p>

                {{-- KOTAK INPUT KODE PROMO BARU --}}
                <div class="mb-8 p-5 bg-indigo-50 border border-indigo-100 rounded-2xl">
                    <label class="block text-[10px] font-bold text-indigo-700 uppercase tracking-widest mb-2">Kode Promo (Opsional)</label>
                    <input type="text" name="promo_code" placeholder="Masukkan kode promo jika ada..." value="{{ old('promo_code') }}"
                           class="w-full px-4 py-3.5 rounded-xl border border-indigo-200 focus:ring-2 focus:ring-indigo-500 outline-none text-sm transition uppercase placeholder:normal-case">
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-300">
                    Lanjut Pembayaran
                </button>
                
                <p class="text-[10px] text-center text-slate-400 mt-5">
                    Dengan menekan tombol di atas, Anda menyetujui Syarat & Ketentuan kami.
                </p>
            </form>
        </div>

    </div>
</div>
@endsection