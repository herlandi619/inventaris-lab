@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

    <h1 class="text-xl md:text-2xl font-bold mb-6">
        Tambah Maintenance Alat
    </h1>

    <div class="bg-white shadow rounded p-4 md:p-6 max-w-xl mx-auto">

        <form action="{{ route('laboran.maintenance.store') }}" method="POST">
            @csrf

            {{-- Pilih Alat --}}
            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Pilih Alat
                </label>

                <select name="alat_id"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                required>
                    <option value="">-- Pilih Alat --</option>

                    @foreach($alat as $a)
                        <option value="{{ $a->id }}">
                            {{ $a->nama_alat }} ({{ $a->kode_alat }})
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Nama Ruangan
                </label>

                <input type="text"
                name="ruangan"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                placeholder="Contoh: Lab Farmasi Lt.2"
                required>
            </div>

            {{-- Tanggal Maintenance --}}
            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Tanggal Maintenance
                </label>

                <input type="date"
                name="tanggal_maintenance"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                required>
            </div>



            {{-- Jenis Maintenance --}}
            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Jenis Maintenance
                </label>

                <select name="jenis"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Perawatan Rutin">Perawatan Rutin</option>
                    <option value="Perbaikan">Perbaikan</option>
                </select>
            </div>

            {{-- Teknisi --}}
            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Teknisi / Petugas
                </label>

                <input type="text"
                name="teknisi"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                placeholder="Masukkan nama teknisi / petugas">
            </div>

            {{-- Biaya --}}
            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Biaya Maintenance
                </label>

                <input type="number"
                name="biaya"
                min="0"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                placeholder="Contoh: 50000">
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Status
                </label>

                <select name="status"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block font-medium mb-1 text-sm md:text-base">
                    Deskripsi / Catatan
                </label>

                <textarea name="deskripsi"
                rows="4"
                class="border w-full px-3 py-2 rounded text-sm md:text-base"
                placeholder="Contoh: Kalibrasi ulang timbangan, ganti kabel, pembersihan alat..."></textarea>
            </div>

            {{-- Tombol --}}
            <div class="flex flex-col md:flex-row gap-3">

                <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full md:w-auto">
                    Simpan Maintenance
                </button>

                <a href="{{ route('laboran.maintenance.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-center w-full md:w-auto">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection