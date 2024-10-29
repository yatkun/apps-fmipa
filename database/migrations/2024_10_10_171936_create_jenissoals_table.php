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
        Schema::create('jenissoals', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama jenis soal
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User dengan level editor yang membuat jenis soal
            $table->string('kategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenissoals');
    }
};
