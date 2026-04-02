@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

{{-- HEADER --}}
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 border-b pb-4">

<h1 class="text-2xl font-bold text-gray-800">
📄 Laporan Peminjaman
</h1>

</div>



{{-- FILTER CARD --}}
<div class="bg-white shadow-md rounded-lg p-5 mb-6">

<form method="GET">

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">

{{-- SEARCH --}}
<div>
<label class="text-sm font-semibold text-gray-600">
Search
</label>

<input type="text"
name="search"
placeholder="Cari mahasiswa / alat"
value="{{ request('search') }}"
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


{{-- BUTTON --}}
<div class="flex items-end gap-2 flex-wrap">

<button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
Filter
</button>

<a href="{{ route('laboran.laporan.peminjaman') }}"
class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
Reset
</a>

<a href="{{ route('laboran.laporan.peminjaman.export',[
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
<th class="px-5 py-3 font-semibold">Mahasiswa</th>
<th class="px-5 py-3 font-semibold">Alat</th>
<th class="px-5 py-3 font-semibold">Tanggal Pinjam</th>
<th class="px-5 py-3 font-semibold">Tanggal Kembali</th>
<th class="px-5 py-3 font-semibold">Status</th>

</tr>

</thead>

<tbody class="text-gray-700">

@forelse($peminjaman as $p)

<tr class="border-t hover:bg-gray-50">

<td class="px-5 py-3">
{{ $loop->iteration + ($peminjaman->currentPage()-1)*$peminjaman->perPage() }}
</td>

<td class="px-5 py-3 font-medium">
{{ $p->mahasiswa->name }}
</td>

<td class="px-5 py-3">
{{ $p->alat->nama_alat }}
</td>

<td class="px-5 py-3">
{{ $p->tanggal_pinjam }}
</td>

<td class="px-5 py-3">
{{ $p->tanggal_kembali }}
</td>

<td class="px-5 py-3">
<span class="px-2 py-1 rounded text-xs
@if($p->status=='dipinjam') bg-yellow-100 text-yellow-700
@elseif($p->status=='dikembalikan') bg-green-100 text-green-700
@else bg-gray-100 text-gray-700
@endif
">
{{ $p->status }}
</span>
</td>

</tr>

@empty

<tr>
<td colspan="6" class="text-center py-8 text-gray-400">
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
{{ $peminjaman->withQueryString()->links() }}
</div>

</div>

@endsection