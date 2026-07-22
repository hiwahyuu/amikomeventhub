<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Jika SUPERADMIN: Hitung semua data
        if ($user->role === 'superadmin') {
            $totalRevenue = Transaction::where('status', 'success')->sum('total_price');
            $ticketsSold = Transaction::where('status', 'success')->count();
            $activeEvents = Event::count();
            $pendingOrders = Transaction::where('status', 'pending')->count();
            
            $recentTransactions = Transaction::with('event')->latest()->take(5)->get();
        } 
        // Jika PENYELENGGARA: Hitung hanya data dari event miliknya sendiri
        else {
            $totalRevenue = Transaction::where('status', 'success')
                ->whereHas('event', function($query) use ($user) {
                    $query->where('organizer_id', $user->id);
                })->sum('total_price');

            $ticketsSold = Transaction::where('status', 'success')
                ->whereHas('event', function($query) use ($user) {
                    $query->where('organizer_id', $user->id);
                })->count();

            $activeEvents = Event::where('organizer_id', $user->id)->count();

            $pendingOrders = Transaction::where('status', 'pending')
                ->whereHas('event', function($query) use ($user) {
                    $query->where('organizer_id', $user->id);
                })->count();

            $recentTransactions = Transaction::with('event')
                ->whereHas('event', function($query) use ($user) {
                    $query->where('organizer_id', $user->id);
                })->latest()->take(5)->get();
        }

        // Mengirimkan variabel dengan nama bahasa Inggris agar cocok dengan Blade-mu
        return view('admin.dashboard', compact(
            'totalRevenue', 
            'ticketsSold', 
            'activeEvents', 
            'pendingOrders', 
            'recentTransactions'
        ));
    }
}