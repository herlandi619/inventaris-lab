<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        // Query pengembalian beserta relasi peminjaman, mahasiswa, dan alat
        $query = Pengembalian::with(['peminjaman.mahasiswa', 'peminjaman.alat']);

        // Filter search
        if($request->has('search')){
            $search = $request->search;
            $query->whereHas('peminjaman.mahasiswa', function($q) use ($search){
                $q->where('name','like',"%$search%")
                ->orWhere('nim','like',"%$search%");
            })->orWhereHas('peminjaman.alat', function($q) use ($search){
                $q->where('nama_alat','like',"%$search%")
                ->orWhere('kode_alat','like',"%$search%");
            });
        }

        // Pagination
        $pengembalian = $query->orderBy('id','desc')->paginate(10);

        // Ambil data peminjaman yang statusnya 'dipinjam'
        // Digunakan untuk tombol 'Tambah Pengembalian' atau dropdown di form
        $peminjaman = \App\Models\Peminjaman::with(['mahasiswa','alat'])
                        ->where('status','dipinjam')
                        ->orderBy('tanggal_pinjam','asc')
                        ->get();

        return view('laboran.pengembalians.index', compact('pengembalian','peminjaman'));
    }

    public function create(Peminjaman $peminjaman)
    {
        return view('laboran.pengembalians.create',compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id'=>'required',
            'tanggal_dikembalikan'=>'required|date',
            'kondisi_setelah'=>'nullable',
            'catatan'=>'nullable'
        ]);

        Pengembalian::create([
            'peminjaman_id'=>$request->peminjaman_id,
            'tanggal_dikembalikan'=>$request->tanggal_dikembalikan,
            'kondisi_setelah'=>$request->kondisi_setelah,
            'catatan'=>$request->catatan
        ]);

        $peminjaman = Peminjaman::with('alat')->findOrFail($request->peminjaman_id);

        // update status peminjaman
        $peminjaman->update([
            'status'=>'dikembalikan'
        ]);

        // stok alat bertambah
        $peminjaman->alat->increment('stok');

        return redirect()->route('laboran.pengembalian.index')
                ->with('success','Pengembalian berhasil disimpan');
    }
}
