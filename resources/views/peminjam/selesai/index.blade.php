<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Diajukan — Perpustakaan SDN Pasireurih</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:      #0f1f5c;
            --navy2:     #1a2e6f;
            --navy-deep: #0a1744;
            --accent:    #3b7eff;
            --gold:      #f59e0b;
            --gold-lt:   #fbbf24;
            --white:     #ffffff;
            --muted:     rgba(255,255,255,.6);
            --border:    rgba(255,255,255,.13);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(155deg, #0a1744 0%, #1a2e6f 45%, #1e3a8a 75%, #1e40af 100%);
            color: var(--white);
            min-height: 100vh;
            display: flex; flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 32px 32px; pointer-events: none;
        }

        .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; background: #3b7eff; opacity: .35; top: -100px; right: -100px; }
        .orb-2 { width: 350px; height: 350px; background: var(--gold); opacity: .15; bottom: -80px; left: 20%; }
        .orb-3 { width: 250px; height: 250px; background: #60a5fa; opacity: .2; top: 30%; left: -60px; }

        .wrap { max-width: 1280px; margin: 0 auto; padding: 0 40px; width: 100%; position: relative; z-index: 1; }

        /* ── HEADER ── */
        .header { border-bottom: 1px solid var(--border); padding: 15px 0; position: relative; z-index: 10; }
        .header .wrap { display: flex; align-items: center; gap: 14px; }
        .header-logo {
            width: 46px; height: 46px; background: rgba(255,255,255,.1);
            border: 1.5px solid rgba(255,255,255,.18); border-radius: 11px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; text-decoration: none;
        }
        .header-logo i { font-size: 19px; color: var(--white); }
        .header-divider { width: 1.5px; height: 34px; background: rgba(255,255,255,.15); flex-shrink: 0; }
        .header-nama { font-family: 'Sora', sans-serif; font-size: 14.5px; font-weight: 800; color: var(--white); letter-spacing: .04em; text-transform: uppercase; line-height: 1.2; }
        .header-sub  { font-size: 11.5px; font-weight: 500; color: var(--muted); margin-top: 2px; }

        /* ── PROGRESS ── */
        .progress-wrap { border-bottom: 1px solid var(--border); padding: 14px 0; position: relative; z-index: 5; }
        .progress-steps { display: flex; align-items: center; max-width: 520px; margin: 0 auto; }
        .step { display: flex; align-items: center; gap: 7px; }
        .step-circle { width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Sora', sans-serif; font-size: 11px; font-weight: 700; flex-shrink: 0; }
        .step.done   .step-circle { background: var(--gold); color: var(--navy-deep); }
        .step-label { font-size: 11.5px; font-weight: 700; color: rgba(255,255,255,.55); }
        .step-line { flex: 1; height: 2px; margin: 0 8px; max-width: 64px; background: var(--gold); }

        /* ── MAIN ── */
        .main { flex: 1; display: flex; align-items: center; justify-content: center; padding: 48px 20px; position: relative; z-index: 1; }

        /* ── CARD ── */
        .card {
            background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.14);
            border-radius: 20px; overflow: hidden;
            backdrop-filter: blur(20px);
            box-shadow: 0 24px 64px rgba(0,0,0,.35);
            width: 100%; max-width: 500px;
        }

        /* ── SUCCESS TOP ── */
        .success-top {
            background: rgba(0,0,0,.25); border-bottom: 1px solid rgba(255,255,255,.1);
            padding: 40px 32px 36px; text-align: center;
        }
        .checkmark-ring {
            width: 86px; height: 86px; border-radius: 50%;
            background: rgba(74,222,128,.15);
            border: 2px solid rgba(74,222,128,.4);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 22px;
            box-shadow: 0 0 0 12px rgba(74,222,128,.07);
            animation: pop .5s cubic-bezier(.34,1.56,.64,1) both;
        }
        .checkmark-ring i { font-size: 36px; color: #4ade80; }
        @keyframes pop { from { transform: scale(.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .success-judul {
            font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 800;
            color: var(--white); margin-bottom: 8px;
        }
        .success-sub {
            font-size: 14px; font-weight: 500; color: var(--muted); line-height: 1.75;
        }
        .success-sub strong { color: var(--white); }

        /* ── CARD BODY ── */
        .card-body { padding: 24px 24px 28px; display: flex; flex-direction: column; gap: 18px; }

        /* ── BUKU LIST ── */
        .buku-list { display: flex; flex-direction: column; gap: 10px; }
        .buku-item {
            display: flex; align-items: center; gap: 13px;
            background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
            border-radius: 12px; padding: 12px 14px;
        }
        .buku-num {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--gold); color: var(--navy-deep);
            font-family: 'Sora', sans-serif; font-size: 12px; font-weight: 800;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .buku-judul {
            font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700;
            color: var(--white); line-height: 1.4; flex: 1;
        }

        /* ── INSTRUKSI BOX ── */
        .instruksi-box {
            background: rgba(96,165,250,.1); border: 1px solid rgba(96,165,250,.25);
            border-radius: 12px; padding: 16px 18px;
            display: flex; align-items: flex-start; gap: 13px;
        }
        .instruksi-box i { font-size: 18px; color: #93c5fd; flex-shrink: 0; margin-top: 1px; }
        .instruksi-judul { font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 800; color: var(--white); margin-bottom: 5px; }
        .instruksi-teks { font-size: 12.5px; font-weight: 500; color: rgba(255,255,255,.65); line-height: 1.7; }

        /* ── DIVIDER ── */
        .divider { height: 1px; background: rgba(255,255,255,.08); }

        /* ── CTA ── */
        .cta { display: flex; gap: 10px; }
        .btn-beranda {
            height: 48px; padding: 0 20px;
            background: rgba(255,255,255,.08); border: 1.5px solid rgba(255,255,255,.15);
            border-radius: 12px; color: var(--muted);
            font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 600;
            cursor: pointer; display: flex; align-items: center; gap: 7px;
            text-decoration: none; transition: all .15s; flex-shrink: 0;
        }
        .btn-beranda:hover { background: rgba(255,255,255,.14); border-color: rgba(255,255,255,.28); color: var(--white); }
        .btn-pinjam-lagi {
            flex: 1; height: 48px;
            background: var(--white); color: var(--navy);
            border: none; border-radius: 12px;
            font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 800;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
            text-decoration: none; transition: all .18s;
            box-shadow: 0 6px 20px rgba(0,0,0,.25);
        }
        .btn-pinjam-lagi:hover { background: var(--gold); color: var(--navy-deep); transform: translateY(-2px); }

        /* ── FOOTER ── */
        footer { border-top: 1px solid var(--border); color: var(--muted); text-align: center; padding: 16px; font-size: 12px; font-weight: 500; position: relative; z-index: 1; }
        footer span { color: rgba(255,255,255,.8); font-weight: 700; }

        @media (max-width: 900px) { .wrap { padding: 0 16px; } }
        @media (max-width: 480px) {
            .success-top { padding: 30px 20px 26px; }
            .card-body { padding: 20px 18px 24px; }
            .cta { flex-direction: column; }
            .btn-beranda { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

{{-- HEADER --}}
<div class="header">
    <div class="wrap">
        <a href="{{ route('landing') }}" class="header-logo"><i class="fas fa-book-open"></i></a>
        <div class="header-divider"></div>
        <div>
            <div class="header-nama">Perpustakaan SDN Pasireurih</div>
            <div class="header-sub">Peminjaman berhasil diajukan</div>
        </div>
    </div>
</div>

{{-- PROGRESS — semua done --}}
<div class="progress-wrap">
    <div class="wrap">
        <div class="progress-steps">
            <div class="step done">
                <div class="step-circle"><i class="fas fa-check" style="font-size:9px;"></i></div>
                <div class="step-label">Identifikasi</div>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-circle"><i class="fas fa-check" style="font-size:9px;"></i></div>
                <div class="step-label">Pilih Buku</div>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-circle"><i class="fas fa-check" style="font-size:9px;"></i></div>
                <div class="step-label">Konfirmasi</div>
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-circle"><i class="fas fa-check" style="font-size:9px;"></i></div>
                <div class="step-label">Selesai</div>
            </div>
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="main">
    <div class="card">

        <div class="success-top">
            <div class="checkmark-ring">
                <i class="fas fa-check"></i>
            </div>
            <div class="success-judul">Permohonan Masuk!</div>
            <div class="success-sub">
                Halo, <strong>{{ $data['nama'] }}</strong>.<br>
                Data peminjaman kamu sudah tercatat di sistem.
            </div>
        </div>

        <div class="card-body">

            <div class="buku-list">
                @foreach($data['judul_buku'] as $i => $judul)
                <div class="buku-item">
                    <div class="buku-num">{{ $i + 1 }}</div>
                    <div class="buku-judul">{{ $judul }}</div>
                </div>
                @endforeach
            </div>

            <div class="instruksi-box">
                <i class="fas fa-circle-info"></i>
                <div>
                    <div class="instruksi-judul">Selanjutnya, beritahu petugas</div>
                    <div class="instruksi-teks">
                        Permohonan kamu sudah masuk ke sistem.<br>
                        Petugas akan memproses dan menyiapkan buku untukmu.
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="cta">
                <a href="{{ route('landing') }}" class="btn-beranda">
                    <i class="fas fa-house"></i> Beranda
                </a>
                <a href="{{ route('pinjam.identifikasi') }}" class="btn-pinjam-lagi">
                    <i class="fas fa-rotate-right"></i> Pinjam Lagi
                </a>
            </div>

        </div>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} <span>SDN Pasireurih 05</span>.
</footer>

</body>
</html>
