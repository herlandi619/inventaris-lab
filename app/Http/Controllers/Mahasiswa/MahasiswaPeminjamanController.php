<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaPeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_kembali' => 'nullable|date|after_or_equal:today', // bisa dikosongkan
        ]);

        $peminjaman = Peminjaman::create([
            'mahasiswa_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => Carbon::now()->toDateString(), // waktu sekarang
            'tanggal_kembali' => $request->tanggal_kembali ?? null, // jika kosong, tetap null
            'status' => 'menunggu', // default status
        ]);

        return redirect()->route('mahasiswa.alat.index')
                         ->with('success', 'Alat berhasil dipinjam!');
    }

    public function status(Request $request)
    {
        $search = $request->input('search');

        $peminjaman = Peminjaman::where('mahasiswa_id', auth()->id())
                        ->when($search, function($query, $search){
                            $query->whereHas('alat', function($q) use ($search){
                                $q->where('nama_alat', 'like', "%$search%");
                            });
                        })
                        ->with('alat','pengembalian')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('mahasiswa.peminjaman.status', compact('peminjaman', 'search'));
    }
}
