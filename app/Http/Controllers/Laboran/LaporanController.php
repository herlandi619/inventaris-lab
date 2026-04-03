<?php

namespace App\Http\Controllers\Laboran;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    
    // LAPORAN DATA ALAT
    public function alat(Request $request)
    {

        $query = Alat::query();

        // SEARCH
        if($request->search){
            $query->where('nama_alat','like','%'.$request->search.'%');
        }

        // FILTER TANGGAL MULAI
        if($request->tanggal_mulai){
            $query->whereDate('created_at','>=',$request->tanggal_mulai);
        }

        // FILTER TANGGAL SELESAI
        if($request->tanggal_selesai){
            $query->whereDate('created_at','<=',$request->tanggal_selesai);
        }

        $alat = $query->latest()->paginate(10);

        return view('laboran.laporans.alat',compact('alat'));

    }

    public function exportAlat(Request $request)
    {

        $query = Alat::query();

        if($request->tanggal_mulai){
            $query->whereDate('created_at','>=',$request->tanggal_mulai);
        }

        if($request->tanggal_selesai){
            $query->whereDate('created_at','<=',$request->tanggal_selesai);
        }

        $alat = $query->get();

        $pdf = Pdf::loadView('laboran.laporans.pdf.alat',compact('alat'));

        return $pdf->download('laporan_alat.pdf');

    }

    public function peminjaman(Request $request)
    {

        $query = Peminjaman::with(['mahasiswa','alat']);

        // SEARCH
        if($request->search){

            $query->whereHas('mahasiswa',function($q) use ($request){
                $q->where('name','like','%'.$request->search.'%');
            })
            ->orWhereHas('alat',function($q) use ($request){
                $q->where('nama_alat','like','%'.$request->search.'%');
            });

        }

        // FILTER TANGGAL
        if($request->tanggal_mulai){
            $query->whereDate('tanggal_pinjam','>=',$request->tanggal_mulai);
        }

        if($request->tanggal_selesai){
            $query->whereDate('tanggal_pinjam','<=',$request->tanggal_selesai);
        }

        $peminjaman = $query->latest()->paginate(10);

        return view('laboran.laporans.peminjamans.index',compact('peminjaman'));
    }



    public function exportPeminjaman(Request $request)
    {

        $query = Peminjaman::with(['mahasiswa','alat']);

        if($request->tanggal_mulai){
            $query->whereDate('tanggal_pinjam','>=',$request->tanggal_mulai);
        }

        if($request->tanggal_selesai){
            $query->whereDate('tanggal_pinjam','<=',$request->tanggal_selesai);
        }

        $peminjaman = $query->get();

        $pdf = Pdf::loadView('laboran.laporans.pdf.peminjaman',compact('peminjaman'));

        return $pdf->download('laporan_peminjaman.pdf');

    }

    

    // public function pengembalian(Request $request)
    // {

    //     $query = Pengembalian::with(['peminjaman.mahasiswa','peminjaman.alat']);

    //     // SEARCH
    //     if($request->search){

    //         $query->whereHas('peminjaman.mahasiswa',function($q) use ($request){
    //             $q->where('name','like','%'.$request->search.'%');
    //         })
    //         ->orWhereHas('peminjaman.alat',function($q) use ($request){
    //             $q->where('nama_alat','like','%'.$request->search.'%');
    //         });

    //     }

    //     // FILTER TANGGAL
    //     if($request->tanggal_mulai){
    //         $query->whereDate('tanggal_dikembalikan','>=',$request->tanggal_mulai);
    //     }

    //     if($request->tanggal_selesai){
    //         $query->whereDate('tanggal_dikembalikan','<=',$request->tanggal_selesai);
    //     }

    //     $pengembalian = $query->latest()->paginate(10);

    //     return view('laboran.laporans.pengembalians.index',compact('pengembalian'));
    // }

    public function pengembalian(Request $request)
    {
        $query = Pengembalian::with(['peminjaman.mahasiswa','peminjaman.alat']);

        // SEARCH
        if($request->search){
            $query->whereHas('peminjaman.mahasiswa', function($q) use ($request){
                $q->where('name','like','%'.$request->search.'%');
            })
            ->orWhereHas('peminjaman.alat', function($q) use ($request){
                $q->where('nama_alat','like','%'.$request->search.'%');
            });
        }

        // FILTER TANGGAL PENGEMBALIAN
        if($request->tanggal_mulai){
            $query->whereDate('tanggal_dikembalikan','>=',$request->tanggal_mulai);
        }

        if($request->tanggal_selesai){
            $query->whereDate('tanggal_dikembalikan','<=',$request->tanggal_selesai);
        }

        // Ambil data dengan relasi, termasuk tanggal_pinjam dan status dari peminjaman
        $pengembalian = $query->latest()->paginate(10);

        return view('laboran.laporans.pengembalians.index', compact('pengembalian'));
    }


    // public function exportPengembalian(Request $request)
    // {

    //     $query = Pengembalian::with(['peminjaman.mahasiswa','peminjaman.alat']);

    //     if($request->tanggal_mulai){
    //         $query->whereDate('tanggal_dikembalikan','>=',$request->tanggal_mulai);
    //     }

    //     if($request->tanggal_selesai){
    //         $query->whereDate('tanggal_dikembalikan','<=',$request->tanggal_selesai);
    //     }

    //     $pengembalian = $query->get();

    //     $pdf = Pdf::loadView('laboran.laporans.pdf.pengembalian',compact('pengembalian'));

    //     return $pdf->download('laporan_pengembalian.pdf');

    // }

    public function exportPengembalian(Request $request)
    {
        $query = Pengembalian::with(['peminjaman.mahasiswa','peminjaman.alat']);

        // FILTER TANGGAL
        if($request->tanggal_mulai){
            $query->whereDate('tanggal_dikembalikan','>=',$request->tanggal_mulai);
        }

        if($request->tanggal_selesai){
            $query->whereDate('tanggal_dikembalikan','<=',$request->tanggal_selesai);
        }

        $pengembalian = $query->get();

        // MEMASTIKAN DATA TANGGAL PINJAM & STATUS TERSEDIA DI VIEW
        return Pdf::loadView('laboran.laporans.pdf.pengembalian', compact('pengembalian'))
                ->download('laporan_pengembalian.pdf');
    }

}
