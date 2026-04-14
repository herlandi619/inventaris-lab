<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventarisasi Alat Laboratorium Farmasi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue: #3b82f6;
            --cyan: #06b6d4;
            --purple: #8b5cf6;
            --pink: #ec4899;
            --green: #22c55e;
            --teal: #14b8a6;
            --bg: #f0f7ff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0f8ff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ─── ANIMATED BACKGROUND ─── */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            background: linear-gradient(160deg, #e8f4fd 0%, #edf6f0 35%, #f3eeff 65%, #fde8f4 100%);
        }

        /* Floating blobs */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.55;
            animation: blobFloat linear infinite;
        }
        .blob-1 {
            width: 520px; height: 520px;
            /* background: radial-gradient(circle, #a5d8ff, #74c0fc); */
            background: radial-gradient(circle, #c4b5fd, #a78bfa); /* ungu muda */
            top: -120px; left: -80px;
            animation-duration: 18s;
        }
        .blob-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #b197fc, #da77f2);
            bottom: -100px; right: -60px;
            animation-duration: 22s;
            animation-delay: -7s;
        }
        .blob-3 {
            width: 300px; height: 300px;
            /* background: radial-gradient(circle, #63e6be, #38d9a9); */
            background: radial-gradient(circle, #ddd6fe, #c4b5fd); /* ungu pucat */
            top: 40%; left: 55%;
            animation-duration: 15s;
            animation-delay: -4s;
        }
        .blob-4 {
            width: 240px; height: 240px;
            background: radial-gradient(circle, #ffa94d, #ff6b6b);
            top: 20%; right: 15%;
            animation-duration: 20s;
            animation-delay: -10s;
        }
        .blob-5 {
            width: 180px; height: 180px;
            background: radial-gradient(circle, #f783ac, #e64980);
            top: 60%; left: 10%;
            animation-duration: 16s;
            animation-delay: -3s;
        }

        @keyframes blobFloat {
            0%   { transform: translate(0, 0) scale(1); }
            25%  { transform: translate(30px, -40px) scale(1.05); }
            50%  { transform: translate(-20px, 30px) scale(0.95); }
            75%  { transform: translate(40px, 20px) scale(1.08); }
            100% { transform: translate(0, 0) scale(1); }
        }

        /* Particle dots */
        .particles {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            animation: particleRise linear infinite;
            opacity: 0;
        }
        @keyframes particleRise {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 0.6; }
            100% { transform: translateY(-10vh) scale(1); opacity: 0; }
        }

        /* Grid lines */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 64px 64px;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            position: relative; z-index: 50;
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.6);
            box-shadow: 0 1px 24px rgba(59,130,246,0.06);
        }
        .navbar-inner {
            max-width: 1200px; margin: 0 auto;
            padding: 14px 32px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .logo-icon {
            width: 42px; height: 42px; border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(59,130,246,0.35);
            flex-shrink: 0;
        }
        .logo-text { line-height: 1; }
        .logo-text strong { display: block; font-size: 13.5px; font-weight: 800; color: #0f172a; }
        .logo-text span { font-size: 11px; color: #64748b; font-weight: 500; }

        .nav-actions { display: flex; align-items: center; gap: 8px; }
        .btn-login {
            padding: 9px 20px; border-radius: 9px;
            border: 1.5px solid #e2e8f0; background: white;
            font-size: 13px; font-weight: 600; color: #475569;
            cursor: pointer; text-decoration: none;
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-login:hover { border-color: #3b82f6; color: #3b82f6; }
        .btn-register {
            padding: 9px 20px; border-radius: 9px; border: none;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            font-size: 13px; font-weight: 700; color: white;
            cursor: pointer; text-decoration: none;
            box-shadow: 0 4px 14px rgba(59,130,246,0.4);
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-register:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(59,130,246,0.45); }
        .btn-dashboard {
            padding: 9px 22px; border-radius: 9px; border: none;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            font-size: 13px; font-weight: 700; color: white;
            cursor: pointer; text-decoration: none;
            box-shadow: 0 4px 14px rgba(59,130,246,0.4);
            transition: all 0.2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-dashboard:hover { opacity: 0.9; transform: translateY(-1px); }

        /* ─── HERO ─── */
        .hero {
            position: relative; z-index: 10;
            max-width: 1200px; margin: 0 auto;
            padding: 80px 32px 60px;
            display: flex; align-items: center; gap: 64px;
        }
        .hero-left { flex: 1; }
        .hero-right { flex: 1; display: flex; justify-content: flex-end; }

        .badge-pill {
            display: inline-flex; align-items: center; gap: 7px;
            background: rgba(59,130,246,0.08);
            border: 1px solid rgba(59,130,246,0.18);
            border-radius: 100px; padding: 6px 16px; margin-bottom: 24px;
        }
        .badge-dot {
            width: 7px; height: 7px; border-radius: 50%; background: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,0.2);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 3px rgba(34,197,94,0.2); }
            50% { box-shadow: 0 0 0 6px rgba(34,197,94,0.1); }
        }
        .badge-pill span { font-size: 11px; font-weight: 700; color: #2563eb; text-transform: uppercase; letter-spacing: 0.06em; }

        .hero-title {
            font-size: clamp(32px, 4vw, 46px);
            font-weight: 800; color: #0f172a; line-height: 1.15; margin-bottom: 18px;
        }
        .grad-blue {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .grad-purple {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }

        .hero-desc {
            font-size: 15.5px; color: #64748b; line-height: 1.75;
            max-width: 460px; margin-bottom: 32px;
        }

        .stats-strip {
            display: flex; align-items: stretch; gap: 0;
            background: white; border: 1px solid #e2e8f0; border-radius: 14px;
            width: fit-content; margin-bottom: 36px; overflow: hidden;
            box-shadow: 0 2px 16px rgba(0,0,0,0.05);
        }
        .strip-item { padding: 14px 26px; text-align: center; }
        .strip-item + .strip-item { border-left: 1px solid #f1f5f9; }
        .strip-num { font-size: 21px; font-weight: 800; color: #0f172a; }
        .strip-lbl { font-size: 11px; color: #94a3b8; margin-top: 2px; font-weight: 500; }

        .cta-wrap { display: flex; gap: 12px; flex-wrap: wrap; }
        .cta-main {
            padding: 13px 30px; border-radius: 11px; border: none;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            font-size: 14.5px; font-weight: 700; color: white;
            cursor: pointer; text-decoration: none; display: inline-block;
            box-shadow: 0 6px 20px rgba(59,130,246,0.4);
            transition: all 0.25s; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .cta-main:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(59,130,246,0.45); }
        .cta-ghost {
            padding: 13px 28px; border-radius: 11px;
            background: white; border: 1.5px solid #e2e8f0;
            font-size: 14.5px; font-weight: 600; color: #475569;
            cursor: pointer; text-decoration: none; display: inline-block;
            transition: all 0.25s; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .cta-ghost:hover { border-color: #94a3b8; color: #1e293b; transform: translateY(-1px); }

        /* ─── DASHBOARD CARD ─── */
        .card-wrap { position: relative; }
        .dash-card {
            background: white; border-radius: 22px;
            border: 1px solid rgba(226,232,240,0.8);
            padding: 24px; width: 360px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.08), 0 1px 0 rgba(255,255,255,0.8) inset;
            animation: floatCard 5s ease-in-out infinite;
        }
        @keyframes floatCard {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .card-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .card-head-title { font-size: 14px; font-weight: 800; color: #0f172a; }
        .card-head-sub { font-size: 11px; color: #94a3b8; margin-top: 2px; }
        .traffic-dots { display: flex; gap: 5px; }
        .td { width: 10px; height: 10px; border-radius: 50%; }

        .stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px; }
        .sc {
            border-radius: 13px; padding: 14px;
            transition: transform 0.2s;
        }
        .sc:hover { transform: scale(1.02); }
        .sc-b { background: linear-gradient(135deg, #eff6ff, #dbeafe); }
        .sc-g { background: linear-gradient(135deg, #f0fdf4, #dcfce7); }
        .sc-o { background: linear-gradient(135deg, #fff7ed, #ffedd5); }
        .sc-r { background: linear-gradient(135deg, #fef2f2, #fee2e2); }
        .sc-label {
            font-size: 10.5px; font-weight: 700;
            display: flex; align-items: center; gap: 5px; margin-bottom: 7px;
        }
        .sc-b .sc-label { color: #2563eb; }
        .sc-g .sc-label { color: #16a34a; }
        .sc-o .sc-label { color: #ea580c; }
        .sc-r .sc-label { color: #dc2626; }
        .sc-num { font-size: 28px; font-weight: 800; color: #0f172a; line-height: 1; }
        .sc-sub { font-size: 10px; margin-top: 5px; font-weight: 600; }
        .sc-b .sc-sub { color: #16a34a; }
        .sc-g .sc-sub { color: #16a34a; }
        .sc-o .sc-sub { color: #ea580c; }
        .sc-r .sc-sub { color: #dc2626; }

        .act-head { font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 12px; }
        .act-list { display: flex; flex-direction: column; gap: 9px; }
        .act-row { display: flex; align-items: center; gap: 10px; }
        .act-ico { width: 30px; height: 30px; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .aib { background: #dbeafe; } .aiy { background: #fef9c3; } .aig { background: #dcfce7; }
        .act-info { flex: 1; min-width: 0; }
        .act-name { font-size: 12px; font-weight: 600; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .act-time { font-size: 10px; color: #94a3b8; }
        .act-tag { font-size: 10px; font-weight: 700; padding: 2px 9px; border-radius: 100px; white-space: nowrap; }
        .tag-b { background: #dbeafe; color: #2563eb; }
        .tag-y { background: #fef9c3; color: #d97706; }
        .tag-g { background: #dcfce7; color: #16a34a; }

        /* Floating badges on card */
        .float-b1 {
            position: absolute; bottom: -18px; left: -20px;
            background: white; border-radius: 14px; border: 1px solid #e2e8f0;
            padding: 11px 16px; display: flex; align-items: center; gap: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            animation: floatCard 5s ease-in-out infinite 1.5s;
            z-index: 10;
        }
        .float-b2 {
            position: absolute; top: -18px; right: -20px;
            background: white; border-radius: 14px; border: 1px solid #e2e8f0;
            padding: 10px 14px; display: flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            animation: floatCard 4s ease-in-out infinite 0.8s;
            z-index: 10;
        }
        .fbi { width: 32px; height: 32px; border-radius: 9px; display: flex; align-items: center; justify-content: center; }
        .fbi-g { background: #dcfce7; } .fbi-o { background: #ffedd5; }
        .fb-tit { font-size: 12px; font-weight: 700; color: #0f172a; }
        .fb-sub-g { font-size: 10px; color: #16a34a; font-weight: 600; }
        .fb-sub-o { font-size: 10px; color: #ea580c; font-weight: 600; }

        /* ─── FEATURES ─── */
        .features {
            position: relative; z-index: 10;
            max-width: 1200px; margin: 0 auto;
            padding: 0 32px 80px;
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px;
        }
        .feat {
            background: rgba(255,255,255,0.85); backdrop-filter: blur(12px);
            border-radius: 18px; border: 1px solid rgba(255,255,255,0.7);
            padding: 26px; transition: all 0.3s;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
        }
        .feat:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
        .feat-ico {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center; margin-bottom: 16px;
        }
        .fi-b { background: linear-gradient(135deg, #dbeafe, #bfdbfe); }
        .fi-p { background: linear-gradient(135deg, #ede9fe, #ddd6fe); }
        .fi-t { background: linear-gradient(135deg, #ccfbf1, #99f6e4); }
        .feat-title { font-size: 15px; font-weight: 800; color: #0f172a; margin-bottom: 8px; }
        .feat-desc { font-size: 13.5px; color: #64748b; line-height: 1.65; }

        /* ─── FOOTER ─── */
        .footer {
            position: relative; z-index: 10;
            background: rgba(255,255,255,0.7); backdrop-filter: blur(12px);
            border-top: 1px solid rgba(226,232,240,0.6);
            padding: 20px 32px;
        }
        .footer-inner {
            max-width: 1200px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
        }
        .footer p { font-size: 12px; color: #94a3b8; }

        /* ─── ENTRANCE ANIMATIONS ─── */
        .fade-up {
            opacity: 0; transform: translateY(28px);
            animation: fadeUp 0.7s cubic-bezier(0.22,1,0.36,1) forwards;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.35s; }
        .delay-4 { animation-delay: 0.5s; }
        .delay-5 { animation-delay: 0.65s; }
        .delay-6 { animation-delay: 0.4s; }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .hero { flex-direction: column-reverse; padding: 50px 24px 40px; gap: 40px; }
            .hero-right { justify-content: center; }
            .hero-left { text-align: center; }
            .badge-pill { margin: 0 auto 20px; }
            .hero-desc { margin: 0 auto 28px; }
            .stats-strip { margin: 0 auto 32px; }
            .cta-wrap { justify-content: center; }
            .features { grid-template-columns: 1fr; padding: 0 24px 60px; }
            .dash-card { width: 100%; max-width: 360px; }
        }
    </style>
</head>

<body>

    <!-- ─── ANIMATED BACKGROUND ─── -->
    <div class="bg-canvas">
        <div class="grid-overlay"></div>
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <div class="blob blob-4"></div>
        <div class="blob blob-5"></div>
        <div class="particles" id="particles"></div>
    </div>

    <!-- ─── NAVBAR ─── -->
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="#" class="logo">
                        <div class="w-20 h-20 rounded-full overflow-hidden shadow-md border border-gray-200 flex items-center justify-center">
                            <img src="{{ asset('images/logo_stikes.png') }}"
                                alt="Logo STIKes"
                                class="w-full h-full object-contain scale-90">
                        </div>
                <div class="logo-text">
                    <strong>Lab Farmasi</strong>
                    <span>Inventarisasi Alat</span>
                </div>
            </a>

            <div class="nav-actions">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-dashboard">Dashboard →</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-register">Daftar Gratis</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- ─── HERO ─── -->
    <section class="hero">
        <div class="hero-left">
            <div class="badge-pill fade-up delay-1">
                <span class="badge-dot"></span>
                <span>Sistem Digital Terintegrasi</span>
            </div>

            <h1 class="hero-title fade-up delay-2">
                Sistem <span class="grad-blue">Inventarisasi</span><br>
                Alat Lab <span class="grad-purple">Farmasi</span><br>
                Berbasis Web
            </h1>

            <p class="hero-desc fade-up delay-3">
                Kelola, pantau, dan lacak seluruh peralatan laboratorium farmasi Anda secara efisien dalam satu platform digital yang modern dan mudah digunakan.
            </p>

            <div class="stats-strip fade-up delay-4">
                <div class="strip-item">
                    <div class="strip-num">500+</div>
                    <div class="strip-lbl">Jenis Alat</div>
                </div>
                <div class="strip-item">
                    <div class="strip-num">Real‑time</div>
                    <div class="strip-lbl">Monitoring</div>
                </div>
                <div class="strip-item">
                    <div class="strip-num">100%</div>
                    <div class="strip-lbl">Akurat</div>
                </div>
            </div>

            <div class="cta-wrap fade-up delay-5">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="cta-main">Buka Dashboard →</a>
                    @else
                        <a href="{{ route('login') }}" class="cta-main">Masuk ke Dashboard</a>
                        @if (Route::has('register'))
                            {{-- <a href="{{ route('register') }}" class="cta-ghost">Buat Akun Baru</a> --}}
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <div class="hero-right fade-up delay-6">
            <div class="card-wrap">

                <!-- Floating badge top-right -->
                <div class="float-b2">
                    <div class="fbi fbi-o">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#ea580c" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="fb-tit">Perlu Servis</div>
                        <div class="fb-sub-o">18 alat menunggu</div>
                    </div>
                </div>

                <!-- Main card -->
                <div class="dash-card">
                    <div class="card-head">
                        <div>
                            <div class="card-head-title">Dashboard Inventaris</div>
                            <div class="card-head-sub">Lab Farmasi — 2025</div>
                        </div>
                        <div class="traffic-dots">
                            <div class="td" style="background:#fca5a5"></div>
                            <div class="td" style="background:#fcd34d"></div>
                            <div class="td" style="background:#86efac"></div>
                        </div>
                    </div>

                    <div class="stat-grid">
                        <div class="sc sc-b">
                            <div class="sc-label">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                Total Alat
                            </div>
                            <div class="sc-num">248</div>
                            <div class="sc-sub">↑ +12 bulan ini</div>
                        </div>
                        <div class="sc sc-g">
                            <div class="sc-label">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Kondisi Baik
                            </div>
                            <div class="sc-num">221</div>
                            <div class="sc-sub">89% dari total</div>
                        </div>
                        <div class="sc sc-o">
                            <div class="sc-label">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#ea580c" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                Perlu Servis
                            </div>
                            <div class="sc-num">18</div>
                            <div class="sc-sub">7% dari total</div>
                        </div>
                        <div class="sc sc-r">
                            <div class="sc-label">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Rusak
                            </div>
                            <div class="sc-num">9</div>
                            <div class="sc-sub">4% dari total</div>
                        </div>
                    </div>

                    <div class="act-head">Aktivitas Terbaru</div>
                    <div class="act-list">
                        <div class="act-row">
                            <div class="act-ico aib">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <div class="act-info">
                                <div class="act-name">Mikroskop binokuler ditambahkan</div>
                                <div class="act-time">2 jam yang lalu</div>
                            </div>
                            <span class="act-tag tag-b">Baru</span>
                        </div>
                        <div class="act-row">
                            <div class="act-ico aiy">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#d97706" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <div class="act-info">
                                <div class="act-name">Timbangan analitik diperbarui</div>
                                <div class="act-time">5 jam yang lalu</div>
                            </div>
                            <span class="act-tag tag-y">Edit</span>
                        </div>
                        <div class="act-row">
                            <div class="act-ico aig">
                                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="act-info">
                                <div class="act-name">Servis pH meter selesai</div>
                                <div class="act-time">1 hari yang lalu</div>
                            </div>
                            <span class="act-tag tag-g">Selesai</span>
                        </div>
                    </div>
                </div>

                <!-- Floating badge bottom-left -->
                <div class="float-b1">
                    <div class="fbi fbi-g">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="fb-tit">Sistem Aktif</div>
                        <div class="fb-sub-g">Online 24/7</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ─── FEATURE CARDS ─── -->
    <section class="features">
        <div class="feat fade-up delay-1">
            <div class="feat-ico fi-b">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div class="feat-title">Manajemen Inventaris</div>
            <p class="feat-desc">Catat dan kelola seluruh data peralatan lab dengan mudah — dari kode alat, kondisi, hingga lokasi penyimpanan.</p>
        </div>
        <div class="feat fade-up delay-2">
            <div class="feat-ico fi-p">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div class="feat-title">Laporan &amp; Statistik</div>
            <p class="feat-desc">Pantau kondisi alat secara real-time dengan laporan visual yang mudah dipahami oleh semua petugas lab.</p>
        </div>
        <div class="feat fade-up delay-3">
            <div class="feat-ico fi-t">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#0d9488" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <div class="feat-title">Notifikasi Servis</div>
            <p class="feat-desc">Dapatkan pengingat otomatis ketika alat membutuhkan pemeliharaan berkala atau jadwal kalibrasi sudah tiba.</p>
        </div>
    </section>

    <!-- ─── FOOTER ─── -->
    <footer class="footer">
        <div class="footer-inner">
            <p>© 2025 Sistem Inventarisasi Alat Laboratorium Farmasi</p>
            <p>v{{ app()->version() ?? '1.0.0' }}</p>
        </div>
    </footer>

    <!-- ─── PARTICLE SCRIPT ─── -->
    <script>
        (function () {
            const container = document.getElementById('particles');
            const colors = ['#93c5fd','#6ee7b7','#c4b5fd','#f9a8d4','#fde68a','#a5f3fc'];
            const count = 28;

            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                const size = Math.random() * 6 + 3;
                const left = Math.random() * 100;
                const delay = Math.random() * 18;
                const duration = Math.random() * 12 + 10;
                const color = colors[Math.floor(Math.random() * colors.length)];
                p.style.cssText = `
                    width: ${size}px;
                    height: ${size}px;
                    left: ${left}%;
                    background: ${color};
                    animation-duration: ${duration}s;
                    animation-delay: -${delay}s;
                    box-shadow: 0 0 ${size * 2}px ${color};
                `;
                container.appendChild(p);
            }
        })();
    </script>

</body>
</html>