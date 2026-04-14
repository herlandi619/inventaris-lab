@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

    <div class="max-w-xl mx-auto bg-white rounded-lg shadow p-5">

        {{-- Judul --}}
        <h1 class="text-lg md:text-xl font-bold mb-5 text-gray-700">
            Tambah Alat
        </h1>

        <form action="{{ route('laboran.alat.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            {{-- Kode Alat --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Kode Alat</label>
                <input type="text" name="kode_alat"
                placeholder="Contoh: Mikroskop001"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200">
            </div>

            {{-- Nama Alat --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Nama Alat</label>
                <input type="text" name="nama_alat"
                placeholder="Masukkan nama alat"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200">
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Kategori</label>
                <input type="text" name="kategori"
                placeholder="Contoh: Farmasi"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200">
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Ruangan</label>
                <input type="text"
                name="ruangan"
                value="{{ old('ruangan', $alat->ruangan ?? '') }}"
                class="border w-full px-3 py-2 rounded"
                placeholder="Contoh: B1.101">
            </div>

            {{-- Stok --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Stok</label>
                <input type="number" name="stok"
                placeholder="Jumlah stok"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200">
            </div>

            {{-- Lokasi --}}
            {{-- <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Lokasi</label>
                <input type="text" name="lokasi"
                placeholder="Contoh: Lemari A"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200">
            </div> --}}

            {{-- Kondisi --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Kondisi</label>
                <select name="kondisi"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200">

                    <option value="baik">Baik</option>
                    <option value="rusak ringan">Rusak Ringan</option>
                    <option value="rusak berat">Rusak Berat</option>

                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi"
                rows="3"
                placeholder="Deskripsi alat"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200"></textarea>
            </div>

            {{-- Tutorial Penggunaan --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">
                    Tutorial Penggunaan
                </label>
                <textarea name="tutorial_penggunaan"
                rows="3"
                placeholder="Cara menggunakan alat"
                class="border p-2 w-full rounded focus:ring focus:ring-blue-200"></textarea>
            </div>

            {{-- Upload Gambar --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold mb-1">
                    Gambar Alat
                </label>
                <input type="file" name="gambar"
                class="border p-2 w-full rounded">
            </div>

            {{-- Tombol --}}
            <div class="flex flex-col sm:flex-row gap-2">

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                    Simpan
                </button>

                <a href="{{ route('laboran.alat.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded text-center w-full sm:w-auto">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection