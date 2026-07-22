<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap');

/* ===== SIDEBAR — Perpus Theme ===== */
.main-sidebar {
    background: linear-gradient(180deg, #080f2e 0%, #0f1f5c 40%, #1a2e6f 100%) !important;
    box-shadow: 4px 0 24px rgba(8,15,46,.4) !important;
    border-right: none !important;
    position: relative;
}

.main-sidebar::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.04) 1px, transparent 1px);
    background-size: 24px 24px;
    pointer-events: none;
    z-index: 0;
}

/* Brand */
.brand-link {
    background: rgba(255,255,255,.06) !important;
    border-bottom: 1px solid rgba(255,255,255,.08) !important;
    padding: 18px 20px !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    position: relative; z-index: 1;
}

.brand-link:hover { background: rgba(255,255,255,.1) !important; }

.brand-logo-icon {
    width: 40px; height: 40px;
    background: white;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0,0,0,.2);
}

.brand-logo-icon i { color: #0f1f5c; font-size: 18px; }

.brand-text-wrap { display: flex; flex-direction: column; line-height: 1.2; }

.brand-text-wrap .brand-name {
    color: #ffffff !important;
    font-family: 'Sora', sans-serif;
    font-weight: 800; font-size: 14px;
    letter-spacing: -.01em;
}

.brand-text-wrap .brand-sub {
    color: rgba(255,255,255,.45);
    font-family: 'Sora', sans-serif;
    font-size: 9.5px; font-weight: 400;
    letter-spacing: .08em; text-transform: uppercase;
}

/* User panel */
.sidebar .user-panel {
    border-bottom: 1px solid rgba(255,255,255,.08) !important;
    padding: 16px !important;
    margin: 0 0 4px !important;
    background: rgba(255,255,255,.04);
    position: relative; z-index: 1;
}

.user-panel .image img {
    border: 2px solid rgba(255,255,255,.25) !important;
    width: 38px; height: 38px;
}

.user-panel .info a {
    color: #ffffff !important;
    font-family: 'Sora', sans-serif;
    font-weight: 700; font-size: 13px;
}

.user-panel .info .user-role {
    color: rgba(255,255,255,.5);
    font-family: 'Sora', sans-serif;
    font-size: 10.5px; display: block; margin-top: 1px;
}

/* Nav header */
.nav-sidebar .nav-header {
    color: rgba(255,255,255,.3) !important;
    font-family: 'Sora', sans-serif !important;
    font-size: 9.5px !important; font-weight: 700 !important;
    letter-spacing: 2px !important;
    padding: 18px 16px 6px !important;
    text-transform: uppercase;
}

/* Nav links */
.nav-sidebar .nav-link {
    color: rgba(255,255,255,.65) !important;
    font-family: 'Sora', sans-serif;
    font-size: 13px; font-weight: 600;
    border-radius: 10px !important;
    margin: 2px 10px !important;
    padding: 10px 14px !important;
    transition: all .2s !important;
    display: flex; align-items: center; gap: 4px;
    position: relative; z-index: 1;
}

.nav-sidebar .nav-link:hover {
    background: rgba(255,255,255,.1) !important;
    color: #ffffff !important;
    transform: translateX(3px);
}

/* Active — gold accent */
.nav-sidebar .nav-link.active {
    background: #f59e0b !important;
    color: #0f1f5c !important;
    box-shadow: 0 4px 16px rgba(245,158,11,.35);
}

.nav-sidebar .nav-link.active .nav-icon {
    color: #0f1f5c !important;
}

.nav-sidebar .nav-icon {
    color: rgba(255,255,255,.5) !important;
    font-size: 15px !important;
    width: 20px !important;
    margin-right: 10px !important;
}

.nav-sidebar .nav-link:hover .nav-icon { color: rgba(255,255,255,.9) !important; }

/* Treeview */
.nav-treeview .nav-link {
    padding: 8px 14px 8px 44px !important;
    font-size: 12.5px !important;
}

.nav-treeview .nav-link .nav-icon { font-size: 5px !important; }

.nav-treeview .nav-link.active .nav-icon { color: #0f1f5c !important; }

/* Sidebar */
.sidebar { position: relative; z-index: 1; }

/* Logout */
.sidebar-logout { margin: 12px 10px 10px; }

.sidebar-logout a {
    display: flex; align-items: center; gap: 10px;
    color: rgba(255,255,255,.5) !important;
    font-family: 'Sora', sans-serif;
    font-size: 13px; font-weight: 600;
    padding: 10px 14px; border-radius: 10px;
    border: 1px solid rgba(255,255,255,.1);
    transition: all .2s; text-decoration: none;
}

.sidebar-logout a:hover {
    background: rgba(239,68,68,.15);
    color: #fca5a5 !important;
    border-color: rgba(239,68,68,.3);
}

/* Scrollbar */
.sidebar::-webkit-scrollbar { width: 3px; }
.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,.15); border-radius: 4px;
}
</style>

<aside class="main-sidebar elevation-0">
    <a href="/dashboard" class="brand-link" style="text-decoration:none;">
        <div class="brand-logo-icon">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="brand-text-wrap">
            <span class="brand-name">Perpustakaan</span>
            <span class="brand-sub">SDN Pasireurih</span>
        </div>
    </a>

    <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-1 d-flex align-items-center">
        
        <div class="image">
            @if(auth()->user()->foto)
                <img src="{{ asset('storage/' . auth()->user()->foto) }}?v={{ time() }}"
                     class="img-circle elevation-0"
                     alt="User"
                     style="width:34px; height:34px; object-fit:cover;">
            @else
                <img src="/adminlte/dist/img/user2-160x160.jpg"
                     class="img-circle elevation-0"
                     alt="User"
                     style="width:34px; height:34px; object-fit:cover;">
            @endif
        </div>

        <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>

            <span class="user-role">
                @role('admin')
                    Administrator
                @else
                    Petugas
                @endrole
            </span>
        </div>

    </div>

        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link @yield('active-dashboard')">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">Master</li>

                <li class="nav-item">
                    <a href="#" class="nav-link @yield('active-data-master')">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data Master <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/kategori" class="nav-link @yield('active-kategori')">
                                <i class="far fa-circle nav-icon"></i><p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/rak" class="nav-link @yield('active-rak')">
                                <i class="far fa-circle nav-icon"></i><p>Rak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/penerbit" class="nav-link @yield('active-penerbit')">
                                <i class="far fa-circle nav-icon"></i><p>Penerbit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/buku" class="nav-link @yield('active-buku')">
                                <i class="far fa-circle nav-icon"></i><p>Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/transaksi" class="nav-link @yield('active-transaksi')">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Transaksi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/chart" class="nav-link @yield('active-chart')">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Chart</p>
                    </a>
                </li>

                <li class="nav-item">
    <a href="/anggota" class="nav-link @yield('active-anggota')">
        <i class="nav-icon fas fa-users"></i>
        <p>Anggota</p>
    </a>
</li>

@role('admin')
    <li class="nav-header">Pengaturan</li>
    <li class="nav-item">
        <a href="/user" class="nav-link @yield('active-user')">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>User</p>
        </a>
    </li>
@endrole

            </ul>
        </nav>

        <div class="sidebar-logout">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
            <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</aside>
