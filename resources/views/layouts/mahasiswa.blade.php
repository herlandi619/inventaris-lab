<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') — LabFarma</title>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite(['resources/css/app.css','resources/js/app.js'])
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --sw: 240px;
    --navy: #0f1e3c;
    --accent: #3b82f6;
    --glow: rgba(59,130,246,.2);
    --surface: #ffffff;
    --surface-2: #f4f6fb;
    --border: #e4e8f2;
    --text: #1a2440;
    --muted: #6b7a99;
    --danger: #ef4444;
    --ease: .2s cubic-bezier(.4,0,.2,1);
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--surface-2);
    color: var(--text);
    height: 100dvh;
    display: flex;
    overflow: hidden;
  }

  /* ── OVERLAY (mobile) ────────────── */
  #overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.42);
    backdrop-filter: blur(3px);
    z-index: 40; display: none;
  }
  #overlay.active { display: block; }

  /* ── SIDEBAR ─────────────────────── */
  /*
     Desktop  → bagian dari flex row (position normal), lebar tetap --sw
     Mobile   → keluar dari flow, position fixed, slide dari kiri
  */
  #sidebar {
    width: var(--sw);
    flex-shrink: 0;
    height: 100dvh;
    background: var(--navy);
    display: flex; flex-direction: column;
    z-index: 50;
    overflow: hidden;
    position: relative; /* normal flow di desktop */
  }
  #sidebar::before {
    content: '';
    position: absolute; top: -50px; right: -40px;
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(59,130,246,.13) 0%, transparent 70%);
    pointer-events: none;
  }

  @media (max-width: 1023px) {
    #sidebar {
      position: fixed; top: 0; left: 0;
      height: 100dvh;
      transform: translateX(-100%);
      transition: transform .28s cubic-bezier(.4,0,.2,1);
    }
    #sidebar.open { transform: translateX(0); }
  }

  /* Brand */
  .sb-brand {
    padding: 22px 18px 18px;
    border-bottom: 1px solid rgba(255,255,255,.07);
    display: flex; align-items: center; gap: 11px;
  }
  .sb-logo {
    width: 36px; height: 36px; flex-shrink: 0;
    background: linear-gradient(135deg, var(--accent), #6366f1);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 14px var(--glow);
  }
  .sb-logo svg { width: 19px; height: 19px; color: #fff; }
  .sb-title { font-size: 13px; font-weight: 700; color: #fff; line-height: 1.3; }
  .sb-sub   { font-size: 10px; color: rgba(255,255,255,.38); margin-top: 1px; }

  /* Nav */
  .sb-nav { flex: 1; overflow-y: auto; padding: 12px 8px; scrollbar-width: none; }
  .sb-nav::-webkit-scrollbar { display: none; }

  .nav-label {
    font-size: 9px; font-weight: 700;
    color: rgba(255,255,255,.25);
    text-transform: uppercase; letter-spacing: 1.3px;
    padding: 8px 12px 4px;
  }
  .nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px; border-radius: 8px;
    color: rgba(255,255,255,.58);
    text-decoration: none;
    font-size: 13px; font-weight: 500;
    transition: all var(--ease);
    margin-bottom: 2px; position: relative;
  }
  .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
  .nav-item:hover { background: rgba(255,255,255,.07); color: #fff; }
  .nav-item.active {
    background: linear-gradient(135deg, rgba(59,130,246,.28), rgba(99,102,241,.18));
    color: #fff;
    box-shadow: inset 0 0 0 1px rgba(59,130,246,.22);
  }
  .nav-item.active::before {
    content: '';
    position: absolute; left: 0; top: 50%;
    transform: translateY(-50%);
    width: 3px; height: 16px;
    background: var(--accent);
    border-radius: 0 3px 3px 0;
  }

  /* Sidebar footer */
  .sb-footer { padding: 10px 8px; border-top: 1px solid rgba(255,255,255,.07); }
  .sb-user {
    display: flex; align-items: center; gap: 9px;
    padding: 9px 11px; border-radius: 8px;
    background: rgba(255,255,255,.05);
    text-decoration: none;
    transition: background var(--ease);
  }
  .sb-user:hover { background: rgba(255,255,255,.1); }
  .sb-av {
    width: 30px; height: 30px; border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #6366f1);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; color: #fff; flex-shrink: 0;
  }
  .sb-uname { font-size: 12px; font-weight: 600; color: #fff; }
  .sb-urole { font-size: 10px; color: rgba(255,255,255,.36); }

  /* ── MAIN ─────────────────────────── */
  #main {
    flex: 1;       /* ambil sisa lebar setelah sidebar */
    min-width: 0;  /* cegah overflow teks panjang */
    display: flex; flex-direction: column;
    height: 100dvh;
    overflow: hidden;
  }

  /* TOPBAR */
  #topbar {
    height: 58px; background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 20px; gap: 12px;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
    flex-shrink: 0;
  }
  .tb-left { display: flex; align-items: center; gap: 10px; }

  .burger {
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 7px; border: 1px solid var(--border);
    background: var(--surface); cursor: pointer;
    color: var(--muted); transition: all var(--ease);
  }
  .burger:hover { border-color: var(--accent); color: var(--accent); }
  @media (min-width: 1024px) { .burger { display: none; } }

  .tb-bc { display: flex; align-items: center; gap: 5px; }
  .tb-home { font-size: 12.5px; color: var(--muted); text-decoration: none; font-weight: 500; }
  .tb-sep  { color: var(--border); font-size: 14px; }
  .tb-page { font-size: 13.5px; font-weight: 700; color: var(--text); letter-spacing: -.2px; }

  /* User menu */
  .user-wrap { position: relative; }
  .user-btn {
    display: flex; align-items: center; gap: 8px;
    padding: 4px 9px 4px 4px;
    border-radius: 100px; border: 1px solid var(--border);
    background: var(--surface); cursor: pointer;
    transition: all var(--ease);
  }
  .user-btn:hover { border-color: var(--accent); box-shadow: 0 0 0 3px var(--glow); }
  .u-av {
    width: 28px; height: 28px; border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #6366f1);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 700; color: #fff;
  }
  .u-name { font-size: 12.5px; font-weight: 600; color: var(--text); display: none; }
  @media (min-width: 560px) { .u-name { display: block; } }
  .u-chev { width: 12px; height: 12px; color: var(--muted); transition: transform var(--ease); display: none; }
  @media (min-width: 560px) { .u-chev { display: block; } }

  .user-dd {
    position: absolute; top: calc(100% + 7px); right: 0;
    width: 195px;
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 10px; box-shadow: 0 12px 40px rgba(0,0,0,.11);
    overflow: hidden; display: none; z-index: 100;
  }
  .user-dd.open { display: block; }
  .dd-head {
    padding: 11px 14px; background: var(--surface-2);
    border-bottom: 1px solid var(--border);
  }
  .dd-head-name { font-size: 12.5px; font-weight: 700; color: var(--text); }
  .dd-head-role { font-size: 10.5px; color: var(--muted); }
  .dd-item {
    display: flex; align-items: center; gap: 9px;
    padding: 9px 14px; color: var(--text); text-decoration: none;
    font-size: 12.5px; font-weight: 500;
    transition: background var(--ease);
    background: none; border: none; width: 100%; cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  .dd-item:hover { background: var(--surface-2); }
  .dd-item svg { width: 14px; height: 14px; color: var(--muted); }
  .dd-item.danger { color: var(--danger); }
  .dd-item.danger svg { color: var(--danger); }
  .dd-item.danger:hover { background: #fef2f2; }
  .dd-div { height: 1px; background: var(--border); }

  /* Content */
  #content { flex: 1; overflow-y: auto; padding: 24px 22px; }
  @media (max-width: 639px) { #content { padding: 16px 14px; } }
</style>
</head>
<body>

<div id="overlay" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="sidebar">

  <div class="sb-brand">
    <div class="sb-logo">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3"/>
      </svg>
    </div>
    <div>
      <div class="sb-title">Sistem Inventarisasi</div>
      <div class="sb-sub">Laboratorium Farmasi</div>
    </div>
  </div>

  <nav class="sb-nav">
    <div class="nav-label">Menu</div>

    <a href="{{ route('mahasiswa.dashboard') }}"
       class="nav-item {{ request()->routeIs('mahasiswa.dashboard*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v18h18M9 17V9m4 8V5m4 12v-6"/>
      </svg>
      Dashboard
    </a>

    {{-- <a href="{{ route('mahasiswa.scan.qr') }}"
       class="nav-item {{ request()->routeIs('mahasiswa.dashboard*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v18h18M9 17V9m4 8V5m4 12v-6"/>
      </svg>
      Scan QR
    </a> --}}

    <a href="{{ route('mahasiswa.alat.index') }}"
       class="nav-item {{ request()->routeIs('mahasiswa.alat*') || request()->routeIs('mahasiswa.scan*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" 
              d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h3.5l1-2h3l1 2H17a2 2 0 012 2v12a2 2 0 01-2 2z" />
      </svg>
      Data Alat
    </a>

    {{-- Tambah nav-item lain di sini --}}

  </nav>

  <div class="sb-footer">
    <a href="{{ route('profile.edit') }}" class="sb-user">
      <div class="sb-av">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
      <div>
        <div class="sb-uname">{{ Auth::user()->name }}</div>
        <div class="sb-urole">Laboran</div>
      </div>
    </a>
  </div>

</aside>

{{-- MAIN --}}
<div id="main">

  <header id="topbar">
    <div class="tb-left">
      <button class="burger" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:16px;height:16px">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
      </button>
      <div class="tb-bc">
        <a href="#" class="tb-home">LabFarma</a>
        <span class="tb-sep">›</span>
        <span class="tb-page">@yield('title')</span>
      </div>
    </div>

    <div class="user-wrap">
      <div class="user-btn" onclick="toggleUserMenu()">
        <div class="u-av">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
        <span class="u-name">{{ Auth::user()->name }}</span>
        <svg class="u-chev" id="uChev" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
      </div>

      <div class="user-dd" id="userDd">
        <div class="dd-head">
          <div class="dd-head-name">{{ Auth::user()->name }}</div>
          <div class="dd-head-role">Laboran · Aktif</div>
        </div>
        <a href="{{ route('profile.edit') }}" class="dd-item">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>
          </svg>
          Edit Profil
        </a>
        <div class="dd-div"></div>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dd-item danger">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5A2.25 2.25 0 003.75 5.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15m3-3l-3-3m3 3l-3 3m3-3H9"/>
            </svg>
            Keluar
          </button>
        </form>
      </div>
    </div>
  </header>

  <main id="content">

    @if(session('success'))
      <div style="display:flex;align-items:center;gap:9px;padding:11px 15px;border-radius:8px;background:#f0fdf4;border:1px solid #86efac;color:#166534;font-size:13px;font-weight:500;margin-bottom:18px;">
        <svg style="width:15px;height:15px;flex-shrink:0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div style="display:flex;align-items:center;gap:9px;padding:11px 15px;border-radius:8px;background:#fef2f2;border:1px solid #fca5a5;color:#991b1b;font-size:13px;font-weight:500;margin-bottom:18px;">
        <svg style="width:15px;height:15px;flex-shrink:0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
        {{ session('error') }}
      </div>
    @endif

    @yield('content')

  </main>

</div>

<script>
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');

  function toggleSidebar() {
    const open = sidebar.classList.toggle('open');
    overlay.classList.toggle('active', open);
  }
  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
  }

  const userDd = document.getElementById('userDd');
  const uChev  = document.getElementById('uChev');

  function toggleUserMenu() {
    const open = userDd.classList.toggle('open');
    uChev.style.transform = open ? 'rotate(180deg)' : '';
  }
  document.addEventListener('click', e => {
    if (!e.target.closest('.user-wrap')) {
      userDd.classList.remove('open');
      uChev.style.transform = '';
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>