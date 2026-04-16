<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') — LabFarma</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo_stikes.png') }}">

@vite(['resources/css/app.css','resources/js/app.js'])

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
  :root {
    --sidebar-w: 260px;
    --navy:       #0f1e3c;
    --navy-light: #162444;
    --navy-hover: #1e3260;
    --accent:     #3b82f6;
    --accent-glow:rgba(59,130,246,.25);
    --surface:    #ffffff;
    --surface-2:  #f4f6fb;
    --border:     #e4e8f2;
    --text:       #1a2440;
    --text-muted: #6b7a99;
    --danger:     #ef4444;
    --success:    #10b981;
    --warning:    #f59e0b;
    --radius:     12px;
    --radius-sm:  8px;
    --shadow-sm:  0 1px 4px rgba(0,0,0,.06);
    --shadow:     0 4px 20px rgba(0,0,0,.08);
    --shadow-lg:  0 12px 40px rgba(0,0,0,.12);
    --transition: .2s cubic-bezier(.4,0,.2,1);
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

  /* ═══════════════════════════════
     OVERLAY MOBILE
  ═══════════════════════════════ */
  #overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);
    backdrop-filter: blur(4px);
    z-index: 40;
    display: none;
    transition: opacity var(--transition);
  }
  #overlay.active { display: block; }

  /* ═══════════════════════════════
     SIDEBAR
  ═══════════════════════════════ */
  #sidebar {
    width: var(--sidebar-w);
    flex-shrink: 0;
    height: 100dvh;
    background: var(--navy);
    display: flex;
    flex-direction: column;
    z-index: 50;
    overflow: hidden;
    position: relative;
  }

  #sidebar::before {
    content: '';
    position: absolute;
    top: -50px; right: -40px;
    width: 180px; height: 180px;
    background: radial-gradient(circle, rgba(59,130,246,.13) 0%, transparent 70%);
    pointer-events: none;
  }

  @media (max-width: 1023px) {
    #sidebar {
      position: fixed; top: 0; left: 0;
      height: 100dvh;
      transform: translateX(-100%);
      transition: transform .3s cubic-bezier(.4,0,.2,1);
    }
    #sidebar.open { transform: translateX(0); }
  }

  /* BRAND */
  .sidebar-brand {
    padding: 18px 18px 16px;
    border-bottom: 1px solid rgba(255,255,255,.07);
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .brand-logo {
    width: 44px; height: 44px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,.15);
    background: rgba(255,255,255,.08);
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
  }
  .brand-logo img {
    width: 100%; height: 100%;
    object-fit: contain;
  }

  .brand-texts { display: flex; flex-direction: column; gap: 2px; }
  .brand-title { font-size: 13px; font-weight: 700; color: #fff; line-height: 1.3; }
  .brand-sub   { font-size: 10px; color: rgba(255,255,255,.38); margin-top: 1px; }

  /* NAV */
  .sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 12px 8px;
    scrollbar-width: none;
  }
  .sidebar-nav::-webkit-scrollbar { display: none; }

  .nav-label {
    font-size: 9px; font-weight: 700;
    color: rgba(255,255,255,.25);
    text-transform: uppercase; letter-spacing: 1.3px;
    padding: 8px 12px 4px;
  }

  .nav-item {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 12px;
    border-radius: 8px;
    color: rgba(255,255,255,.58);
    text-decoration: none;
    font-size: 13px; font-weight: 500;
    transition: all var(--transition);
    margin-bottom: 2px;
    position: relative;
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

  /* DROPDOWN */
  .nav-dropdown-toggle {
    display: flex; align-items: center; justify-content: space-between;
    width: 100%;
    padding: 9px 12px;
    border-radius: 8px;
    color: rgba(255,255,255,.58);
    background: none; border: none; cursor: pointer;
    font-size: 13px; font-weight: 500;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all var(--transition);
    margin-bottom: 2px;
  }
  .nav-dropdown-toggle:hover { background: rgba(255,255,255,.07); color: #fff; }
  .nav-dropdown-toggle.active-parent {
    background: linear-gradient(135deg, rgba(59,130,246,.28), rgba(99,102,241,.18));
    color: #fff;
    box-shadow: inset 0 0 0 1px rgba(59,130,246,.22);
  }
  .nav-dropdown-left { display: flex; align-items: center; gap: 10px; }
  .nav-dropdown-left svg { width: 16px; height: 16px; }
  .chevron {
    width: 13px; height: 13px;
    transition: transform var(--transition);
    color: rgba(255,255,255,.35);
  }
  .chevron.open { transform: rotate(180deg); }

  .dropdown-children {
    padding-left: 12px;
    overflow: hidden;
    max-height: 0;
    transition: max-height .3s cubic-bezier(.4,0,.2,1);
  }
  .dropdown-children.open { max-height: 300px; }

  .nav-child {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 12px;
    border-radius: 8px;
    color: rgba(255,255,255,.45);
    text-decoration: none;
    font-size: 12.5px; font-weight: 500;
    transition: all var(--transition);
    margin-bottom: 2px;
    position: relative;
  }
  .nav-child::before {
    content: '';
    width: 5px; height: 5px;
    border-radius: 50%;
    background: rgba(255,255,255,.2);
    flex-shrink: 0;
    transition: background var(--transition);
  }
  .nav-child:hover { color: #fff; background: rgba(255,255,255,.06); }
  .nav-child:hover::before { background: var(--accent); }
  .nav-child.active { color: #fff; }
  .nav-child.active::before { background: var(--accent); }

  /* SIDEBAR FOOTER */
  .sidebar-footer { padding: 10px 8px; border-top: 1px solid rgba(255,255,255,.07); }
  .sidebar-user {
    display: flex; align-items: center; gap: 9px;
    padding: 9px 11px;
    border-radius: 8px;
    background: rgba(255,255,255,.05);
    text-decoration: none;
    transition: background var(--transition);
  }
  .sidebar-user:hover { background: rgba(255,255,255,.1); }
  .user-avatar-sm {
    width: 30px; height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #6366f1);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; color: #fff; flex-shrink: 0;
  }
  .user-name-sm { font-size: 12px; font-weight: 600; color: #fff; }
  .user-role-sm { font-size: 10px; color: rgba(255,255,255,.36); }

  /* ═══════════════════════════════
     MAIN
  ═══════════════════════════════ */
  #main {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    height: 100dvh;
    overflow: hidden;
  }

  /* ═══════════════════════════════
     TOPBAR
  ═══════════════════════════════ */
  #topbar {
    height: 58px;
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 20px;
    gap: 12px;
    flex-shrink: 0;
    box-shadow: 0 1px 4px rgba(0,0,0,.05);
  }

  .topbar-left { display: flex; align-items: center; gap: 10px; }

  .burger-btn {
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: var(--surface);
    cursor: pointer; color: var(--text-muted);
    transition: all var(--transition);
  }
  .burger-btn:hover { border-color: var(--accent); color: var(--accent); }
  @media (min-width: 1024px) { .burger-btn { display: none; } }

  .breadcrumb { display: flex; align-items: center; gap: 5px; }
  .breadcrumb-home { font-size: 12.5px; color: var(--text-muted); font-weight: 500; text-decoration: none; }
  .breadcrumb-sep  { color: var(--border); font-size: 14px; }
  .page-title { font-size: 13.5px; font-weight: 700; color: var(--text); letter-spacing: -.2px; }

  .topbar-right { display: flex; align-items: center; gap: 10px; }

  .topbar-btn {
    width: 32px; height: 32px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: var(--surface);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--text-muted);
    transition: all var(--transition);
    position: relative;
    text-decoration: none;
  }
  .topbar-btn:hover { border-color: var(--accent); color: var(--accent); }
  .topbar-btn svg { width: 16px; height: 16px; }

  /* USER DROPDOWN */
  .user-menu { position: relative; }
  .user-trigger {
    display: flex; align-items: center; gap: 8px;
    padding: 4px 9px 4px 4px;
    border-radius: 100px;
    border: 1px solid var(--border);
    background: var(--surface);
    cursor: pointer;
    transition: all var(--transition);
  }
  .user-trigger:hover { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-glow); }
  .user-avatar {
    width: 28px; height: 28px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #6366f1);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 700; color: #fff; flex-shrink: 0;
  }
  .user-info { display: none; }
  @media (min-width: 640px) { .user-info { display: block; } }
  .user-display-name { font-size: 12.5px; font-weight: 600; color: var(--text); }
  .user-display-role { font-size: 10.5px; color: var(--text-muted); }
  .chevron-user {
    width: 12px; height: 12px; color: var(--text-muted);
    transition: transform var(--transition);
    display: none;
  }
  @media (min-width: 640px) { .chevron-user { display: block; } }

  .user-dropdown {
    position: absolute; top: calc(100% + 7px); right: 0;
    width: 200px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    display: none;
    z-index: 100;
  }
  .user-dropdown.open { display: block; }

  .dropdown-header {
    padding: 11px 14px;
    border-bottom: 1px solid var(--border);
    background: var(--surface-2);
  }
  .dropdown-header-name { font-size: 12.5px; font-weight: 700; color: var(--text); }
  .dropdown-header-role { font-size: 10.5px; color: var(--text-muted); }

  .dropdown-item {
    display: flex; align-items: center; gap: 9px;
    padding: 9px 14px;
    color: var(--text);
    text-decoration: none;
    font-size: 12.5px; font-weight: 500;
    transition: background var(--transition);
    border: none; background: none; width: 100%; cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }
  .dropdown-item:hover { background: var(--surface-2); }
  .dropdown-item svg { width: 14px; height: 14px; color: var(--text-muted); }
  .dropdown-item.danger { color: var(--danger); }
  .dropdown-item.danger svg { color: var(--danger); }
  .dropdown-item.danger:hover { background: #fef2f2; }
  .dropdown-divider { height: 1px; background: var(--border); }

  /* ═══════════════════════════════
     CONTENT
  ═══════════════════════════════ */
  #content {
    flex: 1;
    overflow-y: auto;
    padding: 24px 22px;
  }
  @media (max-width: 640px) {
    #content { padding: 16px 14px; }
  }

  /* FLASH */
  .flash {
    display: flex; align-items: center; gap: 9px;
    padding: 11px 15px;
    border-radius: 8px;
    font-size: 13px; font-weight: 500;
    margin-bottom: 18px;
    animation: slideIn .3s ease;
  }
  .flash.success { background: #f0fdf4; border: 1px solid #86efac; color: #166534; }
  .flash.error   { background: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; }
  .flash svg { width: 15px; height: 15px; flex-shrink: 0; }

  @keyframes slideIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
  }
</style>

</head>
<body>

{{-- OVERLAY MOBILE --}}
<div id="overlay" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside id="sidebar">

  {{-- BRAND --}}
  <div class="sidebar-brand">
    <a href="/" class="brand-logo">
      <img src="{{ asset('images/logo stikes.jpg') }}" alt="Logo STIKes">
    </a>
    <div class="brand-texts">
      <div class="brand-title">Sistem Inventarisasi</div>
      <div class="brand-sub">Laboratorium Farmasi</div>
    </div>
  </div>

  {{-- NAV --}}
  <nav class="sidebar-nav">

    <div class="nav-label">Menu Utama</div>

    <a href="{{ route('laboran.dashboard') }}"
       class="nav-item {{ request()->routeIs('laboran.dashboard*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v18h18M9 17V9m4 8V5m4 12v-6"/>
      </svg>
      Dashboard
    </a>

    <a href="{{ route('laboran.alat.index') }}"
       class="nav-item {{ request()->routeIs('laboran.alat*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085"/>
      </svg>
      Data Alat
    </a>

    <div class="nav-label" style="margin-top:8px">Manajemen</div>

    <a href="{{ route('laboran.mahasiswa.index') }}"
       class="nav-item {{ request()->routeIs('laboran.mahasiswa*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19a4 4 0 10-6 0m6 0H9m6 0h3m-9 0H6m6-9a4 4 0 100-8 4 4 0 000 8z"/>
      </svg>
      Kelola Akun
    </a>

    <a href="{{ route('laboran.peminjaman.index') }}"
       class="nav-item {{ request()->routeIs('laboran.peminjaman*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 9h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
      </svg>
      Peminjaman
    </a>

    <a href="{{ route('laboran.pengembalian.index') }}"
       class="nav-item {{ request()->routeIs('laboran.pengembalian*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15l-6-6m0 0l6-6M3 9h12a6 6 0 010 12h-3"/>
      </svg>
      Pengembalian
    </a>

    <a href="{{ route('laboran.maintenance.index') }}"
       class="nav-item {{ request()->routeIs('laboran.maintenance*') ? 'active' : '' }}">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085"/>
      </svg>
      Perawatan
    </a>

    <div class="nav-label" style="margin-top:8px">Laporan</div>

    <button class="nav-dropdown-toggle {{ request()->routeIs('laboran.laporan*') ? 'active-parent' : '' }}"
            data-dropdown="laporan">
      <div class="nav-dropdown-left">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
        </svg>
        <span>Laporan</span>
      </div>
      <svg class="chevron {{ request()->routeIs('laboran.laporan*') ? 'open' : '' }}"
           xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
      </svg>
    </button>

    <div id="dropdown-laporan"
         class="dropdown-children {{ request()->routeIs('laboran.laporan*') ? 'open' : '' }}">
      <a href="{{ route('laboran.laporan.alat') }}"
         class="nav-child {{ request()->routeIs('laboran.laporan.alat*') ? 'active' : '' }}">
        Laporan Alat
      </a>
      <a href="{{ route('laboran.laporan.pengembalian') }}"
         class="nav-child {{ request()->routeIs('laboran.laporan.pengembalian*') ? 'active' : '' }}">
        Peminjaman &amp; Pengembalian
      </a>
    </div>

  </nav>

  {{-- SIDEBAR FOOTER --}}
  <div class="sidebar-footer">
    <a href="{{ route('profile.edit') }}" class="sidebar-user">
      <div class="user-avatar-sm">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
      <div>
        <div class="user-name-sm">{{ Auth::user()->name }}</div>
        <div class="user-role-sm">Laboran</div>
      </div>
    </a>
  </div>

</aside>

{{-- MAIN --}}
<div id="main">

  {{-- TOPBAR --}}
  <header id="topbar">

    <div class="topbar-left">
      <button class="burger-btn" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:16px;height:16px">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
      </button>

      <div class="breadcrumb">
        <a href="{{ route('laboran.dashboard') }}" class="breadcrumb-home">LabFarma</a>
        <span class="breadcrumb-sep">›</span>
        <span class="page-title">@yield('title')</span>
      </div>
    </div>

    <div class="topbar-right">

      <button class="topbar-btn" title="Notifikasi">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
        </svg>
      </button>

      <div class="user-menu">
        <div class="user-trigger" id="userTrigger" onclick="toggleUserMenu()">
          <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
          <div class="user-info">
            <div class="user-display-name">{{ Auth::user()->name }}</div>
            <div class="user-display-role">Laboran</div>
          </div>
          <svg class="chevron-user" id="chevronUser" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </div>

        <div class="user-dropdown" id="userDropdown">
          <div class="dropdown-header">
            <div class="dropdown-header-name">{{ Auth::user()->name }}</div>
            <div class="dropdown-header-role">Laboran · Aktif</div>
          </div>
          <a href="{{ route('profile.edit') }}" class="dropdown-item">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"/>
            </svg>
            Edit Profil
          </a>
          <div class="dropdown-divider"></div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="dropdown-item danger">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-7.5A2.25 2.25 0 003.75 5.25v13.5A2.25 2.25 0 006 21h7.5a2.25 2.25 0 002.25-2.25V15m3-3l-3-3m3 3l-3 3m3-3H9"/>
              </svg>
              Keluar
            </button>
          </form>
        </div>
      </div>

    </div>
  </header>

  {{-- CONTENT --}}
  <main id="content">

    @if(session('success'))
      <div class="flash success">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="flash error">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z"/>
        </svg>
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
    document.body.style.overflow = open ? 'hidden' : '';
  }
  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('.nav-dropdown-toggle').forEach(btn => {
    const key      = btn.dataset.dropdown;
    const children = document.getElementById('dropdown-' + key);
    const chevron  = btn.querySelector('.chevron');
    btn.addEventListener('click', () => {
      const open = children.classList.toggle('open');
      chevron.classList.toggle('open', open);
    });
  });

  const userDropdown = document.getElementById('userDropdown');
  const chevronUser  = document.getElementById('chevronUser');

  function toggleUserMenu() {
    const open = userDropdown.classList.toggle('open');
    chevronUser.style.transform = open ? 'rotate(180deg)' : '';
  }

  document.addEventListener('click', e => {
    if (!e.target.closest('.user-menu')) {
      userDropdown.classList.remove('open');
      chevronUser.style.transform = '';
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>