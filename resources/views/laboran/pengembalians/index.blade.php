@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

<h1 class="text-xl md:text-2xl font-bold mb-4">
Data Pengembalian Alat
</h1>


{{-- SEARCH --}}
<form method="GET" class="mb-4">

<div class="flex flex-col md:flex-row gap-2">

<input type="text"
name="search"
value="{{ request('search') }}"
placeholder="Cari mahasiswa atau alat..."
class="border px-3 py-2 rounded w-full md:w-64">

<button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
Search
</button>

</div>

</form>



{{-- DAFTAR PEMINJAMAN YANG BELUM DIKEMBALIKAN --}}
@if($peminjaman->count())

<div class="bg-yellow-50 border p-4 rounded mb-6">

<h2 class="font-semibold mb-3 text-sm md:text-base">
Peminjaman Belum Dikembalikan
</h2>

<div class="overflow-x-auto">

<table class="min-w-full border text-sm">

<thead class="bg-gray-100">

<tr>

<th class="border px-3 py-2">Mahasiswa</th>
<th class="border px-3 py-2">Alat</th>
<th class="border px-3 py-2">Tanggal Pinjam</th>
<th class="border px-3 py-2">Aksi</th>

</tr>

</thead>

<tbody>

@foreach($peminjaman as $pinjam)

<tr>

<td class="border px-3 py-2 whitespace-nowrap">
{{ $pinjam->mahasiswa->name }}
</td>

<td class="border px-3 py-2 whitespace-nowrap">
{{ $pinjam->alat->nama_alat }}
</td>

<td class="border px-3 py-2 whitespace-nowrap">
{{ $pinjam->tanggal_pinjam }}
</td>

<td class="border px-3 py-2">

<a href="{{ route('laboran.pengembalian.create',$pinjam->id) }}"
class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs md:text-sm">

Tambah

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endif




{{-- TABEL PENGEMBALIAN --}}
<div class="bg-white shadow rounded">

<div class="overflow-x-auto">

<table class="min-w-full border text-sm">

<thead class="bg-gray-100">

<tr>

<th class="border px-3 py-2">No</th>
<th class="border px-3 py-2">Mahasiswa</th>
<th class="border px-3 py-2">Alat</th>
<th class="border px-3 py-2">Tanggal</th>
<th class="border px-3 py-2">Kondisi</th>
<th class="border px-3 py-2">Catatan</th>

</tr>

</thead>

<tbody>

@foreach($pengembalian as $key => $item)

<tr>

<td class="border px-3 py-2">
{{ $pengembalian->firstItem() + $key }}
</td>

<td class="border px-3 py-2 whitespace-nowrap">
{{ $item->peminjaman->mahasiswa->name }}
</td>

<td class="border px-3 py-2 whitespace-nowrap">
{{ $item->peminjaman->alat->nama_alat }}
</td>

<td class="border px-3 py-2">
{{ $item->tanggal_dikembalikan }}
</td>

<td class="border px-3 py-2">

@if($item->kondisi_setelah == 'baik')

<span class="text-green-600 font-semibold">
Baik
</span>

@elseif($item->kondisi_setelah == 'rusak ringan')

<span class="text-yellow-600 font-semibold">
Rusak Ringan
</span>

@else

<span class="text-red-600 font-semibold">
Rusak Berat
</span>

@endif

</td>

<td class="border px-3 py-2">
{{ $item->catatan }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>



{{-- PAGINATION --}}
<div class="mt-4">

{{ $pengembalian->links() }}

</div>


</div>



{{-- SWEET ALERT --}}
@if(session('success'))

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

Swal.fire({
icon: 'success',
title: 'Berhasil',
text: '{{ session("success") }}',
timer: 2000,
showConfirmButton: false
})

</script>

@endif


@endsection