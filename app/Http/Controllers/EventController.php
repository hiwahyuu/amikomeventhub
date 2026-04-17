<?php

namespace App\Http\Controllers;

class EventController extends Controller
{
    // Halaman detail event (sisi user)
    public function show()
    {
        return view('event-detail');
    }

    // Halaman checkout (sisi user)
    public function checkout()
    {
        return view('checkout');
    }

    // Halaman tiket (sisi user)
    public function ticket()
    {
        return view('ticket');
    }

    // Halaman daftar event (sisi admin)
    public function indexAdmin()
    {
        return view('admin.events');
    }
}