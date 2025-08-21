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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable()->constrained()->onDelete('cascade'); // Surat ini dibuat dari template mana
            $table->string('file_path'); // Path surat .docx yang sudah jadi
            $table->json('data_filled')->nullable(); // Data yang diisikan ke placeholder (JSON)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Siapa yang membuat surat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
