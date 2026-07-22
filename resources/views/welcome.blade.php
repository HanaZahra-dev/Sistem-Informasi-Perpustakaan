<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan SDN Pasireurih</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
    --navy:    #0f1f5c;
    --navy2:   #1a2e6f;
    --navy-deep: #0a1744;
    --accent:  #3b7eff;
    --gold:    #f59e0b;
    --gold-lt: #fbbf24;
    --white:   #ffffff;
    --muted:   rgba(255,255,255,.6);
    --border:  rgba(255,255,255,.13);
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: linear-gradient(155deg, #0a1744 0%, #1a2e6f 45%, #1e3a8a 75%, #1e40af 100%);
    color: var(--white);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;


        /* dot grid */
        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        /* orbs */
        .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0; }
.orb-1 { width: 500px; height: 500px; background: #3b7eff; opacity: .35; top: -100px; right: -100px; }
.orb-2 { width: 350px; height: 350px; background: var(--gold); opacity: .15; bottom: -80px; left: 20%; }
.orb-3 { width: 250px; height: 250px; background: #60a5fa;  opacity: .2;  top: 30%;  left: -60px; }

        .wrap { max-width: 1200px; margin: 0 auto; padding: 0 40px; width: 100%; position: relative; z-index: 1; }

        /* ── HEADER ── */
        .header {
            border-bottom: 1px solid var(--border);
            padding: 15px 0;
            position: relative; z-index: 10;
        }
        .header .wrap { display: flex; align-items: center; gap: 14px; }

        .header-logo {
            width: 46px; height: 46px;
            background: rgba(255,255,255,.1);
            border: 1.5px solid rgba(255,255,255,.18);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .header-logo i { font-size: 19px; color: var(--white); }

        .header-divider { width: 1.5px; height: 34px; background: rgba(255,255,255,.15); flex-shrink: 0; }

        .header-nama {
            font-family: 'Sora', sans-serif;
            font-size: 14.5px; font-weight: 800;
            color: var(--white); letter-spacing: .04em;
            text-transform: uppercase; line-height: 1.2;
        }
        .header-sub { font-size: 11.5px; font-weight: 500; color: var(--muted); margin-top: 2px; }

        /* ── HERO ── */
        .hero-section {
            padding: 52px 0 44px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 52px;
            align-items: center;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.09);
            border: 1px solid rgba(255,255,255,.18);
            color: rgba(255,255,255,.88);
            font-size: 11px; font-weight: 600;
            letter-spacing: .08em; text-transform: uppercase;
            padding: 6px 14px; border-radius: 99px;
            margin-bottom: 22px;
            backdrop-filter: blur(8px);
        }
        .hero-badge .dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 8px #4ade80;
            animation: pulse 2s infinite;
        }

        .hero-judul {
            font-family: 'Sora', sans-serif;
            font-size: clamp(2.2rem, 4vw, 3.4rem);
            font-weight: 800; line-height: 1.1;
            color: var(--white);
            letter-spacing: -.02em; margin-bottom: 8px;
        }
        .hero-judul .aksen {
            color: var(--gold);
            position: relative; display: inline-block;
        }
        .hero-judul .aksen::after {
            content: '';
            position: absolute; bottom: 3px; left: 0; right: 0;
            height: 3px; background: var(--gold);
            border-radius: 2px; opacity: .45;
        }

        .hero-rule { width: 52px; height: 4px; background: var(--gold); border-radius: 2px; margin: 20px 0; }

        .hero-desc {
            font-size: 15px; font-weight: 500;
            color: var(--muted); line-height: 1.8;
            max-width: 380px; margin-bottom: 12px;
        }
        .hero-tagline { font-size: 13.5px; font-style: italic; font-weight: 600; color: rgba(255,255,255,.65); }

        /* foto kanan */
        .foto-wrap { position: relative; }

        .foto-card {
            border-radius: 18px; overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 24px 60px rgba(0,0,0,.45);
            position: relative;
        }
        .foto-card img {
            width: 100%; display: block;
            height: 320px; object-fit: cover; object-position: center;
        }
        .foto-card::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(10,23,68,.65) 0%, transparent 55%);
        }

        .foto-badge {
            position: absolute; bottom: 16px; left: 16px; z-index: 2;
            background: rgba(10,23,68,.82);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 11px; padding: 9px 14px;
            display: flex; align-items: center; gap: 10px;
            animation: float 4s ease-in-out infinite;
        }
        .foto-badge-icon {
            width: 30px; height: 30px; border-radius: 8px;
            background: var(--gold);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .foto-badge-icon i { font-size: 14px; color: var(--navy-deep); }
        .foto-badge-name { font-family: 'Sora', sans-serif; font-size: 12px; font-weight: 700; color: #fff; display: block; }
        .foto-badge-sub  { font-size: 10.5px; font-weight: 500; color: var(--muted); display: block; margin-top: 1px; }

        .foto-wrap::before {
            content: '';
            position: absolute; top: -36px; right: -36px;
            width: 240px; height: 240px; border-radius: 50%;
            background: radial-gradient(circle, rgba(245,158,11,.13), transparent 70%);
            pointer-events: none;
        }

        /* ── TOMBOL ── */
        .tombol-section { padding: 0 0 48px; }

        .tombol-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .tombol-kartu {
            display: flex; align-items: center; gap: 20px;
            border-radius: 16px; padding: 26px 28px;
            text-decoration: none; color: inherit;
            transition: transform .2s, box-shadow .2s;
            border: 1.5px solid;
            position: relative; overflow: hidden;
        }
        .tombol-kartu:focus-visible { outline: 2px solid var(--gold); outline-offset: 3px; }

        /* primer = putih — paling menonjol di dark bg */
        .tombol-kartu.primer {
            background: var(--white);
            border-color: var(--white);
            box-shadow: 0 8px 32px rgba(0,0,0,.3);
        }
        .tombol-kartu.primer:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,.4); }

        /* sekunder = glass */
        .tombol-kartu.sekunder {
            background: rgba(255,255,255,.07);
            border-color: rgba(255,255,255,.2);
            backdrop-filter: blur(6px);
        }
        .tombol-kartu.sekunder:hover { transform: translateY(-3px); background: rgba(255,255,255,.12); border-color: rgba(255,255,255,.38); }

        .tombol-ikon-wrap {
            width: 72px; height: 72px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .tombol-kartu.primer  .tombol-ikon-wrap { background: var(--navy); }
        .tombol-kartu.sekunder .tombol-ikon-wrap { background: rgba(255,255,255,.12); }
        .tombol-ikon-wrap i { font-size: 28px; color: var(--white); }

        .tombol-judul {
            font-family: 'Sora', sans-serif;
            font-size: 18px; font-weight: 800;
            text-transform: uppercase; letter-spacing: .03em; margin-bottom: 5px;
        }
        
        .tombol-kartu.primer  .tombol-judul { color: var(--navy); }
        .tombol-kartu.sekunder .tombol-judul { color: var(--white); }

        .tombol-sub { font-size: 13px; font-weight: 500; line-height: 1.55; }
        .tombol-kartu.primer  .tombol-sub { color: #64748b; }
        .tombol-kartu.sekunder .tombol-sub { color: var(--muted); }

        /* ── INFO BAR ── */
        .info-section { padding: 0 0 44px; }

        .info-bar {
            background: rgba(255,255,255,.06);
            border: 1px solid var(--border);
            border-radius: 14px;
            display: grid;
            grid-template-columns: 1.1fr 1fr 1fr 1fr 1.2fr;
            backdrop-filter: blur(8px);
            overflow: hidden;
        }

        .info-item {
            display: flex; align-items: center; gap: 12px;
            padding: 18px 16px;
            border-right: 1px solid var(--border);
        }
        .info-item:last-child { border-right: none; }

        .info-icon-wrap {
            width: 38px; height: 38px; border-radius: 9px;
            background: rgba(255,255,255,.1);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .info-icon-wrap i { font-size: 15px; color: rgba(255,255,255,.85); }
        .info-icon-wrap.gold i { color: var(--gold); }

        .info-label {
            font-family: 'Sora', sans-serif;
            font-size: 11.5px; font-weight: 700;
            color: rgba(255,255,255,.9);
            text-transform: uppercase; letter-spacing: .04em; line-height: 1.3;
        }
        .info-sub { font-size: 12px; font-weight: 500; color: var(--muted); margin-top: 2px; }

        /* ── FOOTER ── */
        footer {
            margin-top: auto;
            border-top: 1px solid var(--border);
            color: var(--muted);
            text-align: center;
            padding: 18px 24px;
            font-size: 12.5px; font-weight: 500;
            position: relative; z-index: 1;
        }
        footer span { color: rgba(255,255,255,.8); font-weight: 700; }

        /* ── ANIMATIONS ── */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-8px); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: .35; }
        }
        .hero-left { animation: fadeUp .75s ease both; }
        .foto-wrap { animation: fadeRight .85s ease .15s both; }
        @keyframes fadeUp    { from { opacity:0; transform:translateY(28px); } to { opacity:1; transform:translateY(0); } }
        @keyframes fadeRight { from { opacity:0; transform:translateX(28px); } to { opacity:1; transform:translateX(0); } }

        /* ── RESPONSIVE ── */
        @media (max-width: 960px) {
            .hero-section { grid-template-columns: 1fr; gap: 32px; padding: 40px 0 36px; }
            .hero-judul { font-size: 2.2rem; }
            .foto-card img { height: 260px; }
        }
        @media (max-width: 720px) {
            .tombol-grid { grid-template-columns: 1fr; }
            .info-bar { grid-template-columns: 1fr 1fr; }
            .info-item { border-right: 1px solid var(--border); border-bottom: 1px solid var(--border); }
            .info-item:nth-child(2n) { border-right: none; }
            .info-item:last-child { border-bottom: none; }
        }
        @media (max-width: 520px) {
            .wrap { padding: 0 18px; }
            .hero-judul { font-size: 1.9rem; }
            .info-bar { grid-template-columns: 1fr; }
            .info-item { border-right: none; border-bottom: 1px solid var(--border); }
        }
    </style>
</head>
<body>

{{-- orbs --}}
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

{{-- ── HEADER ── --}}
<div class="header">
    <div class="wrap">
        <div class="header-logo"><i class="fas fa-book-open"></i></div>
        <div class="header-divider"></div>
        <div>
            <div class="header-nama">Perpustakaan SDN Pasireurih</div>
            <div class="header-sub">Sistem Informasi Perpustakaan Sekolah</div>
        </div>
    </div>
</div>

{{-- ── HERO ── --}}
<div class="wrap">
    <div class="hero-section">

        <div class="hero-left">
            <div class="hero-badge">
                <span class="dot"></span>
                Sistem Informasi Perpustakaan
            </div>
            <div class="hero-judul">
                Selamat Datang di<br>
                <span class="aksen">Perpustakaan SDN<br>Pasireurih</span>
            </div>
            <div class="hero-rule"></div>
            <p class="hero-desc">
                Silakan lakukan peminjaman buku melalui sistem perpustakaan digital kami. Mudah, cepat, dan tercatat rapi.
            </p>
            <p class="hero-tagline">Ayo membaca, ayo berprestasi!</p>
        </div>

        <div class="foto-wrap">
            <div class="foto-card">
                <img src="{{ asset('images/foto-sekolah.jpg') }}" alt="SDN Pasireurih">
                <div class="foto-badge">
                    <div class="foto-badge-icon"><i class="fas fa-star"></i></div>
                    <div>
                        <span class="foto-badge-name">SDN Pasireurih</span>
                        <span class="foto-badge-sub">Kec. Tamansari, Kab. Bogor</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ── TOMBOL UTAMA ── --}}
<div class="tombol-section">
    <div class="wrap">
        <div class="tombol-grid">

            <a href="{{ route('pinjam.identifikasi') }}" class="tombol-kartu primer">
                <div class="tombol-ikon-wrap">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div>
                    <div class="tombol-judul">Pinjam Buku</div>
                    <div class="tombol-sub">Pinjam buku yang<br>Anda butuhkan</div>
                </div>
            </a>

            @auth
            <a href="{{ url('/cek-role') }}" class="tombol-kartu sekunder">
            @else
            <a href="{{ route('login') }}" class="tombol-kartu sekunder">
            @endauth
                <div class="tombol-ikon-wrap">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <div class="tombol-judul">Login Admin / Petugas</div>
                    <div class="tombol-sub">Masuk untuk Admin / Petugas<br>perpustakaan</div>
                </div>
            </a>

        </div>
    </div>
</div>

{{-- ── INFO BAR ── --}}
<div class="info-section">
    <div class="wrap">
        <div class="info-bar">

            <div class="info-item">
                <div class="info-icon-wrap"><i class="fas fa-school"></i></div>
                <div>
                    <div class="info-label">Informasi</div>
                    <div class="info-label">Perpustakaan</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon-wrap"><i class="far fa-clock"></i></div>
                <div>
                    <div class="info-label">Jam Layanan</div>
                    <div class="info-sub">07.00 – 14.00</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon-wrap"><i class="fas fa-book"></i></div>
                <div>
                    <div class="info-label">Maks. Pinjaman</div>
                    <div class="info-sub">2 buku</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon-wrap"><i class="far fa-calendar-check"></i></div>
                <div>
                    <div class="info-label">Lama Pinjaman</div>
                    <div class="info-sub">7 hari</div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icon-wrap gold"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <div class="info-label">Keterlambatan</div>
                    <div class="info-sub">Dikenakan sanksi sesuai aturan</div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ── FOOTER ── --}}
<footer>
    &copy; {{ date('Y') }} <span>SDN Pasireurih 05</span>.
</footer>

</body>
</html>
