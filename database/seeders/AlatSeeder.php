<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alat;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {

            Alat::create([
                'kode_alat' => 'LAB00'.$i,
                'nama_alat' => 'Alat Laboratorium '.$i,
                'kategori' => 'Farmasi',
                'stok' => rand(1,10),
                'lokasi' => 'Lab Farmasi',
                'kondisi' => 'baik',
                'gambar' => null,
                'qr_code' => null,
                'deskripsi' => 'Deskripsi alat laboratorium '.$i
            ]);

        }
    }
}
