@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

<h1 class="text-xl md:text-2xl font-bold mb-4">
Manajemen Mahasiswa
</h1>

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">

<a href="{{ route('laboran.mahasiswa.create') }}"
class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm w-full md:w-auto text-center">
Tambah Mahasiswa
</a>

<form method="GET" class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">

<input type="text"
name="search"
value="{{ $search }}"
placeholder="Cari nama / nim / email"
class="border px-3 py-2 rounded w-full">

<button class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded">
Search
</button>

</form>

</div>


<div class="bg-white shadow rounded overflow-x-auto">

<table class="min-w-full text-sm">

<thead class="bg-gray-100 text-left">

<tr>

<th class="p-3">No</th>
<th class="p-3">Nama</th>
<th class="p-3">NIM</th>
<th class="p-3">Email</th>
<th class="p-3">Status</th>
<th class="p-3">Aksi</th>

</tr>

</thead>

<tbody>

@foreach($mahasiswa as $item)

<tr class="border-t">

<td class="p-3 whitespace-nowrap">
{{ $loop->iteration + $mahasiswa->firstItem() - 1 }}
</td>

<td class="p-3 whitespace-nowrap">
{{ $item->name }}
</td>

<td class="p-3 whitespace-nowrap">
{{ $item->nim }}
</td>

<td class="p-3 whitespace-nowrap">
{{ $item->email }}
</td>

<td class="p-3">

@if($item->is_active)

<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
Aktif
</span>

@else

<span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
Nonaktif
</span>

@endif

</td>

<td class="p-3">

<div class="flex flex-wrap gap-2">

<a href="{{ route('laboran.mahasiswa.edit',$item->id) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs">
Edit
</a>

<form method="POST"
action="{{ route('laboran.mahasiswa.delete',$item->id) }}"
class="delete-form">

@csrf
@method('DELETE')

<button
class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
Hapus
</button>

</form>

@if(!$item->is_active)

<form method="POST"
action="{{ route('laboran.mahasiswa.aktifkan',$item->id) }}"
class="aktif-form">

@csrf
@method('PATCH')

<button
class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs">
Aktifkan
</button>

</form>

@else

<form method="POST"
action="{{ route('laboran.mahasiswa.nonaktifkan',$item->id) }}"
class="nonaktif-form">

@csrf
@method('PATCH')

<button
class="bg-gray-600 hover:bg-gray-700 text-white px-2 py-1 rounded text-xs">
Nonaktifkan
</button>

</form>

@endif

</div>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>


<div class="mt-4">

{{ $mahasiswa->links() }}

</div>

</div>


{{-- SweetAlert CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

// DELETE
document.querySelectorAll('.delete-form').forEach(form => {

form.addEventListener('submit', function(e){

e.preventDefault()

Swal.fire({
title: 'Yakin ingin menghapus?',
text: "Data mahasiswa akan dihapus!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#d33',
cancelButtonColor: '#3085d6',
confirmButtonText: 'Ya, hapus'
}).then((result) => {

if (result.isConfirmed) {
form.submit()
}

})

})

})


// AKTIFKAN
document.querySelectorAll('.aktif-form').forEach(form => {

form.addEventListener('submit', function(e){

e.preventDefault()

Swal.fire({
title: 'Aktifkan mahasiswa?',
icon: 'question',
showCancelButton: true,
confirmButtonText: 'Ya'
}).then((result) => {

if (result.isConfirmed) {
form.submit()
}

})

})

})


// NONAKTIFKAN
document.querySelectorAll('.nonaktif-form').forEach(form => {

form.addEventListener('submit', function(e){

e.preventDefault()

Swal.fire({
title: 'Nonaktifkan mahasiswa?',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Ya'
}).then((result) => {

if (result.isConfirmed) {
form.submit()
}

})

})

})

</script>


{{-- ALERT SUCCESS --}}
@if(session('success'))

<script>

Swal.fire({
icon: 'success',
title: 'Berhasil',
text: '{{ session('success') }}',
timer: 2000,
showConfirmButton: false
})

</script>

@endif

@endsection