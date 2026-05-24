<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Tambahkan ini buat bikin slug otomatis

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Boot function untuk otomatis bikin slug pas data disimpan
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            // Otomatis bikin slug dari nama (Contoh: "Musik Rock" jadi "musik-rock")
            $category->slug = Str::slug($category->name);
        });
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}