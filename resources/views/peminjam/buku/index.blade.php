<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Koleksi Buku — Perpustakaan SDN Pasireurih</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @livewireStyles
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Sora', sans-serif;
            background: #f0f4ff;
            min-height: 100vh;
            display: flex;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: 260px; min-height: 100vh;
            background: linear-gradient(180deg, #080f2e 0%, #0f1f5c 40%, #1a2e6f 100%);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0;
            z-index: 200; box-shadow: 4px 0 24px rgba(8,15,46,.4);
        }
        .sidebar::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 24px 24px; pointer-events: none; z-index: 0;
        }

        .sidebar-brand {
            display: flex; align-items: center; gap: 12px;
            padding: 18px 20px; background: rgba(255,255,255,.06);
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none; position: relative; z-index: 1;
            transition: background .2s;
        }
        .sidebar-brand:hover { background: rgba(255,255,255,.1); }

        .brand-logo {
            width: 40px; height: 40px; background: #fff; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,.2);
        }
        .brand-logo i { color: #0f1f5c; font-size: 18px; }

        .brand-texts { line-height: 1.2; }
        .brand-texts .b-name { font-size: 14px; font-weight: 800; color: #fff; display: block; letter-spacing: -.01em; }
        .brand-texts .b-sub  { font-size: 9.5px; color: rgba(255,255,255,.45); display: block; letter-spacing: .08em; text-transform: uppercase; }

        /* User panel */
        .sidebar-user {
            display: flex; align-items: center; gap: 12px;
            padding: 16px; border-bottom: 1px solid rgba(255,255,255,.08);
            background: rgba(255,255,255,.04); position: relative; z-index: 1;
        }
        .su-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: rgba(255,255,255,.2); border: 2px solid rgba(255,255,255,.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; font-weight: 800; color: #fff;
            flex-shrink: 0; overflow: hidden;
        }
        .su-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
        .su-info .su-name { font-size: 13px; font-weight: 700; color: #fff; display: block; }
        .su-info .su-role  { font-size: 10.5px; color: rgba(255,255,255,.5); display: block; margin-top: 1px; }

        /* Nav */
        .sidebar-nav { flex: 1; padding: 10px 0; overflow-y: auto; position: relative; z-index: 1; }

        .nav-header-label {
            font-size: 9.5px; font-weight: 700; color: rgba(255,255,255,.3);
            letter-spacing: 2px; text-transform: uppercase; padding: 18px 16px 6px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; margin: 2px 10px; border-radius: 10px;
            font-size: 13px; font-weight: 600; color: rgba(255,255,255,.65);
            text-decoration: none; transition: all .2s;
        }
        .nav-item:hover { background: rgba(255,255,255,.1); color: #fff; transform: translateX(3px); }
        .nav-item.active { background: #f59e0b; color: #0f1f5c; box-shadow: 0 4px 16px rgba(245,158,11,.35); }
        .nav-item.active i { color: #0f1f5c; }
        .nav-item.active:hover { transform: none; }
        .nav-item i { width: 20px; text-align: center; font-size: 14px; color: rgba(255,255,255,.5); }
        .nav-item:hover i { color: inherit; }

        .nav-badge {
            margin-left: auto; background: #ef4444; color: #fff;
            font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 99px;
        }

        /* Sidebar logout */
        .sidebar-logout { padding: 10px 10px 16px; position: relative; z-index: 1; }
        .sidebar-logout a {
            display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,.5); font-size: 13px; font-weight: 600;
            padding: 10px 14px; border-radius: 10px;
            border: 1px solid rgba(255,255,255,.1); transition: all .2s; text-decoration: none;
        }
        .sidebar-logout a:hover { background: rgba(239,68,68,.15); color: #fca5a5; border-color: rgba(239,68,68,.3); }

        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.15); border-radius: 4px; }

        /* ===================== MAIN WRAPPER ===================== */
        .main-wrapper { margin-left: 260px; flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* ===================== TOPBAR ===================== */
        .topbar {
            position: sticky; top: 0; z-index: 100;
            background: #ffffff; border-bottom: 1px solid #e8ecf4;
            box-shadow: 0 2px 16px rgba(8,15,46,.07);
            height: 64px; padding: 0 24px;
            display: flex; align-items: center; justify-content: space-between;
        }

        .topbar-left { font-size: 15px; font-weight: 700; color: #0f1f5c; display: flex; align-items: center; gap: 8px; }
        .topbar-left i { font-size: 14px; }
        .topbar-right { display: flex; align-items: center; gap: 8px; }

        /* Notif bell */
        .navbar-notif {
            position: relative; padding: 8px 10px; border-radius: 10px;
            color: #64748b; text-decoration: none; transition: all .2s;
        }
        .navbar-notif:hover { background: #f0f4ff; color: #0f1f5c; }
        .navbar-notif i { font-size: 17px; }
        .navbar-notif .badge-dot {
            position: absolute; top: 6px; right: 7px;
            width: 18px; height: 18px; background: #f59e0b; border-radius: 50%;
            font-size: 9px; font-weight: 700; color: #fff;
            display: flex; align-items: center; justify-content: center;
            border: 2px solid #fff;
        }

        .navbar-divider { width: 1px; height: 28px; background: #e8ecf4; margin: 0 8px; }

        /* User dropdown */
        .navbar-user-dropdown { position: relative; }
        .navbar-user-btn {
            display: flex; align-items: center; gap: 10px;
            padding: 6px 12px; border-radius: 10px;
            cursor: pointer; transition: background .2s;
            border: 1.5px solid #e8ecf4; background: transparent; outline: none;
        }
        .navbar-user-btn:hover, .navbar-user-btn.open { background: #f0f4ff; border-color: rgba(15,31,92,.15); }
        .navbar-user-btn .user-info { text-align: right; line-height: 1.25; }
        .navbar-user-btn .u-name { display: block; font-size: 13px; font-weight: 700; color: #0f1f5c; }
        .navbar-user-btn .u-role { display: block; font-size: 10.5px; color: #94a3b8; }
        .user-avatar-circle {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, #0f1f5c, #3b7eff);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 14px; font-weight: 800;
            flex-shrink: 0; overflow: hidden;
        }
        .user-avatar-circle img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
        .caret-icon { color: #94a3b8; font-size: 10px; transition: transform .2s; margin-left: 2px; }
        .navbar-user-btn.open .caret-icon { transform: rotate(180deg); }

        /* Dropdown panel */
        .user-dropdown-menu {
            display: none; position: absolute; top: calc(100% + 12px); right: 0;
            width: 290px; background: #fff; border: 1px solid #e8ecf4;
            border-radius: 18px; box-shadow: 0 16px 56px rgba(8,15,46,.14);
            z-index: 9999; overflow: hidden; animation: dropFadeIn .18s ease;
        }
        @keyframes dropFadeIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
        .user-dropdown-menu.show { display: block; }

        .udm-hero {
            background: linear-gradient(155deg, #080f2e 0%, #0f1f5c 50%, #1a2e6f 100%);
            padding: 22px 20px 18px; display: flex; flex-direction: column;
            align-items: center; gap: 8px; position: relative; overflow: hidden;
        }
        .udm-hero::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px); background-size: 20px 20px; pointer-events: none; }
        .udm-avatar-circle { width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #fbbf24); display: flex; align-items: center; justify-content: center; color: #0f1f5c; font-size: 22px; font-weight: 800; border: 3px solid rgba(255,255,255,.3); box-shadow: 0 6px 20px rgba(0,0,0,.2); position: relative; z-index: 1; overflow: hidden; }
        .udm-avatar-circle img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
        .udm-online { position: absolute; bottom: 2px; right: 2px; width: 14px; height: 14px; background: #22c55e; border-radius: 50%; border: 2px solid #fff; }
        .udm-hero-name { font-size: 14px; font-weight: 800; color: #fff; position: relative; z-index: 1; }
        .udm-hero-badge { background: rgba(245,158,11,.25); color: #fbbf24; font-size: 10.5px; font-weight: 600; padding: 3px 12px; border-radius: 20px; border: 1px solid rgba(245,158,11,.3); position: relative; z-index: 1; }

        .udm-info-section { padding: 12px 14px 4px; }
        .udm-info-row { display: flex; align-items: center; gap: 11px; padding: 9px 10px; border-radius: 10px; transition: background .15s; margin-bottom: 2px; text-decoration: none; }
        .udm-info-row:hover { background: #f8faff; }
        .udm-info-icon { width: 32px; height: 32px; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .udm-info-icon i { font-size: 13px; }
        .icon-bg-blue { background: #eff6ff; } .icon-bg-blue i { color: #3b7eff; }
        .icon-bg-green { background: #f0fdf4; } .icon-bg-green i { color: #22c55e; }
        .icon-bg-purple { background: #faf5ff; } .icon-bg-purple i { color: #a855f7; }
        .icon-bg-gold { background: #fffbeb; } .icon-bg-gold i { color: #f59e0b; }
        .udm-info-text { flex: 1; min-width: 0; }
        .udm-info-text .info-label { font-size: 9.5px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .5px; display: block; }
        .udm-info-text .info-value { font-size: 12.5px; font-weight: 600; color: #1e293b; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .udm-sep { height: 1px; background: #f1f5f9; margin: 6px 14px; }
        .udm-actions { padding: 4px 10px 10px; display: flex; flex-direction: column; gap: 2px; }
        .udm-action-btn { display: flex; align-items: center; gap: 10px; padding: 9px 10px; border-radius: 10px; font-size: 13px; font-weight: 600; color: #475569; text-decoration: none; transition: all .15s; cursor: pointer; border: none; background: transparent; width: 100%; text-align: left; font-family: 'Sora', sans-serif; }
        .udm-action-btn:hover { background: #f0f4ff; color: #0f1f5c; }
        .udm-action-btn i { width: 18px; text-align: center; font-size: 13px; color: #94a3b8; }
        .udm-action-btn:hover i { color: #0f1f5c; }
        .udm-action-btn.logout { color: #ef4444; }
        .udm-action-btn.logout:hover { background: #fef2f2; color: #dc2626; }
        .udm-action-btn.logout i { color: #fca5a5; }
        .udm-action-btn.logout:hover i { color: #dc2626; }

        /* Tombol beranda untuk guest */
        .btn-beranda {
            display: inline-flex; align-items: center; gap: 7px;
            background: #f0f4ff; color: #0f1f5c;
            border: 1.5px solid #c7d7fd; border-radius: 9px;
            padding: 8px 14px; font-size: 13px; font-weight: 700;
            text-decoration: none; transition: all .2s;
        }
        .btn-beranda:hover { background: #e0e8ff; color: #0f1f5c; text-decoration: none; }

        /* ===================== PAGE CONTENT ===================== */
        .page-content { flex: 1; padding: 28px 32px 48px; }

        /* ===================== PAGE LOADER ===================== */
        #page-loader {
            position: fixed; inset: 0; z-index: 9999;
            background: linear-gradient(155deg, #080f2e 0%, #0f1f5c 55%, #1a2e6f 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 28px;
            transition: opacity .5s ease, visibility .5s ease;
        }
        #page-loader.hide { opacity: 0; visibility: hidden; }
        #page-loader::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.05) 1px, transparent 1px);
            background-size: 26px 26px; pointer-events: none;
        }
        .pl-book {
            position: relative; width: 64px; height: 64px;
            display: flex; align-items: center; justify-content: center;
        }
        .pl-book-icon {
            font-size: 36px; color: #fbbf24;
            animation: bookPulse 1.4s ease-in-out infinite;
            position: relative; z-index: 1;
        }
        @keyframes bookPulse {
            0%, 100% { transform: scale(1) rotate(-3deg); opacity: 1; }
            50%       { transform: scale(1.15) rotate(3deg); opacity: .85; }
        }
        .pl-book-ring {
            position: absolute; inset: -8px; border-radius: 50%;
            border: 2.5px solid rgba(245,158,11,.25);
            animation: ringExpand 1.4s ease-in-out infinite;
        }
        .pl-book-ring:nth-child(2) { inset: -18px; border-color: rgba(245,158,11,.12); animation-delay: .3s; }
        @keyframes ringExpand {
            0%   { transform: scale(.7); opacity: .7; }
            100% { transform: scale(1.3); opacity: 0; }
        }
        .pl-brand { display: flex; flex-direction: column; align-items: center; gap: 4px; position: relative; z-index: 1; }
        .pl-brand-name { font-size: 22px; font-weight: 800; color: #fff; letter-spacing: -.02em; }
        .pl-brand-sub  { font-size: 11px; font-weight: 600; color: rgba(255,255,255,.4); letter-spacing: .15em; text-transform: uppercase; }
        .pl-progress-wrap { width: 200px; position: relative; z-index: 1; }
        .pl-progress-track { height: 4px; background: rgba(255,255,255,.1); border-radius: 99px; overflow: hidden; }
        .pl-progress-fill {
            height: 100%; width: 0%;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            border-radius: 99px;
            animation: progressFill 1.6s cubic-bezier(.4,0,.2,1) forwards;
            box-shadow: 0 0 10px rgba(245,158,11,.5);
        }
        @keyframes progressFill { 0% { width:0%; } 60% { width:75%; } 100% { width:100%; } }
        .pl-text { font-size: 12px; font-weight: 600; color: rgba(255,255,255,.45); letter-spacing: .05em; position: relative; z-index: 1; }

        /* Fade-in halaman */
        .main-wrapper, .sidebar { opacity: 0; }
        .main-wrapper.loaded, .sidebar.loaded { opacity: 1; transition: opacity .4s ease .1s; }

        @media (max-width: 768px) { .sidebar { display: none; } .main-wrapper { margin-left: 0; } }
    </style>
</head>
<body>

{{-- ===================== PAGE LOADER ===================== --}}
<div id="page-loader">
    <div class="pl-book">
        <span class="pl-book-ring"></span>
        <span class="pl-book-ring"></span>
        <i class="fas fa-book-open pl-book-icon"></i>
    </div>
    <div class="pl-brand">
        <span class="pl-brand-name">Perpustakaan</span>
        <span class="pl-brand-sub">SDN Pasireurih</span>
    </div>
    <div class="pl-progress-wrap">
        <div class="pl-progress-track">
            <div class="pl-progress-fill"></div>
        </div>
    </div>
    <span class="pl-text">Memuat koleksi buku...</span>
</div>

{{-- ===================== SIDEBAR ===================== --}}
<aside class="sidebar">
    <a href="{{ route('landing') }}" class="sidebar-brand">
        <div class="brand-logo"><i class="fas fa-book-open"></i></div>
        <div class="brand-texts">
            <span class="b-name">Perpustakaan</span>
            <span class="b-sub">SDN Pasierurih</span>
        </div>
    </a>

    @auth
    <div class="sidebar-user">
        <div class="su-avatar">
            @if(auth()->user()->foto)
                <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <div class="su-info">
            <span class="su-name">{{ auth()->user()->name }}</span>
            <span class="su-role">Peminjam</span>
        </div>
    </div>
    @endauth

    <nav class="sidebar-nav">
        <div class="nav-header-label">Menu</div>

        <a href="{{ route('dashboard.peminjam') }}" class="nav-item">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="{{ route('koleksi.buku') }}" class="nav-item active">
            <i class="fas fa-book-open"></i> Koleksi Buku
        </a>

        @auth
        @php
            $jmlKeranjang = \App\Models\Peminjaman::where('peminjam_id', auth()->user()->id)
                ->where('status', 0)->first();
            $jmlKeranjang = $jmlKeranjang ? $jmlKeranjang->detail_peminjaman->count() : 0;
        @endphp
        <a href="/keranjang" class="nav-item">
            <i class="fas fa-shopping-cart"></i> Keranjang
            @if($jmlKeranjang > 0)
                <span class="nav-badge">{{ $jmlKeranjang }}</span>
            @endif
        </a>

        <div class="nav-header-label" style="margin-top:8px;">Akun</div>

        <a href="{{ route('profile') }}" class="nav-item">
            <i class="fas fa-user-circle"></i> Profil Saya
        </a>
        @endauth
    </nav>

    @auth
    <div class="sidebar-logout">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
        <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>
    @endauth
</aside>

{{-- ===================== MAIN WRAPPER ===================== --}}
<div class="main-wrapper">

    {{-- TOPBAR --}}
    <header class="topbar">
        <div class="topbar-left">
            @guest
            <a href="{{ route('landing') }}" class="btn-beranda">
                <i class="fas fa-arrow-left"></i> Beranda
            </a>
            @endguest
            <i class="fas fa-book-open"></i> Koleksi Buku
        </div>

        <div class="topbar-right">
            @auth
            <a href="/keranjang" class="navbar-notif">
                <i class="far fa-bell"></i>
                @if($jmlKeranjang > 0)
                    <span class="badge-dot">{{ $jmlKeranjang }}</span>
                @endif
            </a>

            <div class="navbar-divider"></div>

            <div class="navbar-user-dropdown">
                <button class="navbar-user-btn" id="userDropdownBtn" onclick="toggleUserDropdown(event)">
                    <div class="user-info">
                        <span class="u-name">{{ auth()->user()->name }}</span>
                        <span class="u-role">Peminjam</span>
                    </div>
                    <div class="user-avatar-circle">
                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}?v={{ time() }}" alt="User">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @endif
                    </div>
                    <i class="fas fa-chevron-down caret-icon"></i>
                </button>

                <div class="user-dropdown-menu" id="userDropdownMenu">
                    <div class="udm-hero">
                        <div class="udm-avatar-circle" style="position:relative;">
                            @if(auth()->user()->foto)
                                <img src="{{ asset('storage/' . auth()->user()->foto) }}?v={{ time() }}" alt="User">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                            <span class="udm-online"></span>
                        </div>
                        <p class="udm-hero-name">{{ auth()->user()->name }}</p>
                        <span class="udm-hero-badge">Peminjam</span>
                    </div>

                    <div class="udm-info-section">
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-blue"><i class="fas fa-user"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Nama</span>
                                <span class="info-value">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-purple"><i class="fas fa-envelope"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-green"><i class="fas fa-shield-alt"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Status</span>
                                <span class="info-value">Peminjam Aktif</span>
                            </div>
                        </div>
                        <div class="udm-info-row">
                            <div class="udm-info-icon icon-bg-gold"><i class="fas fa-calendar-alt"></i></div>
                            <div class="udm-info-text">
                                <span class="info-label">Bergabung</span>
                                <span class="info-value">{{ auth()->user()->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="udm-sep"></div>

                    <div class="udm-actions">
                        <a href="{{ route('profile') }}" class="udm-action-btn">
                            <i class="fas fa-user-circle"></i> Detail Profil
                        </a>
                        <button class="udm-action-btn logout"
                            onclick="document.getElementById('navbar-logout-form').submit()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </div>
                </div>

                <form id="navbar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
            @endauth

            @guest
            <a href="{{ route('login') }}" class="btn-beranda">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </a>
            @endguest
        </div>
    </header>

    {{-- PAGE CONTENT — Livewire component --}}
    <div class="page-content">
        <livewire:peminjam.buku />
    </div>

</div>

@livewireScripts
<script>
// Navbar dropdown
function toggleUserDropdown(e) {
    e.stopPropagation();
    document.getElementById('userDropdownBtn').classList.toggle('open');
    document.getElementById('userDropdownMenu').classList.toggle('show');
}
document.addEventListener('click', function(e) {
    var btn  = document.getElementById('userDropdownBtn');
    var menu = document.getElementById('userDropdownMenu');
    if (!btn || !menu) return;
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
        btn.classList.remove('open');
        menu.classList.remove('show');
    }
});

// ===== PAGE LOADER =====
window.addEventListener('load', function () {
    setTimeout(function () {
        var loader  = document.getElementById('page-loader');
        var sidebar = document.querySelector('.sidebar');
        var main    = document.querySelector('.main-wrapper');

        loader.classList.add('hide');
        if (sidebar) sidebar.classList.add('loaded');
        if (main)    main.classList.add('loaded');

        setTimeout(function () { loader.remove(); }, 550);
    }, 1700);
});
</script>
</body>
</html>