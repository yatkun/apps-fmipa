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
        $tables = ['ikuduas', 'ikutigas', 'ikuempats', 'ikulimas', 'ikuenams', 'ikutujuhs', 'ikudelapans'];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    $table->foreignId('period_id')->nullable()->after('id')->constrained('periods')->onDelete('cascade');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['ikuduas', 'ikutigas', 'ikuempats', 'ikulimas', 'ikuenams', 'ikutujuhs', 'ikudelapans'];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $table) {
                    // Check if foreign key exists before dropping
                    $indexName = $table->getTable() . '_period_id_foreign';
                    if ($this->hasIndex($table->getTable(), $indexName)) {
                        $table->dropForeign(['period_id']);
                    }
                    $table->dropColumn('period_id');
                });
            }
        }
    }

    private function hasIndex($table, $indexName)
    {
        $indexes = \DB::select(\DB::raw("SHOW INDEXES FROM " . $table . " WHERE Key_name = '" . $indexName . "'"));
        return !empty($indexes);
    }
};
