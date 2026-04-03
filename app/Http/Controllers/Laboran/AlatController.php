<?php

namespace App\Http\Controllers\Laboran;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $alat = Alat::when($search,function($query,$search){

            $query->where('nama_alat','like','%'.$search.'%')
            ->orWhere('kode_alat','like','%'.$search.'%')
            ->orWhere('kategori','like','%'.$search.'%');

        })->latest()->paginate(10);

        return view('laboran.alats.index',compact('alat','search'));
    }

    public function create()
    {
        return view('laboran.alats.create');
    }

    public function store(Request $request)
    {


        $request->validate([
            'kode_alat'=>'required|unique:alats',
            'nama_alat'=>'required',
            'stok'=>'required|integer'
        ]);

        $gambar = null;

        if($request->hasFile('gambar')){
            $gambar = $request->file('gambar')->store('alat','public');
        }

        Alat::create([
            'kode_alat'=>$request->kode_alat,
            'nama_alat'=>$request->nama_alat,
            'kategori'=>$request->kategori,
            'stok'=>$request->stok,
            'lokasi'=>$request->lokasi,
            'kondisi'=>$request->kondisi,
            'gambar'=>$gambar,
            'barcode'=>'/alat/'.$request->kode_alat,
            'deskripsi'=>$request->deskripsi,
            'tutorial_penggunaan'=>$request->tutorial_penggunaan
        ]);

        return redirect()->route('laboran.alat.index')
        ->with('success','Alat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $alat = Alat::findOrFail($id);

        return view('laboran.alats.edit',compact('alat'));
    }

    public function update(Request $request,$id)
    {
         $alat = Alat::findOrFail($id);

        if($request->hasFile('gambar')){

            if($alat->gambar){
                Storage::disk('public')->delete($alat->gambar);
            }

            $gambar = $request->file('gambar')->store('alat','public');

            $alat->gambar = $gambar;
        }

        $alat->update([
            'kode_alat'=>$request->kode_alat,
            'nama_alat'=>$request->nama_alat,
            'kategori'=>$request->kategori,
            'stok'=>$request->stok,
            'lokasi'=>$request->lokasi,
            'kondisi'=>$request->kondisi,
            'deskripsi'=>$request->deskripsi,
            'tutorial_penggunaan'=>$request->tutorial_penggunaan,
            'gambar'=>$alat->gambar
        ]);

        return redirect()->route('laboran.alat.index')
            ->with('success','Alat berhasil diupdate');
    }

    public function destroy($id)
    {

        $alat = Alat::findOrFail($id);

        if($alat->gambar){
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        return back()->with('success','Alat berhasil dihapus');
    }

    public function show($kode)
    {
        $alat = Alat::where('kode_alat',$kode)->firstOrFail();

        return view('laboran.alats.show',compact('alat'));
    }

    public function showByQr($kode)
    {
        $alat = Alat::where('kode_alat', $kode)->firstOrFail();

        // Pilih view sesuai role
        if(auth()->user()->role == 'mahasiswa') {
            return view('mahasiswa.alat.show', compact('alat'));
        } else {
            return view('laboran.alats.show', compact('alat'));
        }
    }

    public function barcode($kode)
    {
        $alat = Alat::where('kode_alat',$kode)->firstOrFail();

        return view('laboran.alats.barcode',compact('alat'));
    }



    
    
}
