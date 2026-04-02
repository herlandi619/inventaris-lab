@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

{{-- HEADER --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 border-b pb-4">

<h1 class="text-2xl font-bold text-gray-800">
📊 Laporan Data Alat
</h1>

</div>



{{-- FILTER CARD --}}
<div class="bg-white shadow-md rounded-lg p-5 mb-6">

<form method="GET" action="{{ route('laboran.laporan.alat') }}">

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">

{{-- SEARCH --}}
<div>
<label class="text-sm font-semibold text-gray-600">
Search
</label>

<input type="text"
name="search"
value="{{ request('search') }}"
placeholder="Cari nama alat..."
class="border rounded-lg px-3 py-2 w-full focus:ring focus:ring-blue-200">
</div>


{{-- TANGGAL MULAI --}}
<div>
<label class="text-sm font-semibold text-gray-600">
Tanggal Dari
</label>

<input type="date"
name="tanggal_mulai"
value="{{ request('tanggal_mulai') }}"
class="border rounded-lg px-3 py-2 w-full focus:ring focus:ring-blue-200">
</div>


{{-- TANGGAL SELESAI --}}
<div>
<label class="text-sm font-semibold text-gray-600">
Tanggal Sampai
</label>

<input type="date"
name="tanggal_selesai"
value="{{ request('tanggal_selesai') }}"
class="border rounded-lg px-3 py-2 w-full focus:ring focus:ring-blue-200">
</div>


{{-- BUTTON AREA --}}
<div class="flex items-end gap-2 flex-wrap">

<button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
Filter
</button>

<a href="{{ route('laboran.laporan.alat') }}"
class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
Reset
</a>

<a href="{{ route('laboran.laporan.alat.export',[
'tanggal_mulai'=>request('tanggal_mulai'),
'tanggal_selesai'=>request('tanggal_selesai')
]) }}"
class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
Export PDF
</a>

</div>

</div>

</form>

</div>



{{-- TABLE CARD --}}
<div class="bg-white shadow-md rounded-lg overflow-hidden">

<div class="overflow-x-auto">

<table class="w-full text-sm text-left">

<thead class="bg-gray-100 text-gray-700">

<tr>

<th class="px-5 py-3 font-semibold">No</th>
<th class="px-5 py-3 font-semibold">Nama Alat</th>
<th class="px-5 py-3 font-semibold">Kode Alat</th>
<th class="px-5 py-3 font-semibold">Kategori</th>
<th class="px-5 py-3 font-semibold">Stok</th>
<th class="px-5 py-3 font-semibold">Kondisi</th>
<th class="px-5 py-3 font-semibold">Tanggal Input</th>

</tr>

</thead>

<tbody class="text-gray-700">

@forelse($alat as $item)

<tr class="border-t hover:bg-gray-50 transition">

<td class="px-5 py-3">
{{ $loop->iteration + ($alat->currentPage()-1)*$alat->perPage() }}
</td>

<td class="px-5 py-3 font-medium">
{{ $item->nama_alat }}
</td>

<td class="px-5 py-3">
{{ $item->kode_alat }}
</td>

<td class="px-5 py-3">
{{ $item->kategori }}
</td>

<td class="px-5 py-3">
{{ $item->stok }}
</td>

<td class="px-5 py-3">
{{ $item->kondisi }}
</td>

<td class="px-5 py-3">
{{ $item->created_at->format('d-m-Y') }}
</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-8 text-gray-400">
Data tidak ditemukan
</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>



{{-- PAGINATION --}}
<div class="mt-6">
{{ $alat->withQueryString()->links() }}
</div>

</div>



{{-- SWEET ALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))

<script>

Swal.fire({
icon: 'success',
title: 'Berhasil',
text: "{{ session('success') }}",
showConfirmButton: false,
timer: 2000
})

</script>

@endif

@endsection