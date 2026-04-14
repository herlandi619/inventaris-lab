<?php

namespace App\Http\Controllers\Laboran;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Alat;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $maintenances = Maintenance::with('alat')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('alat', function ($q) use ($search) {
                    $q->where('nama_alat', 'like', "%{$search}%");
                })->orWhere('teknisi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('laboran.maintenances.index', compact('maintenances', 'search'));
    }

    public function create()
    {
        $alat = Alat::all();

        return view('laboran.maintenances.create', compact('alat'));
    }

    public function edit($id)
        {
            $maintenance = Maintenance::findOrFail($id);
            $alat = Alat::all();

            return view('laboran.maintenances.edit', compact('maintenance', 'alat'));
        }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return redirect()
            ->route('laboran.maintenance.index')
            ->with('success', 'Data maintenance berhasil dihapus');
    }
        
    public function update(Request $request, $id)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'ruangan' => 'required|string|max:255',
            'tanggal_maintenance' => 'required|date',
            'jenis' => 'required',
            'deskripsi' => 'nullable',
            'biaya' => 'nullable|numeric',
            'teknisi' => 'nullable|string|max:255',
            'status' => 'required',
        ]);

        $maintenance = Maintenance::findOrFail($id);

        $maintenance->update([
            'alat_id' => $request->alat_id,
            'ruangan' => $request->ruangan,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'biaya' => $request->biaya,
            'teknisi' => $request->teknisi,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('laboran.maintenance.index')
            ->with('success', 'Data maintenance berhasil diupdate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'ruangan' => 'required|string|max:255',
            'tanggal_maintenance' => 'required|date',
            'jenis' => 'required',
            'deskripsi' => 'nullable',
            'biaya' => 'nullable|numeric',
            'teknisi' => 'nullable|string|max:255',
            'status' => 'required',
        ]);

        Maintenance::create([
            'alat_id' => $request->alat_id,
            'ruangan' => $request->ruangan,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'jenis' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'biaya' => $request->biaya,
            'teknisi' => $request->teknisi,
            'status' => $request->status,
        ]);

        

        return redirect()
            ->route('laboran.maintenance.index')
            ->with('success', 'Data maintenance berhasil ditambahkan');
    }
}