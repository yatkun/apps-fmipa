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
        Schema::create('skripsis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nama');
            $table->unsignedBigInteger('pembimbing_1');
            $table->foreign('pembimbing_1')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pembimbing_2');
            $table->foreign('pembimbing_2')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skripsis');
    }
};
