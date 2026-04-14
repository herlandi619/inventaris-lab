@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

    <h1 class="text-xl md:text-2xl font-bold mb-6">
        Edit Maintenance Alat
    </h1>

    <div class="bg-white shadow rounded p-4 md:p-6 max-w-xl mx-auto">

        <form action="{{ route('laboran.maintenance.update', $maintenance->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Alat --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Pilih Alat</label>
                <select name="alat_id" class="border w-full px-3 py-2 rounded" required>
                    @foreach($alat as $a)
                        <option value="{{ $a->id }}" {{ $maintenance->alat_id == $a->id ? 'selected' : '' }}>
                            {{ $a->nama_alat }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Ruangan --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Ruangan</label>
                <input type="text" name="ruangan"
                value="{{ $maintenance->ruangan }}"
                class="border w-full px-3 py-2 rounded" required>
            </div>

            {{-- Tanggal --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Tanggal Maintenance</label>
                <input type="date" name="tanggal_maintenance"
                value="{{ $maintenance->tanggal_maintenance }}"
                class="border w-full px-3 py-2 rounded" required>
            </div>

            {{-- Jenis --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Jenis</label>
                <select name="jenis" class="border w-full px-3 py-2 rounded" required>
                    <option value="Perawatan Rutin" {{ $maintenance->jenis == 'Perawatan Rutin' ? 'selected' : '' }}>Perawatan Rutin</option>
                    <option value="Perbaikan" {{ $maintenance->jenis == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                </select>
            </div>

            {{-- Teknisi --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Teknisi</label>
                <input type="text" name="teknisi"
                value="{{ $maintenance->teknisi }}"
                class="border w-full px-3 py-2 rounded">
            </div>

            {{-- Biaya --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Biaya</label>
                <input type="number" name="biaya"
                value="{{ $maintenance->biaya }}"
                class="border w-full px-3 py-2 rounded">
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="border w-full px-3 py-2 rounded" required>
                    <option value="Proses" {{ $maintenance->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ $maintenance->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                class="border w-full px-3 py-2 rounded">{{ $maintenance->deskripsi }}</textarea>
            </div>

            <div class="flex gap-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update
                </button>

                <a href="{{ route('laboran.maintenance.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

@endsection