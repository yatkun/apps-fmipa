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
        Schema::table('letters', function (Blueprint $table) {
            // Update status enum untuk 3 tahap approval
            $table->string('status')->default('verification_tendik')->change(); // verification_tendik, verification_dekan, approved, rejected
            
            // Field untuk nomor surat yang diisi oleh Tendik
            $table->string('letter_number')->nullable()->after('title');
            
            // Field untuk verifikasi Tendik
            $table->foreignId('verified_by_tendik_id')->nullable()->constrained('users')->after('approved_by_user_id');
            $table->timestamp('verified_at_tendik')->nullable()->after('verified_by_tendik_id');
            $table->text('tendik_notes')->nullable()->after('verified_at_tendik');
            
            // Field untuk verifikasi Dekan  
            $table->foreignId('verified_by_dekan_id')->nullable()->constrained('users')->after('tendik_notes');
            $table->timestamp('verified_at_dekan')->nullable()->after('verified_by_dekan_id');
            $table->text('dekan_notes')->nullable()->after('verified_at_dekan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->dropColumn([
                'letter_number',
                'verified_by_tendik_id', 
                'verified_at_tendik',
                'tendik_notes',
                'verified_by_dekan_id',
                'verified_at_dekan', 
                'dekan_notes'
            ]);
            
            // Kembalikan status ke enum lama
            $table->string('status')->default('pending')->change();
        });
    }
};
