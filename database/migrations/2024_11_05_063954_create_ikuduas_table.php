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
        Schema::create('ikuduas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('program_studi');
            $table->string('kategori');
            $table->string('sks_juara');
            $table->string('level')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('bukti')->nullable();
            $table->float('bobot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikuduas');
    }
};
