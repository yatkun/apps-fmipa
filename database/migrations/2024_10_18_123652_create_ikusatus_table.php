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
        Schema::create('ikusatus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('program_studi');
            $table->date('tanggal_lulus');
            $table->string('pekerjaan');
            $table->integer('pendapatan');
            $table->string('masa_tunggu');
            $table->integer('ump');
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
        Schema::dropIfExists('ikusatus');
    }
};
