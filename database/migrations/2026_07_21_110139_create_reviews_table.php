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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Menyambungkan review dengan user yang memberi ulasan
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Menyambungkan review dengan event yang diulas
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            // Menyimpan nilai bintang 1 sampai 5
            $table->tinyInteger('rating');
            // Menyimpan teks ulasan/testimoni
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};