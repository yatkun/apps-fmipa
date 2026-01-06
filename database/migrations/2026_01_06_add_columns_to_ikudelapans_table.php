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
        Schema::table('ikudelapans', function (Blueprint $table) {
            $table->string('program_studi')->nullable();
            $table->string('bukti')->nullable()->after('program_studi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ikudelapans', function (Blueprint $table) {
            $table->dropColumn(['program_studi', 'bukti']);
        });
    }
};
