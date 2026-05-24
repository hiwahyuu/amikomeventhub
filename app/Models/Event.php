<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Memberitahu Laravel kolom mana saja yang boleh diisi (Mass Assignment).
     * Nama-nama kolom ini harus sama persis dengan yang ada di file Migration.
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'date',
        'location',
        'price',
        'capacity',
        'sold',
        'poster_path'
    ];

    /**
     * Relasi: Satu Event memiliki satu Kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}