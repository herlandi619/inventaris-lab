<?php

namespace App\Http\Controllers\Laboran;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;

        $peminjaman = Peminjaman::with(['mahasiswa','alat'])
        ->when($search,function($query) use ($search){

            $query->whereHas('mahasiswa',function($q) use ($search){
                $q->where('name','like',"%$search%");
            })

            ->orWhereHas('alat',function($q) use ($search){
                $q->where('nama_alat','like',"%$search%");
            });

        })
        ->latest()
        ->paginate(10);

        return view('laboran.peminjamans.index',compact('peminjaman'));
    }


    public function setujui($id)
    {

        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        $alat = $peminjaman->alat;

        if($alat->stok <= 0){
            return back()->with('error','Stok alat tidak tersedia');
        }

        // kurangi stok
        $alat->decrement('stok',1);

        // ubah status
        $peminjaman->update([
            'status'=>'disetujui'
        ]);

        return back()->with('success','Peminjaman disetujui dan stok berkurang');
    }



    public function tolak($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status'=>'ditolak'
        ]);

        return back()->with('success','Peminjaman ditolak');
    }



    public function dipinjam($id)
    {

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status'=>'dipinjam'
        ]);

        return back()->with('success','Status diubah menjadi dipinjam');
    }
}
