@extends('layouts.laboran')

@section('content')

<div class="p-4 sm:p-6">

    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-5">

        {{-- Judul --}}
        <h1 class="text-lg sm:text-xl font-bold mb-4 text-gray-700">
            Detail Alat
        </h1>

        {{-- Data alat --}}
        <div class="space-y-2 text-sm sm:text-base text-gray-600">

            <div class="flex justify-between border-b pb-1">
                <span class="font-semibold">Nama Alat</span>
                <span>{{ $alat->nama_alat }}</span>
            </div>

            <div class="flex justify-between border-b pb-1">
                <span class="font-semibold">Kode</span>
                <span>{{ $alat->kode_alat }}</span>
            </div>

            <div class="flex justify-between border-b pb-1">
                <span class="font-semibold">Kategori</span>
                <span>{{ $alat->kategori }}</span>
            </div>

            <div class="flex justify-between border-b pb-1">
                <span class="font-semibold">Stok</span>
                <span>{{ $alat->stok }}</span>
            </div>

            <div class="flex justify-between border-b pb-1">
                <span class="font-semibold">Lokasi</span>
                <span>{{ $alat->lokasi }}</span>
            </div>

            <div class="flex justify-between">
                <span class="font-semibold">Kondisi</span>
                <span>{{ $alat->kondisi }}</span>
            </div>

        </div>

        {{-- Barcode --}}
        <div class="mt-6 text-center">

            <p class="font-semibold text-gray-700 mb-2">
                Barcode Alat
            </p>

            <div class="flex justify-center">
                {!! DNS1D::getBarcodeHTML($alat->kode_alat,'C128') !!}
            </div>

        </div>

        {{-- Tombol --}}
        <div class="mt-6 flex justify-center sm:justify-end">

            <a href="{{ route('laboran.alat.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-md text-sm">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection