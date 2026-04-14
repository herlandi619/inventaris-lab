@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

<h1 class="text-xl md:text-2xl font-bold mb-6">
Tambah Pengembalian Alat
</h1>

<div class="bg-white shadow rounded p-4 md:p-6 max-w-xl mx-auto">

<form action="{{ route('laboran.pengembalian.store') }}" method="POST">
@csrf

<input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">


{{-- Mahasiswa --}}
<div class="mb-4">
<label class="block font-medium mb-1 text-sm md:text-base">
Mahasiswa
</label>

<input type="text"
value="{{ $peminjaman->mahasiswa->name }}"
class="border w-full px-3 py-2 rounded bg-gray-100 text-sm md:text-base"
readonly>
</div>


{{-- NIM --}}
<div class="mb-4">
<label class="block font-medium mb-1 text-sm md:text-base">
NIM
</label>

<input type="text"
value="{{ $peminjaman->mahasiswa->nim }}"
class="border w-full px-3 py-2 rounded bg-gray-100 text-sm md:text-base"
readonly>
</div>


{{-- Alat --}}
<div class="mb-4">
<label class="block font-medium mb-1 text-sm md:text-base">
Nama Alat
</label>

<input type="text"
value="{{ $peminjaman->alat->nama_alat }}"
class="border w-full px-3 py-2 rounded bg-gray-100 text-sm md:text-base"
readonly>
</div>


{{-- Tanggal Pinjam --}}
<div class="mb-4">
<label class="block font-medium mb-1 text-sm md:text-base">
Tanggal Pinjam
</label>

<input type="text"
value="{{ $peminjaman->tanggal_pinjam }}"
class="border w-full px-3 py-2 rounded bg-gray-100 text-sm md:text-base"
readonly>
</div>


{{-- Tanggal Dikembalikan --}}
<div class="mb-4">
<label class="block font-medium mb-1 text-sm md:text-base">
Tanggal Dikembalikan
</label>

<input type="date"
name="tanggal_dikembalikan"
class="border w-full px-3 py-2 rounded text-sm md:text-base"
required>
</div>


{{-- Kondisi Setelah --}}
<div class="mb-4">
<label class="block font-medium mb-1 text-sm md:text-base">
Kondisi Alat Setelah Digunakan
</label>

<select name="kondisi_setelah"
class="border w-full px-3 py-2 rounded text-sm md:text-base">

<option value="">-- pilih kondisi --</option>
<option value="baik">Baik</option>
<option value="rusak ringan">Rusak Ringan</option>
<option value="rusak berat">Rusak Berat</option>

</select>
</div>


{{-- Catatan --}}
<div class="mb-4">
<label class="block font-medium mb-1 text-sm md:text-base">
Catatan
</label>

<textarea name="catatan"
rows="3"
class="border w-full px-3 py-2 rounded text-sm md:text-base"
placeholder="Contoh: kabel sedikit longgar"></textarea>
</div>


{{-- Tombol --}}
<div class="flex flex-col md:flex-row gap-3">

<button
class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full md:w-auto">
Simpan Pengembalian
</button>

<a href="{{ route('laboran.pengembalian.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded text-center w-full md:w-auto">
Kembali
</a>

</div>

</form>

</div>

</div>

@endsection