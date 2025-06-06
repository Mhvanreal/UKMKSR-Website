<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\LayananSeeder;
use Database\Seeders\KegiatanSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        // $this-> call(SeedersBlog)
        \App\Models\User::factory()->create([
            'name' => 'HUMAS KSR',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'humas_ksr',

        ]);

        \App\Models\User::factory()->create([
            'name' => 'anggota',
            'email' => 'anggotabandel@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
        $this->call([
            BlogSeeder::class,
            LayananSeeder::class,
            KegiatanSeeder::class,
            tentangSeeder::class,
            anggotaSeeder::class,
            kepengurasanSeeder::class,
            JenisGaleriSeeder::class,
        ]);
    }
}
