@extends('layouts.laboran')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Mahasiswa
    </h1>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="bg-white shadow rounded p-6">

        <form action="{{ route('laboran.mahasiswa.store') }}" method="POST">

            @csrf

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">
                    Nama Mahasiswa
                </label>

                <input type="text"
                name="name"
                class="w-full border rounded px-3 py-2"
                placeholder="Masukkan nama mahasiswa"
                required>
            </div>


            {{-- NIM --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">
                    NIM
                </label>

                <input type="text"
                name="nim"
                class="w-full border rounded px-3 py-2"
                placeholder="Masukkan NIM"
                required>
            </div>


            {{-- Email --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">
                    Email
                </label>

                <input type="email"
                name="email"
                class="w-full border rounded px-3 py-2"
                placeholder="Masukkan email"
                required>
            </div>


            {{-- Password --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">
                    Password
                </label>

                <input type="password"
                name="password"
                class="w-full border rounded px-3 py-2"
                placeholder="Masukkan password"
                required>
            </div>


            {{-- Button --}}
            <div class="flex gap-3">

                <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>

                <a href="{{ route('laboran.mahasiswa.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection