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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembimbing_1')->constrained('users')->onDelete('cascade');
            $table->foreignId('pembimbing_2')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('nim');
            $table->string('prodi');
            $table->string('angkatan');
            $table->string('judul');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};
