@extends('layouts.mahasiswa')

@section('content')

<div class="max-w-5xl mx-auto p-4 md:p-6">

    {{-- Judul --}}
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800">
        Data Alat Laboratorium
    </h1>

    {{-- Sweet Alert --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
    @endif

    @if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: '{{ session('warning') }}',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
    @endif

    {{-- SEARCH --}}
    <form method="GET" class="flex flex-col md:flex-row gap-2 mb-4 items-start md:items-center">
        <input type="text"
               name="search"
               value="{{ $search }}"
               placeholder="Cari nama alat atau kode..."
               class="border px-3 py-2 rounded w-full md:w-64 focus:ring-2 focus:ring-blue-400 focus:outline-none">

        <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Cari
        </button>
    </form>

    {{-- Tombol Scan QR --}}
    <div class="flex justify-end mb-4">
        <a href="{{ route('mahasiswa.scan.qr') }}"
           class="inline-block px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow hover:bg-green-600 transition">
           Scan QR
        </a>
    </div>

    {{-- Tabel Alat --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full min-w-max">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left text-gray-600">Kode</th>
                    <th class="p-3 text-left text-gray-600">Nama Alat</th>
                    <th class="p-3 text-left text-gray-600">Kategori</th>
                    <th class="p-3 text-left text-gray-600">Kondisi</th>
                    <th class="p-3 text-left text-gray-600">Lokasi</th>
                    <th class="p-3 text-left text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alat as $item)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-3 text-gray-700">{{ $item->kode_alat }}</td>
                    <td class="p-3 text-gray-700">{{ $item->nama_alat }}</td>
                    <td class="p-3 text-gray-700">{{ $item->kategori }}</td>
                    <td class="p-3 text-gray-700">{{ $item->kondisi }}</td>
                    <td class="p-3 text-gray-700">{{ $item->lokasi }}</td>
                    <td class="p-3 flex flex-col md:flex-row gap-2">
                        <a href="{{ route('mahasiswa.alat.show',$item->kode_alat) }}"
                           class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition">
                           Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        Data tidak ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $alat->links() }}
    </div>

</div>

@endsection