<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Peminjaman — Perpustakaan SDN Pasireurih</title>
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
        .step.active .step-circle { background: var(--white); color: var(--navy); box-shadow: 0 0 0 3px rgba(255,255,255,.2); }
        .step.wait   .step-circle { background: rgba(255,255,255,.12); color: rgba(255,255,255,.35); border: 1.5px solid rgba(255,255,255,.15); }
        .step-label { font-size: 11.5px; font-weight: 700; }
        .step.done   .step-label { color: rgba(255,255,255,.55); }
        .step.active .step-label { color: var(--white); }
        .step.wait   .step-label { color: rgba(255,255,255,.35); }
        .step-line { flex: 1; height: 2px; margin: 0 8px; max-width: 64px; }
        .step-line.done { background: var(--gold); }
        .step-line.wait { background: rgba(255,255,255,.12); }

        /* ── MAIN ── */
        .main { flex: 1; padding: 40px 0 64px; position: relative; z-index: 1; }
        .main .wrap { display: flex; justify-content: center; }
        .card-wrap { width: 100%; max-width: 560px; display: flex; flex-direction: column; gap: 18px; }

        /* ── FLASH ── */
        .flash { padding: 12px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; backdrop-filter: blur(8px); }
        .flash-ok   { background: rgba(74,222,128,.15);  border: 1px solid rgba(74,222,128,.3);  color: #86efac; }
        .flash-err  { background: rgba(248,113,113,.15); border: 1px solid rgba(248,113,113,.3); color: #fca5a5; }
        .flash-info { background: rgba(96,165,250,.15);  border: 1px solid rgba(96,165,250,.3);  color: #93c5fd; }

        /* ── CARD ── */
        .card {
            background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.14);
            border-radius: 16px; overflow: hidden;
            backdrop-filter: blur(16px);
            box-shadow: 0 16px 48px rgba(0,0,0,.25);
        }
        .card-header {
            background: rgba(0,0,0,.22); border-bottom: 1px solid rgba(255,255,255,.1);
            padding: 14px 20px; display: flex; align-items: center; gap: 10px;
        }
        .card-header-icon { font-size: 15px; color: var(--gold-lt); }
        .card-header-title { font-family: 'Sora', sans-serif; font-size: 13.5px; font-weight: 800; color: var(--white); }
        .card-body { padding: 20px; }

        /* ── INFO GRID ── */
        .info-grid { display: grid; grid-template-columns: 130px 1fr; gap: 0; }
        .info-row { display: contents; }
        .info-row + .info-row .info-label,
        .info-row + .info-row .info-value { border-top: 1px solid rgba(255,255,255,.06); }
        .info-label {
            font-size: 11px; font-weight: 700; color: rgba(255,255,255,.4);
            text-transform: uppercase; letter-spacing: .06em;
            padding: 9px 0; display: flex; align-items: center;
        }
        .info-value {
            font-size: 13.5px; font-weight: 600; color: var(--white);
            padding: 9px 0 9px 8px;
        }
        .badge-jenis {
            display: inline-block; background: rgba(59,126,255,.2);
            border: 1px solid rgba(59,126,255,.35); color: #93c5fd;
            font-size: 11px; font-weight: 700; padding: 3px 10px;
            border-radius: 99px; letter-spacing: .04em;
        }

        /* ── BUKU LIST ── */
        .buku-list { display: flex; flex-direction: column; gap: 10px; }
        .buku-item {
            display: flex; align-items: center; gap: 14px;
            background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1);
            border-radius: 12px; padding: 12px 14px;
            transition: background .15s;
        }
        .buku-item:hover { background: rgba(255,255,255,.09); }
        .buku-num {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--gold); color: var(--navy-deep);
            font-family: 'Sora', sans-serif; font-size: 12px; font-weight: 800;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .buku-sampul {
            width: 44px; height: 58px; object-fit: cover;
            border-radius: 6px; border: 1px solid rgba(255,255,255,.15);
            flex-shrink: 0;
        }
        .buku-sampul-ph {
            width: 44px; height: 58px; border-radius: 6px;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .buku-info { flex: 1; min-width: 0; }
        .buku-judul {
            font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700;
            color: var(--white); line-height: 1.4;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .buku-penulis { font-size: 11.5px; font-weight: 500; color: var(--muted); margin-top: 3px; }
        .buku-stok-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: rgba(74,222,128,.12); border: 1px solid rgba(74,222,128,.25);
            color: #86efac; font-size: 10.5px; font-weight: 700;
            padding: 2px 9px; border-radius: 99px; margin-top: 6px;
        }
        .buku-stok-badge.habis { background: rgba(248,113,113,.12); border-color: rgba(248,113,113,.25); color: #fca5a5; }

        /* ── ACTIONS ── */
        .actions { display: flex; gap: 12px; }
        .btn-kembali {
            height: 48px; padding: 0 20px;
            background: rgba(255,255,255,.08); border: 1.5px solid rgba(255,255,255,.15);
            border-radius: 12px; color: var(--muted);
            font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; font-weight: 600;
            cursor: pointer; display: flex; align-items: center; gap: 7px;
            text-decoration: none; transition: all .15s; flex-shrink: 0;
        }
        .btn-kembali:hover { background: rgba(255,255,255,.14); border-color: rgba(255,255,255,.28); color: var(--white); }
        .btn-ajukan {
            flex: 1; height: 48px;
            background: var(--white); color: var(--navy);
            border: none; border-radius: 12px;
            font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 800;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
            text-decoration: none; transition: all .18s;
            box-shadow: 0 6px 20px rgba(0,0,0,.25);
        }
        .btn-ajukan:hover { background: var(--gold); color: var(--navy-deep); transform: translateY(-2px); }
        .btn-ajukan:active { transform: scale(.97); }

        /* ── FOOTER ── */
        footer { border-top: 1px solid var(--border); color: var(--muted); text-align: center; padding: 16px; font-size: 12px; font-weight: 500; position: relative; z-index: 1; }
        footer span { color: rgba(255,255,255,.8); font-weight: 700; }

        @media (max-width: 900px) { .wrap { padding: 0 16px; } }
        @media (max-width: 480px) {
            .actions { flex-direction: column-reverse; }
            .btn-kembali { width: 100%; justify-content: center; }
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
            <div class="header-sub">Konfirmasi peminjaman buku</div>
        </div>
    </div>
</div>

{{-- PROGRESS --}}
<div class="progress-wrap">
    <div class="wrap">
        <div class="progress-steps">
            <div class="step done">
                <div class="step-circle"><i class="fas fa-check" style="font-size:9px;"></i></div>
                <div class="step-label">Identifikasi</div>
            </div>
            <div class="step-line done"></div>
            <div class="step done">
                <div class="step-circle"><i class="fas fa-check" style="font-size:9px;"></i></div>
                <div class="step-label">Pilih Buku</div>
            </div>
            <div class="step-line done"></div>
            <div class="step active">
                <div class="step-circle">3</div>
                <div class="step-label">Konfirmasi</div>
            </div>
            <div class="step-line wait"></div>
            <div class="step wait">
                <div class="step-circle">4</div>
                <div class="step-label">Selesai</div>
            </div>
        </div>
    </div>
</div>

{{-- MAIN --}}
<div class="main">
    <div class="wrap">
        <div class="card-wrap">

            @if(session('error'))
                <div class="flash flash-err"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif

            <div class="flash flash-info">
                <i class="fas fa-circle-info"></i>
                Pastikan data di bawah sudah benar sebelum mengajukan peminjaman.
            </div>

            {{-- CARD DATA PEMINJAM --}}
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user card-header-icon"></i>
                    <span class="card-header-title">Data Peminjam</span>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-row">
                            <span class="info-label">Nama</span>
                            <span class="info-value">{{ $identifikasi['nama_lengkap'] }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">NIS / NIP</span>
                            <span class="info-value">{{ $identifikasi['nis_nip'] }}</span>
                        </div>
                        @if(!empty($identifikasi['kode_anggota']))
                        <div class="info-row">
                            <span class="info-label">Kode</span>
                            <span class="info-value">{{ $identifikasi['kode_anggota'] }}</span>
                        </div>
                        @endif
                        @if(!empty($identifikasi['jenis_anggota']))
                        <div class="info-row">
                            <span class="info-label">Jenis</span>
                            <span class="info-value">
                                <span class="badge-jenis">
                                    {{ $identifikasi['jenis_anggota'] === 'guru' ? 'Guru' : 'Siswa' }}
                                    @if($identifikasi['jenis_anggota'] === 'siswa' && !empty($identifikasi['kelas']))
                                        — Kelas {{ $identifikasi['kelas'] }}
                                    @endif
                                </span>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- CARD BUKU --}}
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-books card-header-icon"></i>
                    <span class="card-header-title">Buku yang Dipinjam ({{ count($keranjang) }})</span>
                </div>
                <div class="card-body">
                    <div class="buku-list">
                        @foreach($keranjang as $i => $item)
                            @php $buku = $listBuku[$item['id']] ?? null; @endphp
                            @if($buku)
                            <div class="buku-item">
                                <div class="buku-num">{{ $i + 1 }}</div>
                                @if($buku->sampul)
                                    <img class="buku-sampul" src="{{ asset('storage/' . $buku->sampul) }}" alt="Sampul {{ $buku->judul }}">
                                @else
                                    <div class="buku-sampul-ph"><i class="fas fa-book" style="color:rgba(255,255,255,.2);font-size:18px;"></i></div>
                                @endif
                                <div class="buku-info">
                                    <div class="buku-judul">{{ $buku->judul }}</div>
                                    <div class="buku-penulis">{{ $buku->penulis }}</div>
                                    <span class="buku-stok-badge {{ $buku->stok < 1 ? 'habis' : '' }}">
                                        <i class="fas {{ $buku->stok >= 1 ? 'fa-circle-check' : 'fa-circle-xmark' }}" style="font-size:9px;"></i>
                                        {{ $buku->stok >= 1 ? 'Stok tersedia' : 'Stok habis' }}
                                    </span>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="actions">
                <a href="{{ route('pinjam.pilih-buku') }}" class="btn-kembali">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <form action="{{ route('pinjam.ajukan') }}" method="POST" style="flex:1;display:flex;">
                    @csrf
                    <button type="submit" class="btn-ajukan" style="width:100%;">
                        <i class="fas fa-paper-plane"></i> Ajukan Peminjaman
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} <span>SDN Pasireurih 05</span>.
</footer>

</body>
</html>
