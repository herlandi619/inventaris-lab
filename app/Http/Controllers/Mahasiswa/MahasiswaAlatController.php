<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class MahasiswaAlatController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;

        $alat = Alat::when($search,function($query,$search){

            $query->where('nama_alat','like',"%$search%")
                  ->orWhere('kode_alat','like',"%$search%")
                  ->orWhere('kategori','like',"%$search%");

        })->paginate(10);

        return view('mahasiswa.alat.index',compact('alat','search'));

    }


    public function show($kode)
    {

        $alat = Alat::where('kode_alat',$kode)->firstOrFail();

        return view('mahasiswa.alat.show',compact('alat'));

    }

    public function scanQr()
    {
        return view('mahasiswa.alat.scan.scan');
    }
    
}
