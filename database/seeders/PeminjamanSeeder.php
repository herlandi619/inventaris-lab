<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Seeder;


class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {

            Peminjaman::create([
                'mahasiswa_id' => rand(2,15),
                'alat_id' => rand(1,15),
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => now()->addDays(3),
                'status' => 'menunggu'
            ]);

        }
    }
}
