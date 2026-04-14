<?php

namespace App\Http\Controllers\Laboran;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;

        $mahasiswa = User::where('role','mahasiswa')

        ->when($search,function($query) use ($search){

            $query->where('name','like',"%$search%")
            ->orWhere('nim','like',"%$search%")
            ->orWhere('email','like',"%$search%");

        })

        ->latest()->paginate(10);

        return view('laboran.mahasiswas.index',compact('mahasiswa','search'));

    }


    public function create()
    {

        return view('laboran.mahasiswas.create');

    }


    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'nim'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        User::create([
            'name'=>$request->name,
            'nim'=>$request->nim,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'mahasiswa',
            'is_active'=>1
        ]);

        return redirect()->route('laboran.mahasiswa.index')
        ->with('success','Mahasiswa berhasil ditambahkan');

    }


    public function edit($id)
    {

        $mahasiswa = User::findOrFail($id);

        return view('laboran.mahasiswas.edit',compact('mahasiswa'));

    }


    public function update(Request $request,$id)
    {

        $mahasiswa = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'is_active' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'is_active' => $request->is_active
        ];

        // jika password diisi maka update password
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $mahasiswa->update($data);

        return redirect()->route('laboran.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate');

    }


    public function destroy($id)
    {

        $mahasiswa = User::findOrFail($id);

        $mahasiswa->delete();

        return back()->with('success','Mahasiswa berhasil dihapus');

    }


    public function aktifkan($id)
    {

        $user = User::findOrFail($id);

        $user->update([
            'is_active'=>1
        ]);

        return back();

    }


    public function nonaktifkan($id)
    {
        

        $user = User::findOrFail($id);

        $user->update([
            'is_active'=>0
        ]);

        return back();

    }
}
