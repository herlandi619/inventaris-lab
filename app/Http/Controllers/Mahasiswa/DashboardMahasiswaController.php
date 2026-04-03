<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        // Total alat
        $jumlahAlat = Alat::count();

        // Alat yang sedang dipinjam (status 'dipinjam' atau 'disetujui')
        $alatDipinjam = Peminjaman::whereIn('status', ['dipinjam','disetujui'])->count();

        // Alat tersedia = total alat - alat dipinjam
        $alatTersedia = $jumlahAlat - $alatDipinjam;

        // Total mahasiswa
        $jumlahMahasiswa = User::where('role', 'mahasiswa')->count();

        // Kirim ke view
        return view('mahasiswa.dashboard.index', compact(
            'jumlahAlat',
            'alatDipinjam',
            'alatTersedia',
            'jumlahMahasiswa'
        ));
    }
}
