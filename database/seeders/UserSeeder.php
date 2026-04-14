<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Laboran
        User::create([
            'name' => 'Laboran Utama',
            'nim' => null,
            'email' => 'laboran@lab.com',
            'role' => 'laboran',
            'is_active' => 1,
            'password' => Hash::make('password')
        ]);

        // Mahasiswa
        for ($i = 1; $i <= 14; $i++) {

            User::create([
                'name' => 'Mahasiswa '.$i,
                'nim' => '20230'.$i,
                'email' => 'mahasiswa'.$i.'@mail.com',
                'role' => 'mahasiswa',
                'is_active' => 1,
                'password' => Hash::make('password')
            ]);

        }
    }
}