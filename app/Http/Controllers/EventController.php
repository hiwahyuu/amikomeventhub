<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // 1. Menampilkan Semua Data (Read)
    public function index()
    {
        $events = Event::with('category')->get();
        return view('admin.events.index', compact('events'));
    }

    // 2. Menampilkan Form Tambah (Create)
    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    // 3. Menyimpan Data ke Database + Upload Foto (Store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'category_id' => 'required',
            'date'        => 'required',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'capacity'    => 'required|numeric',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster_path'] = $path;
        }

        Event::create($validated);
        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    // ✅ BARU — Menampilkan Detail Event (untuk halaman publik)
    public function show($id)
    {
        $event      = Event::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('events.show', compact('event', 'categories'));
    }

    // 4. Menampilkan Form Edit (Update)
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    // 5. Memperbarui Data + Update Foto (Update)
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'category_id' => 'required',
            'date'        => 'required',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'capacity'    => 'required|numeric',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }
            $path = $request->file('poster')->store('posters', 'public');
            $validated['poster_path'] = $path;
        }

        $event->update($validated);
        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui!');
    }

    // 6. Menghapus Data (Delete)
    public function destroy(Event $event)
    {
        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus!');
    }
}