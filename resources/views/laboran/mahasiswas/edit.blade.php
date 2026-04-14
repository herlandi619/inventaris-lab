@extends('layouts.laboran')

@section('content')

<div class="p-6">

<h1 class="text-2xl font-bold mb-6">
Edit Mahasiswa
</h1>

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif


<div class="bg-white shadow rounded p-6">

<form action="{{ route('laboran.mahasiswa.update',$mahasiswa->id) }}" method="POST">

@csrf
@method('PUT')


{{-- Nama --}}
<div class="mb-4">
<label class="block font-semibold mb-1">
Nama Mahasiswa
</label>

<input type="text"
name="name"
value="{{ $mahasiswa->name }}"
class="w-full border rounded px-3 py-2"
required>
</div>


{{-- NIM --}}
<div class="mb-4">
<label class="block font-semibold mb-1">
NIM
</label>

<input type="text"
name="nim"
value="{{ $mahasiswa->nim }}"
class="w-full border rounded px-3 py-2">
</div>


{{-- Email --}}
<div class="mb-4">
<label class="block font-semibold mb-1">
Email
</label>

<input type="email"
name="email"
value="{{ $mahasiswa->email }}"
class="w-full border rounded px-3 py-2"
required>
</div>


{{-- Status Aktif --}}
<div class="mb-4">
<label class="block font-semibold mb-1">
Status Akun
</label>

<select name="is_active"
class="w-full border rounded px-3 py-2">

<option value="1"
{{ $mahasiswa->is_active == 1 ? 'selected' : '' }}>
Aktif
</option>

<option value="0"
{{ $mahasiswa->is_active == 0 ? 'selected' : '' }}>
Nonaktif
</option>

</select>
</div>


{{-- Password --}}
<div class="mb-4">
<label class="block font-semibold mb-1">
Password (kosongkan jika tidak diubah)
</label>

<input type="password"
name="password"
class="w-full border rounded px-3 py-2">
</div>


{{-- Button --}}
<div class="flex gap-3">

<button type="submit"
class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
Update
</button>

<a href="{{ route('laboran.mahasiswa.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
Kembali
</a>

</div>

</form>

</div>

</div>

@endsection