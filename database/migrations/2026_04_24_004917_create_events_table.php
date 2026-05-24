<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel categories sesuai struktur database kamu
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            
            // Kolom Nama Event (Sesuaikan dengan CRUD Drive: 'name')
            $table->string('name'); 
            
            $table->text('description')->nullable();
            $table->dateTime('date');
            $table->string('location');
            
            // Informasi Tiket
            $table->integer('price');
            $table->integer('capacity'); // Mengganti 'stock' menjadi 'capacity' sesuai materi CRUD
            $table->integer('sold')->default(0); // Menambahkan kolom tiket terjual
            
            $table->string('poster_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};