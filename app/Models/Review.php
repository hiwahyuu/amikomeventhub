<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Mengizinkan Laravel untuk mengisi kolom-kolom ini
    protected $fillable = [
        'user_id',
        'event_id',
        'rating',
        'comment',
    ];

    // Relasi: Setiap review dimiliki oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Setiap review ditujukan untuk 1 event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}