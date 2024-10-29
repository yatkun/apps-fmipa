<?php

namespace Database\Seeders;

use App\Models\Jenissoal;
use App\Models\Soal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionType = Jenissoal::where('nama', 'Tryout SKD 1')->first();

        $question = Soal::create([
            'pertanyaan' => 'Apa warna langit di siang hari?',
            'jenissoal_id' => $questionType->id
        ]);

        $question = Soal::create([
            'pertanyaan' => 'Apa kepanjangan IPB ?',
            'jenissoal_id' => $questionType->id
        ]);
        
        $dua = Jenissoal::where('nama', 'Tryout SKD 2')->first();

        $question = Soal::create([
            'pertanyaan' => 'Haloo?',
            'jenissoal_id' => $dua->id
        ]);

    }
}
