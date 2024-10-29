<?php

namespace Database\Seeders;

use App\Models\Jenissoal;
use App\Models\Soal;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       


        User::factory()->create([
            'name' => 'Test User',
            'username' => 'username',
            'password' => bcrypt('password'),
            'email' => 'test@example.com',
        ]);

        $this->call([
       
            JenissoalSeeder::class,
            SoalSeeder::class,
            PilihanSeeder::class,
        ]);
    }
}
