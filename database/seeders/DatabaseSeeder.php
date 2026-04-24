<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        \App\Models\User::create([
            'name'     => 'Admin Amikom',
            'email'    => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // 2. Kategori
        $cat1 = \App\Models\Category::create(['name' => 'Seminar IT',      'slug' => 'seminar-it']);
        $cat2 = \App\Models\Category::create(['name' => 'Entertainment',   'slug' => 'entertainment']);
        $cat3 = \App\Models\Category::create(['name' => 'Workshop',        'slug' => 'workshop']);

        // 3. Events
        \App\Models\Event::create([
            'category_id' => $cat2->id,
            'title'       => 'Jazz Night 2026',
            'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu.',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Amikom Baru',
            'price'       => 50000,
            'stock'       => 100,
            'poster_path' => 'posters/event-1.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $cat1->id,
            'title'       => 'Hackathon - Unleash Your Inner Developer',
            'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif!',
            'date'        => '2026-05-05 10:00:00',
            'location'    => 'Inkubator Amikom',
            'price'       => 50000,
            'stock'       => 100,
            'poster_path' => 'posters/event-2.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $cat1->id,
            'title'       => 'AI & Future Tech Summit 2026',
            'description' => 'Jelajahi tren terkini dalam AI dan teknologi masa depan.',
            'date'        => '2026-05-01 13:00:00',
            'location'    => 'Cinema Unit 6',
            'price'       => 50000,
            'stock'       => 100,
            'poster_path' => 'posters/event-3.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $cat3->id,
            'title'       => 'UI/UX Masterclass 2026',
            'description' => 'Pelajari desain antarmuka modern dari para praktisi industri.',
            'date'        => '2026-06-01 09:00:00',
            'location'    => 'Lab Komputer Amikom',
            'price'       => 75000,
            'stock'       => 50,
            'poster_path' => 'posters/event-4.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $cat2->id,
            'title'       => 'E-Sport U-Champ 2026',
            'description' => 'Turnamen e-sport antar universitas se-DIY.',
            'date'        => '2026-06-15 08:00:00',
            'location'    => 'GOR Amikom',
            'price'       => 30000,
            'stock'       => 200,
            'poster_path' => 'posters/event-5.png',
        ]);

        \App\Models\Event::create([
            'category_id' => $cat3->id,
            'title'       => 'Laravel Workshop: Build REST API',
            'description' => 'Workshop membangun REST API dengan Laravel dari nol.',
            'date'        => '2026-07-01 10:00:00',
            'location'    => 'Ruang Seminar Amikom',
            'price'       => 100000,
            'stock'       => 40,
            'poster_path' => 'posters/event-6.png',
        ]);
    }
}