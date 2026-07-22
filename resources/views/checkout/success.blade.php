@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 py-10 px-4">
    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-slate-100 max-w-md w-full text-center">
        
        <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        </div>
        
        <h1 class="text-3xl font-black text-slate-800 mb-2">Hore, Berhasil!</h1>
        <p class="text-slate-500 text-sm mb-8">Terima kasih, pembayaran untuk tiket event <strong>{{ $transaction->event->title }}</strong> telah kami terima.</p>
        
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 mb-8 text-left">
            <p class="text-[10px] uppercase font-bold tracking-widest text-slate-400 mb-1">Order ID</p>
            <p class="font-bold text-slate-800 mb-4">{{ $transaction->order_id }}</p>
            
            <p class="text-[10px] uppercase font-bold tracking-widest text-slate-400 mb-1">Nama Pemesan</p>
            <p class="font-bold text-slate-800 mb-4">{{ $transaction->customer_name }}</p>

            <p class="text-[10px] uppercase font-bold tracking-widest text-slate-400 mb-1">Total Dibayar</p>
            <p class="font-black text-indigo-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
        </div>

        {{-- TOMBOL UNDUH SERTIFIKAT (FITUR BARU) --}}
        <a href="{{ route('checkout.certificate', $transaction->order_id) }}" class="block w-full bg-indigo-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all hover:-translate-y-1 mb-3">
             Unduh E-Certificate (PDF)
        </a>

        <a href="{{ route('home') }}" class="block w-full bg-slate-800 text-white font-bold py-4 rounded-xl shadow-lg shadow-slate-200 hover:bg-slate-900 transition-all hover:-translate-y-1">
            Kembali ke Beranda
        </a>

    </div>
</div>
@endsection