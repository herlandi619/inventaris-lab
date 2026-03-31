<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengembalian;

class PengembalianSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {

            Pengembalian::create([
                'peminjaman_id' => $i,
                'tanggal_dikembalikan' => now()->addDays(5),
                'kondisi_setelah' => 'baik',
                'catatan' => 'Pengembalian alat dalam kondisi baik'
            ]);

        }
    }
}
