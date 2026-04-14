@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">

        <h1 class="text-xl font-bold">
            Manajemen Maintenance Alat
        </h1>

        <a href="{{ route('laboran.maintenance.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm text-center">
            Tambah Maintenance
        </a>

    </div>

    {{-- Search --}}
    <form method="GET" class="mb-4">

        <input type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Cari nama alat / teknisi..."
        class="border p-2 rounded w-full md:w-80 focus:outline-none focus:ring focus:ring-blue-200">

    </form>

    {{-- Table --}}
    <div class="bg-white rounded shadow overflow-x-auto">

        <table class="min-w-full text-sm text-left">

            <thead class="bg-gray-100 text-gray-700">

                <tr>
                    <th class="p-3">Nama Alat</th>
                    <th class="p-3">Ruangan</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Jenis</th>
                    <th class="p-3">Teknisi</th>
                    <th class="p-3">Biaya</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($maintenances as $m)

                <tr class="border-t hover:bg-gray-50">

                    <td class="p-3">
                        {{ $m->alat->nama_alat ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $m->ruangan ?? '-' }}
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($m->tanggal_maintenance)->format('d-m-Y') }}
                    </td>

                    <td class="p-3">
                        {{ $m->jenis }}
                    </td>

                    <td class="p-3">
                        {{ $m->teknisi ?? '-' }}
                    </td>

                    <td class="p-3">
                        Rp {{ number_format($m->biaya ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="p-3">
                        @if($m->status == 'Selesai')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                Selesai
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                                Proses
                            </span>
                        @endif
                    </td>

                    <td class="p-3">

                        <div class="flex flex-wrap gap-2 justify-center">

                            {{-- Detail --}}
                            {{-- <a href="{{ route('laboran.maintenance.show', $m->id) }}"
                            class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded text-xs">
                                Detail
                            </a> --}}

                            {{-- Edit --}}
                            <a href="{{ route('laboran.maintenance.edit', $m->id) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                Ubah
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('laboran.maintenance.delete', $m->id) }}" method="POST" class="form-delete">

                                @csrf
                                @method('DELETE')

                                <button type="button"
                                class="btn-delete bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        Belum ada data maintenance.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $maintenances->links() }}
    </div>

</div>

{{-- SWEET ALERT CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- ALERT SUCCESS --}}
@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function(){
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
});
</script>
@endif

{{-- DELETE CONFIRM --}}
<script>
document.addEventListener("DOMContentLoaded", function(){

    document.querySelectorAll('.btn-delete').forEach(button => {

        button.addEventListener('click', function(){

            let form = this.closest('form');

            Swal.fire({
                title: 'Yakin?',
                text: "Data maintenance akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });

    });

});
</script>

@endsection