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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('soal_id')->constrained()->onDelete('cascade');
            $table->foreignId('pilihan_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Index untuk mempercepat pencarian
            $table->unique(['user_id', 'soal_id']);  // Menjaga agar satu user hanya bisa memilih satu jawaban untuk satu soal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
