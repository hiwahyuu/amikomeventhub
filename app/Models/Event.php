<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Pastikan organizer_id masuk ke dalam fillable
    protected $fillable = [
        'category_id',
        'organizer_id', 
        'name',
        'description',
        'date',
        'location',
        'price',
        'capacity',
        'sold',
        'poster_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // INI DIA FUNGSI YANG BIKIN ERROR KARENA SEBELUMNYA BELUM ADA
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // Relasi: Satu event bisa memiliki banyak review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}