<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifikasi Peminjam — Perpustakaan SDN Pasireurih</title>
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
            display: flex; flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        body::before {
            content: '';
            position: fixed; inset: 0; z-index: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 0; }
        .orb-1 { width: 500px; height: 500px; background: #3b7eff; opacity: .35; top: -100px; right: -100px; }
        .orb-2 { width: 350px; height: 350px; background: var(--gold); opacity: .15; bottom: -80px; left: 20%; }
        .orb-3 { width: 250px; height: 250px; background: #60a5fa;  opacity: .2;  top: 30%;  left: -60px; }

        .wrap { max-width: 1200px; margin: 0 auto; padding: 0 40px; width: 100%; position: relative; z-index: 1; }

        /* ── HEADER ── */
        .header { border-bottom: 1px solid var(--border); padding: 15px 0; position: relative; z-index: 10; }
        .header .wrap { display: flex; align-items: center; justify-content: space-between; }
        .header-left { display: flex; align-items: center; gap: 14px; }

        .header-logo {
            width: 46px; height: 46px;
            background: rgba(255,255,255,.1);
            border: 1.5px solid rgba(255,255,255,.18);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            text-decoration: none;
        }
        .header-logo i { font-size: 19px; color: var(--white); }
        .header-divider { width: 1.5px; height: 34px; background: rgba(255,255,255,.15); flex-shrink: 0; }
        .header-nama {
            font-family: 'Sora', sans-serif;
            font-size: 14.5px; font-weight: 800;
            color: var(--white); letter-spacing: .04em; text-transform: uppercase; line-height: 1.2;
        }
        .header-sub { font-size: 11.5px; font-weight: 500; color: var(--muted); margin-top: 2px; }

        .btn-home {
            display: inline-flex; align-items: center; gap: 7px;
            background: rgba(255,255,255,.1); border: 1.5px solid rgba(255,255,255,.2);
            border-radius: 9px; padding: 8px 16px;
            font-size: 13px; font-weight: 600; color: var(--white);
            text-decoration: none; transition: all .2s; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .btn-home:hover { background: rgba(255,255,255,.18); }

        /* ── PROGRESS ── */
        .progress-wrap { border-bottom: 1px solid var(--border); padding: 14px 0; position: relative; z-index: 5; }
        .progress-steps { display: flex; align-items: center; max-width: 520px; margin: 0 auto; }

        .step { display: flex; align-items: center; gap: 7px; }
        .step-circle {
            width: 30px; height: 30px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif; font-size: 11px; font-weight: 700; flex-shrink: 0;
        }
        .step.active .step-circle { background: var(--white); color: var(--navy); box-shadow: 0 0 0 3px rgba(255,255,255,.2); }
        .step.wait   .step-circle { background: rgba(255,255,255,.12); color: rgba(255,255,255,.4); border: 1.5px solid rgba(255,255,255,.15); }
        .step-label { font-size: 11.5px; font-weight: 700; }
        .step.active .step-label { color: var(--white); }
        .step.wait   .step-label { color: rgba(255,255,255,.35); }
        .step-line { flex: 1; height: 2px; background: rgba(255,255,255,.12); margin: 0 8px; max-width: 64px; }

        /* ── MAIN ── */
        .main { flex: 1; padding: 40px 0 56px; display: flex; flex-direction: column; align-items: center; gap: 20px; position: relative; z-index: 1; }

        /* ── FORM CARD ── */
        .form-card {
            width: 100%; max-width: 900px;
            background: var(--white);
            border-radius: 20px;
            display: grid; grid-template-columns: 260px 1fr;
            overflow: hidden;
            box-shadow: 0 24px 64px rgba(0,0,0,.4);
        }

        /* LEFT */
        .fc-left {
            background: linear-gradient(155deg, #0a1744 0%, #1a2e6f 55%, #1e3a8a 100%);
            border-right: none;
            padding: 36px 26px;
            display: flex; flex-direction: column;
            position: relative; overflow: hidden;
        }
        .fc-left::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 24px 24px; pointer-events: none;
        }
        .fc-left-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: rgba(255,255,255,.12);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px; position: relative; z-index: 1;
        }
        .fc-left-icon i { font-size: 22px; color: var(--gold-lt); }
        .fc-judul { font-family: 'Sora', sans-serif; font-size: 19px; font-weight: 800; color: var(--white); margin-bottom: 8px; position: relative; z-index: 1; }
        .fc-desc  { font-size: 12.5px; font-weight: 500; color: rgba(255,255,255,.6); line-height: 1.75; margin-bottom: 28px; position: relative; z-index: 1; }

        /* Info list di kiri bawah */
        .info-left { display: flex; flex-direction: column; gap: 10px; margin-top: auto; position: relative; z-index: 1; }
        .info-left-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 10px;
        }
        .il-ico { width: 30px; height: 30px; border-radius: 8px; background: rgba(255,255,255,.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .il-ico i { font-size: 13px; color: rgba(255,255,255,.8); }
        .il-ico.gold i { color: var(--gold-lt); }
        .il-lbl { font-size: 9.5px; font-weight: 700; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .06em; }
        .il-val { font-size: 12px; font-weight: 600; color: var(--white); margin-top: 1px; }

        /* RIGHT */
        .fc-right { padding: 36px 36px; display: flex; flex-direction: column; justify-content: center; background: var(--white); }
        .form-heading    { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: var(--navy); margin-bottom: 5px; }
        .form-subheading { font-size: 13px; font-weight: 500; color: #64748b; margin-bottom: 28px; }

        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 11.5px; font-weight: 700; color: var(--navy); margin-bottom: 8px; text-transform: uppercase; letter-spacing: .05em; }
        .form-label .req { color: #ef4444; margin-left: 2px; }

        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 14px; color: #94a3b8; pointer-events: none; }

        .form-input {
            width: 100%; height: 50px;
            background: #f8faff; border: 1.5px solid #e2e8f0;
            border-radius: 11px; padding: 0 16px 0 44px;
            font-size: 14.5px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500;
            color: #1e293b; outline: none;
            transition: border-color .18s, box-shadow .18s;
        }
        .form-input::placeholder { color: #cbd5e1; }
        .form-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59,126,255,.1); background: var(--white); }
        .form-input.is-error { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,.1); }

        .form-hint  { font-size: 11.5px; font-weight: 500; color: #94a3b8; margin-top: 6px; display: flex; align-items: center; gap: 5px; }
        .form-error { font-size: 12px; font-weight: 600; color: #ef4444; margin-top: 6px; display: flex; align-items: center; gap: 5px; }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--navy2) 0%, var(--accent) 100%);
            color: white; border: none; border-radius: 10px;
            padding: 14px; font-family: inherit;
            font-size: 15px; font-weight: 700;
            cursor: pointer; transition: all .25s;
            box-shadow: 0 4px 20px rgba(26,46,111,.3);
            display: flex; align-items: center; justify-content: center; gap: 9px;
            letter-spacing: .01em;
        }
        .btn-lanjut:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(15,31,92,.4); }

        .btn-kembali {
            width: 100%; height: 42px; margin-top: 10px;
            background: transparent; color: #94a3b8;
            border: 1.5px solid #e2e8f0; border-radius: 11px;
            font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600;
            cursor: pointer; transition: all .15s; text-decoration: none;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .btn-kembali:hover { background: #f8faff; border-color: #cbd5e1; color: #475569; }

        /* ── FOOTER ── */
        footer { border-top: 1px solid var(--border); color: var(--muted); text-align: center; padding: 16px; font-size: 12px; font-weight: 500; position: relative; z-index: 1; }
        footer span { color: rgba(255,255,255,.8); font-weight: 700; }

        @media(max-width:820px){ .form-card{grid-template-columns:1fr;} .fc-left{border-right:none;border-bottom:1px solid rgba(255,255,255,.1);} }
        @media(max-width:520px){ .wrap{padding:0 16px;} .fc-right{padding:24px 18px;} }
    </style>
</head>
<body>

<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>

{{-- HEADER --}}
<div class="header">
    <div class="wrap">
        <div class="header-left">
            <a href="{{ route('landing') }}" class="header-logo"><i class="fas fa-book-open"></i></a>
            <div class="header-divider"></div>
            <div>
                <div class="header-nama">Perpustakaan SDN Pasireurih</div>
                <div class="header-sub">Sistem Informasi Perpustakaan Sekolah</div>
            </div>
        </div>
        <a href="{{ route('landing') }}" class="btn-home"><i class="fas fa-home"></i> Beranda</a>
    </div>
</div>

{{-- PROGRESS --}}
<div class="progress-wrap">
    <div class="wrap">
        <div class="progress-steps">
            <div class="step active">
                <div class="step-circle">1</div>
                <div class="step-label">Identifikasi</div>
            </div>
            <div class="step-line"></div>
            <div class="step wait">
                <div class="step-circle">2</div>
                <div class="step-label">Pilih Buku</div>
            </div>
            <div class="step-line"></div>
            <div class="step wait">
                <div class="step-circle">3</div>
                <div class="step-label">Konfirmasi</div>
            </div>
            <div class="step-line"></div>
            <div class="step wait">
                <div class="step-circle">4</div>
                <div class="step-label">Selesai</div>
            </div>
        </div>
    </div>
</div>

{{-- MAIN --}}
<main class="main">
    <div class="wrap" style="display:flex;flex-direction:column;align-items:center;gap:20px;">

        <div class="form-card">

            {{-- LEFT --}}
            <div class="fc-left">
                <div class="fc-left-icon"><i class="fas fa-id-card"></i></div>
                <div class="fc-judul">Siapa kamu?</div>
                <div class="fc-desc">Masukkan nama dan nomor identitasmu untuk mulai proses peminjaman buku.</div>

                <div class="info-left">
                    <div class="info-left-item">
                        <div class="il-ico"><i class="fas fa-book"></i></div>
                        <div>
                            <div class="il-lbl">Maks. Pinjaman</div>
                            <div class="il-val">2 buku</div>
                        </div>
                    </div>
                    <div class="info-left-item">
                        <div class="il-ico"><i class="far fa-calendar-check"></i></div>
                        <div>
                            <div class="il-lbl">Lama Pinjaman</div>
                            <div class="il-val">7 hari</div>
                        </div>
                    </div>
                    <div class="info-left-item">
                        <div class="il-ico"><i class="far fa-clock"></i></div>
                        <div>
                            <div class="il-lbl">Jam Layanan</div>
                            <div class="il-val">07.00 – 14.00</div>
                        </div>
                    </div>
                    <div class="info-left-item">
                        <div class="il-ico gold"><i class="fas fa-exclamation-triangle"></i></div>
                        <div>
                            <div class="il-lbl">Keterlambatan</div>
                            <div class="il-val">Dikenakan sanksi</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="fc-right">
                <div class="form-heading">Isi Data Diri</div>
                <div class="form-subheading">Semua data harus sesuai kartu identitasmu</div>

                <form method="POST" action="{{ route('pinjam.identifikasi.store') }}" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="nama_lengkap" name="nama_lengkap"
                                class="form-input {{ $errors->has('nama_lengkap') ? 'is-error' : '' }}"
                                placeholder="Contoh: Budi Santoso"
                                value="{{ old('nama_lengkap') }}" autocomplete="name" autofocus>
                        </div>
                        @if($errors->has('nama_lengkap'))
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('nama_lengkap') }}</div>
                        @else
                            <div class="form-hint"><i class="fas fa-info-circle"></i> Tulis nama lengkap sesuai kartu pelajar</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="nis_nip" class="form-label">NIS / NIP <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-id-badge input-icon"></i>
                            <input type="text" id="nis_nip" name="nis_nip"
                                class="form-input {{ $errors->has('nis_nip') ? 'is-error' : '' }}"
                                placeholder="Contoh: 20240012"
                                value="{{ old('nis_nip') }}" inputmode="numeric" autocomplete="off">
                        </div>
                        @if($errors->has('nis_nip'))
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('nis_nip') }}</div>
                        @else
                            <div class="form-hint"><i class="fas fa-info-circle"></i> Siswa: NIS · Guru / Staf: NIP kepegawaian</div>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">
                        Lanjut ke Pilih Buku <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <a href="{{ route('landing') }}" class="btn-kembali">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>

        </div>

    </div>
</main>

<footer>
    &copy; {{ date('Y') }} <span>SDN Pasireurih 05</span>.
</footer>

</body>
</html>
