@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

<h1 class="text-xl md:text-2xl font-bold mb-4">
Manajemen Peminjaman
</h1>

{{-- Form Search --}}
<form method="GET" class="flex flex-col sm:flex-row gap-2 mb-4 w-full md:w-auto">

<input type="text"
name="search"
placeholder="Cari mahasiswa atau alat..."
value="{{ request('search') }}"
class="border px-3 py-2 rounded w-full sm:w-64">

<button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto">
Cari
</button>

</form>

{{-- Table --}}
<div class="bg-white shadow rounded overflow-x-auto">

<table class="min-w-full text-sm">

<thead class="bg-gray-100 text-left">

<tr>
<th class="p-3">No</th>
<th class="p-3">Mahasiswa</th>
<th class="p-3">Alat</th>
<th class="p-3">Tanggal Pinjam</th>
<th class="p-3">Tanggal Kembali</th>
<th class="p-3">Status</th>
<th class="p-3">Aksi</th>
</tr>

</thead>

<tbody>

@foreach($peminjaman as $p)
<tr class="border-b">

<td class="p-3 whitespace-nowrap">{{ $loop->iteration + $peminjaman->firstItem() - 1 }}</td>
<td class="p-3 whitespace-nowrap">{{ $p->mahasiswa->name }}</td>
<td class="p-3 whitespace-nowrap">{{ $p->alat->nama_alat }}</td>
<td class="p-3 whitespace-nowrap">{{ $p->tanggal_pinjam }}</td>
<td class="p-3 whitespace-nowrap">{{ $p->tanggal_kembali }}</td>

<td class="p-3">
<span class="px-2 py-1 text-white rounded
@if($p->status=='menunggu') bg-yellow-500
@elseif($p->status=='disetujui') bg-blue-500
@elseif($p->status=='ditolak') bg-red-500
@elseif($p->status=='dipinjam') bg-green-600
@endif">
{{ $p->status }}
</span>
</td>

<td class="p-3">

<div class="flex flex-wrap gap-2">

{{-- Menunggu --}}
@if($p->status == 'menunggu')

<form action="{{ route('laboran.peminjaman.setujui',$p->id) }}" method="POST" class="action-form">
@csrf
<button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs w-full sm:w-auto">Setujui</button>
</form>

<form action="{{ route('laboran.peminjaman.tolak',$p->id) }}" method="POST" class="action-form">
@csrf
<button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs w-full sm:w-auto">Tolak</button>
</form>

@endif

{{-- Disetujui --}}
@if($p->status == 'disetujui')

<form action="{{ route('laboran.peminjaman.dipinjam',$p->id) }}" method="POST" class="action-form">
@csrf
<button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs w-full sm:w-auto">Dipinjam</button>
</form>

@endif

</div>

</td>

</tr>
@endforeach

</tbody>
</table>

</div>

{{-- Pagination --}}
<div class="mt-4">
{{ $peminjaman->links() }}
</div>

</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Konfirmasi aksi dengan SweetAlert
document.querySelectorAll('.action-form').forEach(form => {
    form.addEventListener('submit', function(e){
        e.preventDefault();
        let button = form.querySelector('button');
        let actionText = button.textContent.trim();

        Swal.fire({
            title: `Yakin ingin ${actionText.toLowerCase()}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){
                form.submit();
            }
        });
    });
});
</script>

{{-- Session Success --}}
@if(session('success'))
<script>
Swal.fire({
icon:'success',
title:'Berhasil',
text:'{{ session('success') }}',
timer:2000,
showConfirmButton:false
});
</script>
@endif

@endsection