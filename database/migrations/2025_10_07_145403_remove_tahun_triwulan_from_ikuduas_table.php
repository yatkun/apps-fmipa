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
        Schema::table('ikuduas', function (Blueprint $table) {
            $table->dropColumn(['tahun', 'triwulan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ikuduas', function (Blueprint $table) {
            $table->string('tahun')->nullable();
            $table->string('triwulan')->nullable();
        });
    }
};
