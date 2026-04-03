@extends('layouts.mahasiswa')

@section('content')
<div class="max-w-6xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Status Peminjaman</h1>

    {{-- Search --}}
    <form method="GET" class="mb-4 flex flex-col sm:flex-row sm:items-center sm:gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ $search ?? '' }}" 
            placeholder="Cari nama alat..." 
            class="border px-3 py-2 rounded w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
        <button 
            type="submit" 
            class="mt-2 sm:mt-0 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
            Cari
        </button>
    </form>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session("success") }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border shadow-sm rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border text-left">No</th>
                    <th class="px-4 py-2 border text-left">Nama Alat</th>
                    <th class="px-4 py-2 border text-left">Tanggal Pinjam</th>
                    <th class="px-4 py-2 border text-left">Tanggal Kembali</th>
                    <th class="px-4 py-2 border text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $item)
                    <tr class="text-center border-b hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $loop->iteration + ($peminjaman->currentPage()-1)*10 }}</td>
                        <td class="px-4 py-2 border">{{ $item->alat->nama_alat }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 border">
                            @if($item->pengembalian)
                                {{ \Carbon\Carbon::parse($item->pengembalian->tanggal_dikembalikan)->format('d-m-Y') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            @if($item->status == 'menunggu')
                                <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded inline-block">Menunggu</span>
                            @elseif($item->status == 'disetujui')
                                <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded inline-block">Disetujui</span>
                            @elseif($item->status == 'ditolak')
                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded inline-block">Ditolak</span>
                            @elseif($item->status == 'dipinjam')
                                <span class="bg-purple-200 text-purple-800 px-2 py-1 rounded inline-block">Dipinjam</span>
                            @elseif($item->status == 'dikembalikan')
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded inline-block">Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 border text-center text-gray-500">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $peminjaman->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection