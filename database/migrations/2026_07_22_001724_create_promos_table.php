<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();          // Nama kode, misal: MAHASISWA50
            $table->integer('discount_amount');        // Potongan harga dalam Rupiah (misal: 20000)
            $table->integer('quota')->default(100);    // Batas jumlah orang yang bisa pakai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};