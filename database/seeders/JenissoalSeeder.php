<?php

namespace Database\Seeders;

use App\Models\Jenissoal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenissoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $editor = User::where('username', 'username')->first();
        
        Jenissoal::create([
            'nama' => 'Tryout SKD 1',
            'user_id' => $editor->id,
            'kategori' => 'Gratis',
        ]);

        Jenissoal::create([
            'nama' => 'Tryout SKD 2',
            'user_id' => $editor->id,
            'kategori' => 'Gratis',
        ]);
    }
}
