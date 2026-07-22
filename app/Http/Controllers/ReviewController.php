<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $eventId)
    {
        // 1. Validasi input: rating wajib diisi (1-5), komentar opsional
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // 2. Simpan ulasan ke database
        Review::create([
            'user_id' => Auth::id(),     // Mengambil ID user yang sedang login
            'event_id' => $eventId,      // ID event yang sedang diulas
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // 3. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}