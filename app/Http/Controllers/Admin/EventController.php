<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

        public function update(Request $request, Event $event)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'date' => 'required',
            'capacity' => 'required|integer',
            'location' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // 2. Ambil semua input kecuali token, method, dan image
        $data = $request->except(['_token', '_method', 'image']);

        // 3. Logika Update Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
                Storage::disk('public')->delete($event->poster_path);
            }
            
            // Simpan gambar baru ke folder 'posters' di storage/app/public/posters
            $path = $request->file('image')->store('posters', 'public');
            
            // Masukkan path ke dalam array data
            $data['poster_path'] = $path;
        }

        // 4. Update data ke database
        $event->update($data);

        // 5. Redirect dengan pesan sukses
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }


    public function destroy(Event $event)
    {
        //
    }
}