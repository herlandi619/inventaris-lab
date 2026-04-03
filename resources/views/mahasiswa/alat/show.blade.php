@extends('layouts.mahasiswa')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">

    {{-- Judul --}}
    <h1 class="text-2xl md:text-3xl font-bold mb-6 text-gray-800">
        Detail Alat
    </h1>

    <div class="flex flex-col md:flex-row gap-6">
        {{-- Gambar Alat --}}
        <div class="flex-shrink-0 w-full md:w-1/3">
            @if($alat->gambar)
                <img src="{{ asset('storage/' . $alat->gambar) }}" 
                     alt="{{ $alat->nama_alat }}" 
                     class="rounded-lg w-full h-auto object-cover shadow-md">
            @else
                <div class="bg-gray-200 rounded-lg w-full h-48 flex items-center justify-center text-gray-500">
                    Tidak ada gambar
                </div>
            @endif
        </div>

        {{-- Info Alat --}}
        <div class="flex-1 flex flex-col justify-between">
            <h1 class="text-2xl md:text-3xl font-bold mb-4 text-gray-800">{{ $alat->nama_alat }}</h1>
            <div class="space-y-2 text-gray-700 text-sm md:text-base">
                <p><span class="font-semibold">Kode:</span> {{ $alat->kode_alat }}</p>
                <p><span class="font-semibold">Kategori:</span> {{ $alat->kategori }}</p>
                {{-- <p><span class="font-semibold">Stok:</span> {{ $alat->stok }}</p> --}}
                <p><span class="font-semibold">Lokasi:</span> {{ $alat->lokasi }}</p>
                {{-- <p><span class="font-semibold">Kondisi:</span> {{ $alat->kondisi }}</p> --}}
            </div>

            
        </div>
    </div>

    {{-- Deskripsi --}}
    @if($alat->deskripsi)
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2 text-gray-800">Deskripsi</h2>
        <p class="text-gray-700 text-sm md:text-base leading-relaxed">
            {{ $alat->deskripsi }}
        </p>
    </div>
    @endif

    {{-- Tutorial Pengguna --}}
    @if($alat->tutorial_pengguna)
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2 text-gray-800">Tutorial Pengguna</h2>
        <div class="text-gray-700 text-sm md:text-base leading-relaxed space-y-2">
            {!! nl2br(e($alat->tutorial_pengguna)) !!}
        </div>
    </div>
    @endif

    {{-- PINJAM BARANG --}}
    {{-- Tombol Peminjaman --}}
    @if(auth()->user()->role === 'mahasiswa')
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2 text-gray-800">Peminjaman Alat</h2>

        <form action="{{ route('mahasiswa.peminjaman.store') }}" method="POST" class="space-y-3 bg-gray-50 p-4 rounded shadow-sm">
            @csrf
            <input type="hidden" name="alat_id" value="{{ $alat->id }}">

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md">
                Pinjam Alat
            </button>
        </form>
    </div>
    @endif

</div>
@endsection