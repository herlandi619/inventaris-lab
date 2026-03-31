@extends('layouts.laboran')

@section('title','Dashboard')

@section('content')



<h1 class="text-2xl font-bold mb-6">
Dashboard Inventaris Laboratorium Farmasi
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    {{-- JUMLAH ALAT --}}
    <div class="bg-white p-6 rounded-lg shadow">

        <h3 class="text-gray-500 text-sm">
            Jumlah Alat
        </h3>

        <p class="text-3xl font-bold text-blue-600">
            {{ $jumlahAlat }}
        </p>

    </div>


    {{-- ALAT DIPINJAM --}}
    <div class="bg-white p-6 rounded-lg shadow">

        <h3 class="text-gray-500 text-sm">
            Alat Dipinjam
        </h3>

        <p class="text-3xl font-bold text-red-500">
            {{ $alatDipinjam }}
        </p>

    </div>


    {{-- ALAT TERSEDIA --}}
    <div class="bg-white p-6 rounded-lg shadow">

        <h3 class="text-gray-500 text-sm">
            Alat Tersedia
        </h3>

        <p class="text-3xl font-bold text-green-600">
            {{ $alatTersedia }}
        </p>

    </div>


    {{-- MAHASISWA --}}
    <div class="bg-white p-6 rounded-lg shadow">

        <h3 class="text-gray-500 text-sm">
            Mahasiswa
        </h3>

        <p class="text-3xl font-bold text-purple-600">
            {{ $jumlahMahasiswa }}
        </p>

    </div>

</div>

@endsection