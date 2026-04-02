<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title')</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100 font-sans">

<div class="flex h-screen overflow-hidden">

{{-- OVERLAY MOBILE --}}
<div id="overlay"
class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"
onclick="toggleSidebar()">
</div>


{{-- SIDEBAR --}}
<aside id="sidebar"
class="fixed lg:static z-40 w-64 h-full bg-blue-900 text-white
transform -translate-x-full lg:translate-x-0 transition-transform duration-300">

<div class="p-6 text-center border-b border-blue-700">

<h1 class="text-lg font-bold">
Sistem Inventarisasi
</h1>

<p class="text-sm">
Laboratorium Farmasi
</p>

</div>


<nav class="p-4 space-y-2">

{{-- DASHBOARD --}}
<a href="{{ route('laboran.dashboard') }}"
class="flex items-center gap-3 px-4 py-2 rounded
{{ request()->routeIs('laboran.dashboard*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">

{{-- ICON --}}
<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M3.75 3v18h18M9 17V9m4 8V5m4 12v-6" />

</svg>

Dashboard

</a>


{{-- DATA ALAT --}}
<a href="{{ route("laboran.alat.index") }}"
class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.alat*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M6 6h12M6 12h12M6 18h12"/>

</svg>

Data Alat

</a>





{{-- MAHASISWA --}}
<a href="{{ route("laboran.mahasiswa.index") }}"
class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.mahasiswa*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M15 19a4 4 0 10-6 0m6 0H9m6 0h3m-9 0H6m6-9a4 4 0 100-8 4 4 0 000 8z"/>

</svg>

Kelola Akun

</a>

{{-- PEMINJAMAN --}}
<a href="{{ route("laboran.peminjaman.index") }}"
class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.peminjaman*') ? 'bg-blue-700' : 'hover:bg-blue-700' }}">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M8 7V3m8 4V3m-9 8h10m-12 9h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>

</svg>

Peminjaman

</a>


{{-- PENGEMBALIAN --}}
<a href="{{ route('laboran.pengembalian.index') }}"
class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.pengembalian*') ? 'bg-blue-700' : '' }}">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M9 15l-6-6m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>

</svg>

Pengembalian

</a>


{{-- LAPORAN START--}}
{{-- Dropdown Laporan --}}
<div x-data="{ open: false }">

    <button @click="open = !open"
    class="flex items-center justify-between w-full px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.laporan*') ? 'bg-blue-700' : '' }}">

        <div class="flex items-center gap-3">

            {{-- ICON LAPORAN --}}
            <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5">

            <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M9 17v-6m3 6V7m3 10v-4M6 21h12a2 2 0 002-2V5a2 2 0 00-2-2H8l-4 4v12a2 2 0 002 2z"/>

            </svg>

            <span>Laporan</span>

        </div>

        {{-- ICON PANAH --}}
        <svg xmlns="http://www.w3.org/2000/svg"
        class="w-4 h-4 transition-transform"
        :class="{ 'rotate-180': open }"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">

        <path stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M19 9l-7 7-7-7" />

        </svg>

    </button>


    {{-- Isi Dropdown --}}
    <div x-show="open" x-transition class="ml-8 mt-2 space-y-2">

        {{-- Laporan Alat --}}
        <a href="{{ route('laboran.laporan.alat') }}"
        class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.laporan.alat*') ? 'bg-blue-700' : '' }}">
        Laporan Alat
        </a>

        {{-- Laporan Peminjaman --}}
        <a href="{{ route('laboran.laporan.peminjaman') }}"
        class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.laporan.peminjaman*') ? 'bg-blue-700' : '' }}">
        Laporan Peminjaman
        </a>

        {{-- Laporan Pengembalian --}}
        <a href="{{ route('laboran.laporan.pengembalian') }}"
        class="block px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('laboran.laporan.pengembalian*') ? 'bg-blue-700' : '' }}">
        Laporan Pengembalian
        </a>

    </div>

</div>

{{-- LAPORAN END --}}

{{-- GARIS PEMISAH --}}
<div class="border-t border-gray-300"></div>

{{-- Profile & Logout START --}}
{{-- PROFILE --}}
<a href="{{ route('profile.edit') }}"
class="flex items-center gap-3 px-4 py-2 rounded hover:bg-blue-700 {{ request()->routeIs('profile.*') ? 'bg-blue-700' : '' }}">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>

</svg>

<span>Profile</span>

</a>

{{-- LOGOUT --}}
<form method="POST" action="{{ route('logout') }}">

@csrf

<button
class="w-full flex items-center gap-3 px-4 py-2 rounded hover:bg-red-600 hover:text-white">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5A2.25 2.25 0 003.75 5.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15m3-3l-3-3m3 3l-3 3m3-3H9"/>

</svg>

<span>Logout</span>

</button>

</form>


{{-- Profile & Logout END --}}


</nav>

</aside>


{{-- MAIN --}}
<div class="flex-1 flex flex-col w-full">


{{-- NAVBAR --}}
<header class="bg-white shadow p-4 flex items-center justify-between">

<div class="flex items-center gap-3">

{{-- BUTTON MOBILE --}}
<button onclick="toggleSidebar()" class="lg:hidden text-gray-700 text-xl">

☰

</button>

<h2 class="font-semibold text-lg">

@yield('title')

</h2>

</div>


{{-- PROFILE --}}
<div class="relative">

<details class="relative">

<summary class="cursor-pointer list-none flex items-center gap-2">

<div class="bg-blue-500 text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</div>

<span class="hidden md:block">

{{ Auth::user()->name }}

</span>

</summary>


<div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border overflow-hidden">

{{-- PROFILE --}}
<a href="{{ route('profile.edit') }}"
class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 text-gray-700">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>

</svg>

Profile

</a>


{{-- LOGOUT --}}
<form method="POST" action="{{ route('logout') }}">

@csrf

<button
class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-100 text-gray-700">

<svg xmlns="http://www.w3.org/2000/svg"
fill="none"
viewBox="0 0 24 24"
stroke-width="1.5"
stroke="currentColor"
class="w-5 h-5">

<path stroke-linecap="round"
stroke-linejoin="round"
d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5A2.25 2.25 0 003.75 5.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15m3-3l-3-3m3 3l-3 3m3-3H9"/>

</svg>

Logout

</button>

</form>

</div>

</details>

</div>

</header>


{{-- CONTENT --}}
<main class="p-6 overflow-y-auto flex-1">

@yield('content')

</main>

</div>

</div>


<script>

function toggleSidebar(){

const sidebar = document.getElementById('sidebar')
const overlay = document.getElementById('overlay')

sidebar.classList.toggle('-translate-x-full')
overlay.classList.toggle('hidden')

}

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>