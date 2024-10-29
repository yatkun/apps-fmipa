<?php

namespace Database\Seeders;

use App\Models\Pilihan;
use App\Models\Soal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PilihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question = Soal::first(); // Ambil soal pertama

        $options = [
            ['opsi' => 'Merah', 'is_correct' => false],
            ['opsi' => 'Hijau', 'is_correct' => false],
            ['opsi' => 'Biru', 'is_correct' => true], // Kunci jawaban
            ['opsi' => 'Kuning', 'is_correct' => false],
            ['opsi' => 'Putih', 'is_correct' => false],
        ];

        foreach ($options as $option) {
            Pilihan::create([
                'opsi' => $option['opsi'],
                'is_correct' => $option['is_correct'],
                'soal_id' => $question->id,
            ]);
        }

        $question2 = Soal::where('id', 2)->first();

        $options2 = [
            ['opsi' => 'Universitas Hasanuddin', 'is_correct' => false],
            ['opsi' => 'Institut Pertanian Bogor', 'is_correct' => true],
            ['opsi' => 'Institut Teknologi Bandung', 'is_correct' => false], // Kunci jawaban
            ['opsi' => 'Universitas Diponegoro', 'is_correct' => false],
            ['opsi' => 'Universitas Negeri Jakarta', 'is_correct' => false],
        ];

        foreach ($options2 as $option2) {
            Pilihan::create([
                'opsi' => $option2['opsi'],
                'is_correct' => $option2['is_correct'],
                'soal_id' => $question2->id,
            ]);
        }

    }
}
