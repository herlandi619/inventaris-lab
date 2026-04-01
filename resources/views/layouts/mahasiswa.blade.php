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
<a href="#"
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


<div class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg border">

<a href="{{ route('profile.edit') }}"
class="block px-4 py-2 hover:bg-gray-100">

Profile

</a>

<form method="POST" action="{{ route('logout') }}">

@csrf

<button
class="w-full text-left px-4 py-2 hover:bg-gray-100">

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