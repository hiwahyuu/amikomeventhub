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
        // LOGIKA MULTI-TENANT: Superadmin lihat semua, Organizer lihat miliknya sendiri
        if (auth()->user()->role === 'superadmin') {
            $events = Event::with(['category', 'organizer'])->latest()->get();
        } else {
            $events = Event::with('category')
                           ->where('organizer_id', auth()->id())
                           ->latest()
                           ->get();
        }
        
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
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Otomatis masukkan ID pembuat (Penyelenggara)
        $validated['organizer_id'] = auth()->id();

        if ($request->hasFile('poster_path')) {
            $validated['poster_path'] = $request->file('poster_path')->store('posters', 'public');
        }

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function edit(Event $event)
    {
        // Keamanan tambahan: Pastikan organizer tidak bisa edit event orang lain
        if (auth()->user()->role !== 'superadmin' && $event->organizer_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke event ini.');
        }

        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        if (auth()->user()->role !== 'superadmin' && $event->organizer_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('poster_path')) {
            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }
            $validated['poster_path'] = $request->file('poster_path')->store('posters', 'public');
        }

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diupdate');
    }

    public function destroy(Event $event)
    {
        if (auth()->user()->role !== 'superadmin' && $event->organizer_id !== auth()->id()) {
            abort(403);
        }

        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus');
    }
}