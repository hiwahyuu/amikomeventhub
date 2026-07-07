<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'category_id' => 'required',
            'date'        => 'required',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'capacity'    => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Input name dari form tetap 'image'
        ]);

        if ($request->hasFile('image')) {
            // PERBAIKAN: Simpan ke key 'poster_path' agar sesuai dengan database & Model
            $validated['poster_path'] = $request->file('image')->store('posters', 'public');
        }

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function show($id)
    {
        $event      = Event::with('category')->findOrFail($id);
        $categories = Category::all();
        return view('events.show', compact('event', 'categories'));
    }

    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'category_id' => 'required',
            'date'        => 'required',
            'location'    => 'required',
            'price'       => 'required|numeric',
            'capacity'    => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // PERBAIKAN: Hapus gambar lama menggunakan kolom 'poster_path'
            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }
            
            // PERBAIKAN: Masukkan path gambar baru ke dalam key 'poster_path'
            $validated['poster_path'] = $request->file('image')->store('posters', 'public');
        }

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        // PERBAIKAN: Cek dan hapus gambar menggunakan kolom 'poster_path'
        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}