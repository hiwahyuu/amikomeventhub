<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Partner;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 event terbaru
        $events = Event::with('category')->latest()->take(6)->get();

        // Ambil semua partner untuk ditampilkan di homepage
        $partners = Partner::latest()->get();

        // Ambil semua kategori untuk ditampilkan di homepage
        $categories = Category::latest()->get();

        return view('welcome', compact('events', 'partners', 'categories'));
    }
}