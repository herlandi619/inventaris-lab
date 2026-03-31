@extends('layouts.laboran')

@section('title','Barcode Alat')

@section('content')

<div class="p-4 md:p-6">

    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 text-center">

        {{-- Judul --}}
        <h1 class="text-lg md:text-xl font-bold mb-4 text-gray-700">
            Barcode Alat
        </h1>

        {{-- Nama alat --}}
        <h2 class="font-semibold text-gray-800 mb-3">
            {{ $alat->nama_alat }}
        </h2>

        {{-- QR Code --}}
        <div class="flex justify-center mb-4">

            <div class="bg-white p-3 border rounded">
                {!! QrCode::size(200)->generate(url('/laboran/show/'.$alat->kode_alat)) !!}
            </div>

        </div>

        {{-- Info --}}
        <p class="text-sm text-gray-600 mb-6">
            Scan QR Code untuk melihat detail alat
        </p>

        {{-- Tombol --}}
        <div class="flex flex-col sm:flex-row justify-center gap-2">

            <button onclick="window.print()"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                Print Barcode
            </button>

            <a href="{{ url('/laboran/show/'.$alat->kode_alat) }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                Lihat Detail
            </a>

        </div>

    </div>

</div>

@endsection