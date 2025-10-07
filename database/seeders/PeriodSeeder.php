<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create initial period
        Period::create([
            'name' => '2024/2025',
            'year_start' => 2024,
            'year_end' => 2025,
            'description' => 'Periode akademik 2024/2025',
            'is_active' => true,
        ]);

        Period::create([
            'name' => '2023/2024',
            'year_start' => 2023,
            'year_end' => 2024,
            'description' => 'Periode akademik 2023/2024',
            'is_active' => false,
        ]);
    }
}
