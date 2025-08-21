<?php

namespace Database\Seeders;

use App\Models\Jenissoal;
use App\Models\Pendidikan;
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
        User::factory()->create([
            'name' => 'dekan',
            'username' => 'dekan',
            'password' => bcrypt('dekan'),
            'email' => 'dekan@example.com',
            'level' => 'Dosen',
            'is_dekan' => true
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'username' => 'username2',
            'password' => bcrypt('password2'),
            'email' => 'test2@example.com',
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'email' => 'admin@example.com',
            'level' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'Test User 3',
            'username' => 'username3',
            'password' => bcrypt('password3'),
            'email' => 'test3@example.com',
        ]);

        User::factory()->create([
            'name' => 'Tendik 1',
            'username' => 'tendik',
            'password' => bcrypt('tendik'),
            'email' => 'tendik@example.com',
            'level' => 'Tendik'
        ]);

        Pendidikan::create([
            'nama' => 'Ijazah S1',
            'document' => 'www.google.com',
            'user_id' => 1,
        ]);

        $this->call([
            JenissoalSeeder::class,
            SoalSeeder::class,
            PilihanSeeder::class,
            
        ]);
    }
}
