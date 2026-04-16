<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardMahasiswaController extends Controller
{
    public function index()
    {
        $jumlahAlat = Alat::count();

        $alatDipinjam = Peminjaman::whereIn('status', ['dipinjam','disetujui'])->count();
        $alatTersedia = $jumlahAlat - $alatDipinjam;
        $jumlahMahasiswa = User::where('role', 'mahasiswa')->count();

        // 🔥 FIX DISINI
        $peminjamanUser = Peminjaman::where('mahasiswa_id', Auth::id())
            ->where('status', 'dipinjam')
            ->get();

        $lateBorrow = false;

        foreach ($peminjamanUser as $item) {
            $tanggalPinjam = Carbon::parse($item->tanggal_pinjam);
            $selisihHari = $tanggalPinjam->diffInDays(now());

            if ($selisihHari >= 7) {
                $lateBorrow = true;
                break;
            }
        }

        return view('mahasiswa.dashboard.index', compact(
            'jumlahAlat',
            'alatDipinjam',
            'alatTersedia',
            'jumlahMahasiswa',
            'lateBorrow'
        ));
    }
}
