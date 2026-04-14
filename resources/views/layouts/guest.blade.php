<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LabFarma') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
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

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.55;
            animation: blobFloat linear infinite;
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

        .particles { position: absolute; inset: 0; overflow: hidden; }
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

        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 64px 64px;
        }

        /* ─── LAYOUT ─── */
        .page-wrap {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        /* ─── LOGO AREA ─── */
        .logo-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            animation: fadeUp 0.6s cubic-bezier(0.22,1,0.36,1) forwards;
        }
        .logo-img-wrap {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: white;
            border: 1px solid rgba(226,232,240,0.8);
            box-shadow: 0 4px 20px rgba(59,130,246,0.15);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transform: scale(0.88);
        }
        .logo-label {
            font-size: 11px;
            font-weight: 800;
            color: #2563eb;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ─── CARD ─── */
        .auth-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.75);
            border-radius: 22px;
            padding: 32px;
            box-shadow: 0 8px 40px rgba(59,130,246,0.1), 0 1px 0 rgba(255,255,255,0.9) inset;
            animation: fadeUp 0.7s 0.1s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
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

    <!-- ─── CONTENT ─── -->
    <div class="page-wrap">

        <!-- Logo -->
        <div class="logo-area">
            <a href="/">
                <div class="logo-img-wrap">
                    <img src="{{ asset('images/logo_stikes.png') }}" alt="Logo STIKes">
                </div>
            </a>
            <span class="logo-label">Lab Farmasi</span>
        </div>

        <!-- Auth Card -->
        <div class="auth-card">
            {{ $slot }}
        </div>

    </div>

    <!-- ─── PARTICLES ─── -->
    <script>
        (function () {
            const container = document.getElementById('particles');
            const colors = ['#93c5fd','#6ee7b7','#c4b5fd','#f9a8d4','#fde68a','#a5f3fc'];
            for (let i = 0; i < 28; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                const size = Math.random() * 6 + 3;
                p.style.cssText = `
                    width:${size}px; height:${size}px;
                    left:${Math.random()*100}%;
                    background:${colors[Math.floor(Math.random()*colors.length)]};
                    animation-duration:${Math.random()*12+10}s;
                    animation-delay:-${Math.random()*18}s;
                    box-shadow:0 0 ${size*2}px currentColor;
                `;
                container.appendChild(p);
            }
        })();
    </script>

</body>
</html>