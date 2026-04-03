@extends('layouts.laboran')

@section('content')

<div class="p-4 md:p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">

        <h1 class="text-xl font-bold">
            Manajemen Alat
        </h1>

        <a href="{{ route('laboran.alat.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm text-center">
            Tambah Alat
        </a>

    </div>

    {{-- Search --}}
    <form method="GET" class="mb-4">

        <input type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Cari alat..."
        class="border p-2 rounded w-full md:w-80 focus:outline-none focus:ring focus:ring-blue-200">

    </form>

    {{-- Table --}}
    <div class="bg-white rounded shadow overflow-x-auto">

        <table class="min-w-full text-sm text-left">

            <thead class="bg-gray-100 text-gray-700">

                <tr>
                    <th class="p-3">Kode</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3">Qr Code</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @foreach($alat as $a)

                <tr class="border-t hover:bg-gray-50">

                    <td class="p-3 whitespace-nowrap">
                        {{ $a->kode_alat }}
                    </td>

                    <td class="p-3">
                        {{ $a->nama_alat }}
                    </td>

                    <td class="p-3">
                        {{ $a->kategori }}
                    </td>

                    <td class="p-3">
                        {{ $a->stok }}
                    </td>

                    <td class="p-3 w-40">
                        <div class="overflow-hidden flex justify-center">
                            {{-- {!! DNS2D::getBarcodeHTML($a->kode_alat,'QRCODE',2,2) !!} --}}
                            {!! DNS2D::getBarcodeHTML(route('alat.showByQr', $a->kode_alat),'QRCODE',2,2) !!}
                 
                        </div>
                    </td>

                    <td class="p-3">

                        <div class="flex flex-wrap gap-2 justify-center">

                            {{-- Show --}}
                            <a href="{{ route('laboran.alat.show',$a->kode_alat) }}"
                            class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded text-xs">
                                Tampilkan
                            </a>
                            {{-- Edit --}}
                            <a href="{{ route('laboran.alat.edit',$a->id) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                                Ubah
                            </a>

                            {{-- Barcode --}}
                            <a href="{{ route('laboran.alat.barcode',$a->kode_alat) }}"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs">
                                Barcode
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('laboran.alat.delete',$a->id) }}" method="POST" class="form-delete">

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

                @endforeach

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $alat->links() }}
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
                text: "Data alat akan dihapus!",
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