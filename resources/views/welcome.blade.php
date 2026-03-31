<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventarisasi Alat Laboratorium Farmasi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2); opacity: 0; }
        }
        .float-anim { animation: float 4s ease-in-out infinite; }
        .float-anim-delay { animation: float 4s ease-in-out infinite 1.5s; }
        .blob {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: blob-morph 8s ease-in-out infinite;
        }
        @keyframes blob-morph {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);">

    <!-- Animated background blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="blob absolute w-[500px] h-[500px] top-[-100px] left-[-100px] opacity-20"
             style="background: radial-gradient(circle, #3b82f6, #06b6d4);"></div>
        <div class="blob absolute w-[400px] h-[400px] bottom-[-80px] right-[-80px] opacity-20"
             style="background: radial-gradient(circle, #8b5cf6, #ec4899); animation-delay: 4s;"></div>
        <div class="blob absolute w-[300px] h-[300px] top-[40%] left-[50%] opacity-10"
             style="background: radial-gradient(circle, #10b981, #3b82f6); animation-delay: 2s;"></div>
    </div>

    <!-- NAVBAR -->
    <nav class="relative z-50 w-full glass">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                         style="background: linear-gradient(135deg, #3b82f6, #06b6d4);">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                </div>
                <div class="hidden sm:block">
                    <p class="text-white font-bold text-sm leading-tight">Lab Farmasi</p>
                    <p class="text-blue-300 text-xs font-medium">Inventarisasi Alat</p>
                </div>
            </div>

            <!-- Nav Links (Desktop) -->
            {{-- <ul class="hidden md:flex items-center gap-8 list-none">
                <li><a href="#" class="text-white/70 hover:text-white text-sm font-medium transition-colors">Beranda</a></li>
                <li><a href="#" class="text-white/70 hover:text-white text-sm font-medium transition-colors">Tentang</a></li>
                <li><a href="#" class="text-white/70 hover:text-white text-sm font-medium transition-colors">Panduan</a></li>
                <li><a href="#" class="text-white/70 hover:text-white text-sm font-medium transition-colors">Kontak</a></li>
            </ul> --}}

            <!-- Auth Buttons -->
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-5 py-2 rounded-lg text-sm font-semibold text-white transition-all hover:opacity-90"
                           style="background: linear-gradient(135deg, #3b82f6, #06b6d4);">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-5 py-2 rounded-lg text-sm font-semibold text-white/90 hover:text-white border border-white/20 hover:border-white/40 transition-all">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-5 py-2 rounded-lg text-sm font-semibold text-white transition-all hover:opacity-90"
                               style="background: linear-gradient(135deg, #3b82f6, #06b6d4);">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile Hamburger -->
                <button id="menuBtn" class="md:hidden text-white focus:outline-none ml-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="iconOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path id="iconClose" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        {{-- <div id="mobileMenu" class="hidden md:hidden border-t border-white/10 px-6 py-4 flex flex-col gap-3">
            <a href="#" class="text-white/80 hover:text-white text-sm font-medium py-1">Beranda</a>
            <a href="#" class="text-white/80 hover:text-white text-sm font-medium py-1">Tentang</a>
            <a href="#" class="text-white/80 hover:text-white text-sm font-medium py-1">Panduan</a>
            <a href="#" class="text-white/80 hover:text-white text-sm font-medium py-1">Kontak</a>
        </div> --}}
    </nav>

    <!-- HERO SECTION -->
    <section class="relative z-10 min-h-[calc(100vh-72px)] flex items-center">
        <div class="max-w-7xl mx-auto px-6 py-16 w-full">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-16">

                <!-- Left: Text Content -->
                <div class="flex-1 text-center lg:text-left">

                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        <span class="text-green-300 text-xs font-semibold tracking-wide uppercase">Sistem Digital Terintegrasi</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
                        Sistem
                        <span style="background: linear-gradient(135deg, #60a5fa, #34d399); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Inventarisasi
                        </span>
                        <br class="hidden sm:block"/>
                        Alat Laboratorium
                        <br/>
                        <span class="text-white/80">Farmasi Berbasis Web</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-white/60 text-base lg:text-lg leading-relaxed mb-8 max-w-xl mx-auto lg:mx-0">
                        Kelola, pantau, dan lacak seluruh peralatan laboratorium farmasi Anda secara efisien dalam satu platform digital yang modern dan mudah digunakan.
                    </p>

                    <!-- Stats -->
                    <div class="flex items-center justify-center lg:justify-start gap-6 mb-10">
                        <div class="text-center">
                            <p class="text-white font-bold text-2xl">500+</p>
                            <p class="text-white/50 text-xs">Jenis Alat</p>
                        </div>
                        <div class="w-px h-10 bg-white/20"></div>
                        <div class="text-center">
                            <p class="text-white font-bold text-2xl">Real-time</p>
                            <p class="text-white/50 text-xs">Monitoring</p>
                        </div>
                        <div class="w-px h-10 bg-white/20"></div>
                        <div class="text-center">
                            <p class="text-white font-bold text-2xl">100%</p>
                            <p class="text-white/50 text-xs">Akurat</p>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                   class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-sm font-bold text-white text-center transition-all hover:opacity-90 hover:-translate-y-0.5 shadow-lg"
                                   style="background: linear-gradient(135deg, #3b82f6, #06b6d4);">
                                    Buka Dashboard →
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-sm font-bold text-white text-center transition-all hover:opacity-90 hover:-translate-y-0.5 shadow-lg"
                                   style="background: linear-gradient(135deg, #3b82f6, #06b6d4);">
                                    Masuk ke Sistem →
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-sm font-bold text-white/90 text-center border border-white/25 hover:border-white/50 hover:text-white transition-all hover:-translate-y-0.5">
                                        Buat Akun Baru
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>

                <!-- Right: Visual Card -->
                <div class="flex-1 flex justify-center lg:justify-end w-full">
                    <div class="relative w-full max-w-md">

                        <!-- Main Card -->
                        <div class="float-anim card-glass rounded-2xl shadow-2xl p-6 border border-white/20">

                            <!-- Card Header -->
                            <div class="flex items-center justify-between mb-5">
                                <div>
                                    <p class="text-gray-800 font-bold text-base">Dashboard Inventaris</p>
                                    <p class="text-gray-400 text-xs">Lab Farmasi — 2025</p>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-3 h-3 rounded-full bg-red-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-green-400"></span>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-2 gap-3 mb-5">
                                <div class="rounded-xl p-4" style="background: linear-gradient(135deg, #eff6ff, #dbeafe);">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <span class="text-blue-600 text-xs font-semibold">Total Alat</span>
                                    </div>
                                    <p class="text-gray-800 font-bold text-2xl">248</p>
                                    <p class="text-green-500 text-xs font-medium">↑ +12 bulan ini</p>
                                </div>
                                <div class="rounded-xl p-4" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7);">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-green-600 text-xs font-semibold">Kondisi Baik</span>
                                    </div>
                                    <p class="text-gray-800 font-bold text-2xl">221</p>
                                    <p class="text-green-500 text-xs font-medium">89% dari total</p>
                                </div>
                                <div class="rounded-xl p-4" style="background: linear-gradient(135deg, #fff7ed, #ffedd5);">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                        </svg>
                                        <span class="text-orange-600 text-xs font-semibold">Perlu Servis</span>
                                    </div>
                                    <p class="text-gray-800 font-bold text-2xl">18</p>
                                    <p class="text-orange-500 text-xs font-medium">7% dari total</p>
                                </div>
                                <div class="rounded-xl p-4" style="background: linear-gradient(135deg, #fef2f2, #fee2e2);">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-red-600 text-xs font-semibold">Rusak</span>
                                    </div>
                                    <p class="text-gray-800 font-bold text-2xl">9</p>
                                    <p class="text-red-500 text-xs font-medium">4% dari total</p>
                                </div>
                            </div>

                            <!-- Recent Activity -->
                            <div>
                                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-3">Aktivitas Terbaru</p>
                                <div class="space-y-2.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-gray-700 text-xs font-medium truncate">Mikroskop binokuler ditambahkan</p>
                                            <p class="text-gray-400 text-[10px]">2 jam yang lalu</p>
                                        </div>
                                        <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">Baru</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 rounded-lg bg-yellow-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-gray-700 text-xs font-medium truncate">Timbangan analitik diperbarui</p>
                                            <p class="text-gray-400 text-[10px]">5 jam yang lalu</p>
                                        </div>
                                        <span class="text-[10px] font-semibold text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded-full">Edit</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-7 h-7 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-3.5 h-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-gray-700 text-xs font-medium truncate">Servis pH meter selesai</p>
                                            <p class="text-gray-400 text-[10px]">1 hari yang lalu</p>
                                        </div>
                                        <span class="text-[10px] font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Selesai</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge -->
                        <div class="float-anim-delay absolute -bottom-4 -left-4 glass rounded-xl px-4 py-2.5 shadow-xl">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-green-400/20 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white text-xs font-bold">Sistem Aktif</p>
                                    <p class="text-green-400 text-[10px]">Online 24/7</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="relative z-10 border-t border-white/10 py-6">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-white/40 text-xs">© 2025 Sistem Inventarisasi Alat Laboratorium Farmasi</p>
            <p class="text-white/30 text-xs">v{{ app()->version() ?? '1.0.0' }}</p>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');
        const iconOpen = document.getElementById('iconOpen');
        const iconClose = document.getElementById('iconClose');

        btn.addEventListener('click', () => {
            const isHidden = menu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden', !isHidden);
            iconClose.classList.toggle('hidden', isHidden);
        });
    </script>

</body>
</html>