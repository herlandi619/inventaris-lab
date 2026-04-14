<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alat;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {

            $kode = 'LAB00'.$i;

            Alat::create([
                'kode_alat' => $kode,
                'nama_alat' => 'Alat Laboratorium '.$i,
                'kategori' => 'Farmasi',
                'stok' => rand(1,10),
                'lokasi' => 'Lab Farmasi',
                'kondisi' => 'baik',
                'gambar' => null,

                // barcode biasanya sama dengan kode alat
                'barcode' => $kode,

                'deskripsi' => 'Deskripsi alat laboratorium '.$i,

                'tutorial_penggunaan' => 
                "1. Periksa kondisi alat sebelum digunakan.\n".
                "2. Pastikan alat terhubung dengan sumber daya.\n".
                "3. Gunakan alat sesuai petunjuk praktikum.\n".
                "4. Setelah selesai gunakan, bersihkan alat.\n".
                "5. Kembalikan alat ke tempat semula."
            ]);

        }
    }
}
