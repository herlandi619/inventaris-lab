<?php

namespace App\Http\Controllers\Laboran;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Maintenance;

class DashboardLaboranController extends Controller
{
    public function index()
    {

        $jumlahAlat = Alat::count();

        $alatDipinjam = Peminjaman::where('status','dipinjam')->count();

        $alatTersedia = Peminjaman::where('status','menunggu')->count();

        $jumlahMahasiswa = User::where('role','mahasiswa')->count();

        $alatMaintenance = Maintenance::where('status', 'Proses')->count();

        $maintenanceSelesai = Maintenance::where('status', 'Selesai')->count();

        return view('dashboard',compact(
            'jumlahAlat',
            'alatDipinjam',
            'alatTersedia',
            'jumlahMahasiswa',
            'alatMaintenance',
            'maintenanceSelesai'
        ));
    }
}
