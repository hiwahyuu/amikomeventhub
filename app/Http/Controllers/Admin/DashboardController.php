<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendapatan = Transaction::whereIn('status', ['success', 'paid'])->sum('total_price');
        $tiketTerjual = Transaction::whereIn('status', ['success', 'paid'])->count();
        $eventAktif = Event::where('date', '>=', now())->count();
        $pesananPending = Transaction::where('status', 'pending')->count();
        
        // Hapus 'user' dari sini, cukup panggil 'event' saja
        $transaksiTerakhir = Transaction::with('event')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'tiketTerjual',
            'eventAktif',
            'pesananPending',
            'transaksiTerakhir'
        ));
    }
}