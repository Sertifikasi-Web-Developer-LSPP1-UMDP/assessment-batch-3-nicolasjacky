<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $model = User::class;
    public function run(): void
    {
        // Buat 10 user dengan role mahasiswa
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'nama' => 'Mahasiswa ' . ($i + 1),
                'email' => 'mahasiswa' . ($i + 1) . '@gmail.com',
                'password' => Hash::make('mahasiswa'),
                'role' => 'mahasiswa',
            ]);
        }
        // Buat 1 user dengan role admin
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
    }
}
