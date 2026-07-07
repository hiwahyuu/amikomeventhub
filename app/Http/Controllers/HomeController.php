<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Models\Partner; // Tambahkan ini agar logo partner di bawah tidak error

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data kategori & partner
        $categories = Category::all();
        $partners = Partner::all();

        // 2. KUNCI PERBAIKAN: Ambil event khusus Hero (Jazz Night) secara terpisah
        // Sehingga gambar di atas tidak akan hilang walau kategorinya di-filter
        $heroEvent = Event::where('name', 'like', '%Jazz Night%')->first() ?? Event::latest()->first();

        // 3. Logika Filter Event List Berdasarkan URL
        if ($request->has('category')) {
            $events = Event::where('category_id', $request->category)->latest()->get();
            $activeCategory = $request->category; 
        } else {
            $events = Event::latest()->get();
            $activeCategory = 'all'; 
        }

        return view('welcome', compact('events', 'categories', 'activeCategory', 'heroEvent', 'partners'));
    }
}