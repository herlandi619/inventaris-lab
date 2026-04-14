@extends('layouts.laboran')

@section('title','Edit Alat')

@section('content')

<div class="p-6 max-w-4xl mx-auto bg-white shadow rounded-lg">

<h1 class="text-xl font-bold mb-6">
Edit Data Alat
</h1>

<form action="{{ route('laboran.alat.update',$alat->id) }}" 
      method="POST" 
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-4">

{{-- KODE ALAT --}}
<div>
<label class="block text-sm font-medium mb-1">
Kode Alat
</label>

<input type="text"
name="kode_alat"
value="{{ $alat->kode_alat }}"
class="w-full border rounded p-2"
required>
</div>

{{-- NAMA ALAT --}}
<div>
<label class="block text-sm font-medium mb-1">
Nama Alat
</label>

<input type="text"
name="nama_alat"
value="{{ $alat->nama_alat }}"
class="w-full border rounded p-2"
required>
</div>

{{-- KATEGORI --}}
<div>
<label class="block text-sm font-medium mb-1">
Kategori
</label>

<input type="text"
name="kategori"
value="{{ $alat->kategori }}"
class="w-full border rounded p-2">
</div>

{{-- STOK --}}
<div>
<label class="block text-sm font-medium mb-1">
Stok
</label>

<input type="number"
name="stok"
value="{{ $alat->stok }}"
class="w-full border rounded p-2">
</div>


<div class="mb-4">
    <label class="block font-medium mb-1">Ruangan</label>
    <input type="text"
    name="ruangan"
    value="{{ old('ruangan', $alat->ruangan ?? '') }}"
    class="border w-full px-3 py-2 rounded"
    placeholder="Contoh:B1.101">
</div>

{{-- LOKASI --}}
{{-- <div>
<label class="block text-sm font-medium mb-1">
Lokasi
</label>

<input type="text"
name="lokasi"
value="{{ $alat->lokasi }}"
class="w-full border rounded p-2">
</div> --}}

{{-- KONDISI --}}
<div>
<label class="block text-sm font-medium mb-1">
Kondisi
</label>

<select name="kondisi" class="w-full border rounded p-2">

<option value="baik" 
{{ $alat->kondisi == 'baik' ? 'selected' : '' }}>
Baik
</option>

<option value="rusak"
{{ $alat->kondisi == 'rusak' ? 'selected' : '' }}>
Rusak
</option>

<option value="perbaikan"
{{ $alat->kondisi == 'perbaikan' ? 'selected' : '' }}>
Perbaikan
</option>

</select>
</div>

{{-- BARCODE
<div>
<label class="block text-sm font-medium mb-1">
Barcode
</label>

<input type="text"
name="barcode"
value="{{ $alat->barcode }}"
class="w-full border rounded p-2">
</div> --}}

{{-- GAMBAR --}}
<div>
<label class="block text-sm font-medium mb-1">
Gambar Alat
</label>

<input type="file"
name="gambar"
class="w-full border rounded p-2">

@if($alat->gambar)
<img src="{{ asset('storage/'.$alat->gambar) }}" 
     class="mt-2 w-24">
@endif

</div>

</div>

{{-- DESKRIPSI --}}
<div class="mt-4">
<label class="block text-sm font-medium mb-1">
Deskripsi
</label>

<textarea name="deskripsi"
class="w-full border rounded p-2"
rows="3">{{ $alat->deskripsi }}</textarea>
</div>

{{-- TUTORIAL --}}
<div class="mt-4">
<label class="block text-sm font-medium mb-1">
Tutorial Penggunaan
</label>

<textarea name="tutorial_penggunaan"
class="w-full border rounded p-2"
rows="4">{{ $alat->tutorial_penggunaan }}</textarea>
</div>

{{-- BUTTON --}}
<div class="mt-6 flex gap-2">

<button class="bg-blue-600 text-white px-4 py-2 rounded">
Update
</button>

<a href="{{ route('laboran.alat.index') }}"
class="bg-gray-400 text-white px-4 py-2 rounded">
Batal
</a>

</div>

</form>

</div>

@endsection