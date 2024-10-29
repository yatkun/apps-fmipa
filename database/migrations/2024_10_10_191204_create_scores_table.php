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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jenissoal_id')->constrained()->onDelete('cascade');
            $table->integer('score')->default(0); // Nilai pengguna
            $table->timestamps();
            
            // Index untuk mempercepat pencarian
            $table->unique(['user_id', 'jenissoal_id']);  // Menjaga agar satu user hanya memiliki satu nilai untuk setiap quiz
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
