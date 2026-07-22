<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap');

/* ===== NAVBAR ===== */
.main-header.navbar {
    background: #ffffff !important;
    border-bottom: 1px solid #e8ecf4 !important;
    box-shadow: 0 2px 16px rgba(8,15,46,.07) !important;
    min-height: 64px;
    padding: 0 24px;
    z-index: 1030;
}

.main-header .nav-link[data-widget="pushmenu"] {
    color: #64748b !important;
    font-size: 16px; padding: 0 12px !important;
    transition: color .2s;
}
.main-header .nav-link[data-widget="pushmenu"]:hover { color: #0f1f5c !important; }

/* Page title in navbar */
.navbar-page-title {
    font-family: 'Sora', sans-serif;
    font-size: 15px; font-weight: 700;
    color: #0f1f5c;
    margin-left: 4px;
}

/* Bell */
.navbar-notif {
    position: relative; padding: 8px 10px;
    border-radius: 10px; color: #64748b;
    text-decoration: none; transition: all .2s;
}
.navbar-notif:hover { background: #f0f4ff; color: #0f1f5c; }
.navbar-notif i { font-size: 17px; }
.navbar-notif .badge-dot {
    position: absolute; top: 6px; right: 7px;
    width: 18px; height: 18px;
    background: #f59e0b;
    border-radius: 50%; font-size: 9px; font-weight: 700;
    color: #fff; display: flex; align-items: center; justify-content: center;
    border: 2px solid #fff;
    font-family: 'Sora', sans-serif;
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
.navbar-user-btn:hover, .navbar-user-btn.open {
    background: #f0f4ff; border-color: rgba(15,31,92,.15);
}

.navbar-user-btn .user-info { text-align: right; line-height: 1.25; }

.navbar-user-btn .u-name {
    display: block; font-family: 'Sora', sans-serif;
    font-size: 13px; font-weight: 700; color: #0f1f5c;
}
.navbar-user-btn .u-role {
    display: block; font-family: 'Sora', sans-serif;
    font-size: 10.5px; color: #94a3b8;
}

.navbar-user-btn .user-avatar-circle {
    width: 36px; height: 36px; border-radius: 50%;
    background: linear-gradient(135deg, #0f1f5c, #3b7eff);
    display: flex; align-items: center; justify-content: center;
    color: white; font-family: 'Sora', sans-serif;
    font-size: 14px; font-weight: 800;
    flex-shrink: 0;
}

.navbar-user-btn .caret-icon {
    color: #94a3b8; font-size: 10px;
    transition: transform .2s; margin-left: 2px;
}
.navbar-user-btn.open .caret-icon { transform: rotate(180deg); }

/* Dropdown panel */
.user-dropdown-menu {
    display: none;
    position: absolute; top: calc(100% + 12px); right: 0;
    width: 290px; background: #ffffff;
    border: 1px solid #e8ecf4; border-radius: 18px;
    box-shadow: 0 16px 56px rgba(8,15,46,.14);
    z-index: 9999; overflow: hidden;
    animation: dropFadeIn .18s ease;
}
@keyframes dropFadeIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}
.user-dropdown-menu.show { display: block; }

/* Hero section */
.udm-hero {
    background: linear-gradient(155deg, #080f2e 0%, #0f1f5c 50%, #1a2e6f 100%);
    padding: 22px 20px 18px;
    display: flex; flex-direction: column;
    align-items: center; gap: 8px;
    position: relative; overflow: hidden;
}

.udm-hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 20px 20px; pointer-events: none;
}

.udm-avatar-circle {
    width: 60px; height: 60px; border-radius: 50%;
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    display: flex; align-items: center; justify-content: center;
    color: #0f1f5c; font-family: 'Sora', sans-serif;
    font-size: 22px; font-weight: 800;
    border: 3px solid rgba(255,255,255,.3);
    box-shadow: 0 6px 20px rgba(0,0,0,.2);
    position: relative; z-index: 1;
}

.udm-online {
    position: absolute; bottom: 2px; right: 2px;
    width: 14px; height: 14px;
    background: #22c55e; border-radius: 50%;
    border: 2px solid #fff;
}

.udm-hero-name {
    font-family: 'Sora', sans-serif;
    font-size: 14px; font-weight: 800;
    color: #ffffff; position: relative; z-index: 1;
}

.udm-hero-badge {
    background: rgba(245,158,11,.25);
    color: #fbbf24;
    font-family: 'Sora', sans-serif;
    font-size: 10.5px; font-weight: 600;
    padding: 3px 12px; border-radius: 20px;
    border: 1px solid rgba(245,158,11,.3);
    position: relative; z-index: 1;
}

/* Info rows */
.udm-info-section { padding: 12px 14px 4px; }

.udm-info-row {
    display: flex; align-items: center; gap: 11px;
    padding: 9px 10px; border-radius: 10px;
    transition: background .15s; margin-bottom: 2px;
}
.udm-info-row:hover { background: #f8faff; }

.udm-info-icon {
    width: 32px; height: 32px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.udm-info-icon i { font-size: 13px; }

.icon-bg-blue  { background: #eff6ff; } .icon-bg-blue i  { color: #3b7eff; }
.icon-bg-green { background: #f0fdf4; } .icon-bg-green i { color: #22c55e; }
.icon-bg-purple{ background: #faf5ff; } .icon-bg-purple i{ color: #a855f7; }
.icon-bg-gold  { background: #fffbeb; } .icon-bg-gold i  { color: #f59e0b; }

.udm-info-text { flex: 1; min-width: 0; }
.udm-info-text .info-label {
    font-family: 'Sora', sans-serif;
    font-size: 9.5px; font-weight: 700;
    color: #94a3b8; text-transform: uppercase;
    letter-spacing: .5px; display: block;
}
.udm-info-text .info-value {
    font-family: 'Sora', sans-serif;
    font-size: 12.5px; font-weight: 600;
    color: #1e293b; display: block;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

.udm-sep { height: 1px; background: #f1f5f9; margin: 6px 14px; }

/* Actions */
.udm-actions { padding: 4px 10px 10px; display: flex; flex-direction: column; gap: 2px; }

        .udm-action-btn {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: 10px;
            font-size: 13px; font-weight: 600;
            color: #475569; text-decoration: none;
            transition: all .15s; cursor: pointer;
            border: none; background: transparent; width: 100%; text-align: left;
        }
.udm-action-btn:hover { background: #f0f4ff; color: #0f1f5c; }
.udm-action-btn i { width: 18px; text-align: center; font-size: 13px; color: #94a3b8; }
.udm-action-btn:hover i { color: #0f1f5c; }

.udm-action-btn.logout { color: #ef4444; }
.udm-action-btn.logout:hover { background: #fef2f2; color: #dc2626; }
.udm-action-btn.logout i { color: #fca5a5; }
.udm-action-btn.logout:hover i { color: #dc2626; }
<span class="badge-dot"></span>
/* Content wrapper */
.content-wrapper { background: #f0f4ff !important; }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto d-flex align-items-center">

       

        <li class="nav-item"><div class="navbar-divider"></div></li>

        <li class="nav-item navbar-user-dropdown">
            <button class="navbar-user-btn" id="userDropdownBtn" onclick="toggleUserDropdown(event)">
                <div class="user-info">
                    <span class="u-name">{{ auth()->user()->name }}</span>
                    <span class="u-role">@role('admin') Administrator @else Petugas @endrole</span>
                </div>
                <div class="user-avatar-circle">
    @if(auth()->user()->foto)
        <img src="{{ asset('storage/' . auth()->user()->foto) }}?v={{ time() }}"
             alt="User"
             style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
    @else
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
    @endif
</div>
                <i class="fas fa-chevron-down caret-icon"></i>
            </button>

            <div class="user-dropdown-menu" id="userDropdownMenu">

                <div class="udm-hero">
                <div class="udm-avatar-circle" style="position:relative; overflow:hidden;">

@if(auth()->user()->foto)
    <img src="{{ asset('storage/' . auth()->user()->foto) }}?v={{ time() }}"
         alt="User"
         style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
@else
    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
@endif

<span class="udm-online"></span>
</div>
                    <p class="udm-hero-name">{{ auth()->user()->name }}</p>
                    <span class="udm-hero-badge">
                        @role('admin') Administrator @else Petugas @endrole
                    </span>
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
                            <span class="info-label">Role</span>
                            <span class="info-value">@role('admin') Administrator @else Petugas @endrole</span>
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
                            <i class="fas fa-user-circle"></i> Detail Profile
                        </a>
                    <button class="udm-action-btn logout"
                        onclick="document.getElementById('navbar-logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>

            <form id="navbar-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<script>
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
</script>
