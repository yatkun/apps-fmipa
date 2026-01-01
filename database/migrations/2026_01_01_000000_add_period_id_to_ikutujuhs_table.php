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
        if (Schema::hasTable('ikutujuhs') && !Schema::hasColumn('ikutujuhs', 'period_id')) {
            Schema::table('ikutujuhs', function (Blueprint $table) {
                $table->foreignId('period_id')->nullable()->after('id')->constrained('periods')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('ikutujuhs') && Schema::hasColumn('ikutujuhs', 'period_id')) {
            Schema::table('ikutujuhs', function (Blueprint $table) {
                $table->dropForeign(['period_id']);
                $table->dropColumn('period_id');
            });
        }
    }
};
