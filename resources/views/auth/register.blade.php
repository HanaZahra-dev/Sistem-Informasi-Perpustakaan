<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register — Perpustakaan SDN Pasireurih</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:  #0f1f5c;
            --navy2: #1a2e6f;
            --accent:#3b7eff;
            --gold:  #f59e0b;
            --white: #ffffff;
            --g400:  #94a3b8;
            --g600:  #475569;
            --g800:  #1e293b;
        }

        html, body { height: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background: linear-gradient(155deg, #080f2e 0%, #0f1f5c 40%, #1a2e6f 75%, #1e3a8a 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 48px;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(70px); pointer-events: none;
        }

        .orb-a {
            width: 320px; height: 320px;
            background: var(--gold); opacity: .15;
            top: -60px; right: -60px;
        }

        .orb-b {
            width: 280px; height: 280px;
            background: #3b7eff; opacity: .2;
            bottom: 80px; left: -40px;
        }

        .lp-brand {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none; position: relative; z-index: 2;
        }

        .lp-brand-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: white;
            backdrop-filter: blur(8px);
        }

        .lp-brand-name {
            font-family: 'Sora', sans-serif;
            font-size: 16px; font-weight: 800; color: white;
        }

        .lp-brand-sub {
            font-size: 11px; color: rgba(255,255,255,.5);
            letter-spacing: .06em; text-transform: uppercase;
        }

        .lp-center { position: relative; z-index: 2; }

        .lp-badge {
            display: inline-flex; align-items: center; gap: 7px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            color: rgba(255,255,255,.8);
            font-size: 11.5px; font-weight: 600;
            padding: 6px 14px; border-radius: 99px;
            margin-bottom: 24px; backdrop-filter: blur(8px);
        }

        .lp-badge .dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 8px var(--gold);
            animation: pulse 2s infinite;
        }

        .lp-title {
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800; color: white;
            line-height: 1.15; letter-spacing: -.02em;
            margin-bottom: 16px;
        }

        .lp-title .gold { color: var(--gold); }

        .lp-desc {
            font-size: 14.5px; color: rgba(255,255,255,.6);
            line-height: 1.75; max-width: 360px; margin-bottom: 36px;
        }

        /* Steps */
        .lp-steps { display: flex; flex-direction: column; gap: 16px; }

        .lp-step {
            display: flex; align-items: flex-start; gap: 14px;
        }

        .step-num {
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.2);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 12px; font-weight: 800; color: var(--gold);
            flex-shrink: 0; margin-top: 1px;
        }

        .step-text {}
        .step-title { font-size: 13.5px; font-weight: 700; color: white; margin-bottom: 2px; }
        .step-desc  { font-size: 12.5px; color: rgba(255,255,255,.5); }

        .lp-bottom { position: relative; z-index: 2; }

        .lp-note {
            display: flex; align-items: center; gap: 10px;
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 12px; padding: 14px 16px;
        }

        .lp-note i { color: var(--gold); font-size: 18px; flex-shrink: 0; }
        .lp-note-text { font-size: 12.5px; color: rgba(255,255,255,.6); line-height: 1.5; }
        .lp-note-text strong { color: rgba(255,255,255,.9); }

        /* ── RIGHT PANEL ── */
        .right-panel {
            background: #f8faff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 52px;
            position: relative;
        }

        .back-link {
            position: absolute; top: 28px; right: 32px;
            display: flex; align-items: center; gap: 7px;
            color: var(--g600); font-size: 13px; font-weight: 600;
            text-decoration: none;
            background: white; border: 1.5px solid #e2e8f0;
            border-radius: 8px; padding: 8px 14px;
            transition: all .2s;
            box-shadow: 0 1px 4px rgba(0,0,0,.05);
        }

        .back-link:hover { border-color: var(--accent); color: var(--accent); }

        .rp-inner {
            width: 100%; max-width: 400px;
            animation: fadeUp .7s ease both;
        }

        .rp-heading { margin-bottom: 26px; }

        .rp-heading h2 {
            font-family: 'Sora', sans-serif;
            font-size: 1.7rem; font-weight: 800;
            color: var(--g800); margin-bottom: 6px;
        }

        .rp-heading p { font-size: 13.5px; color: var(--g600); }

        .alert-err {
            background: #fef2f2; border: 1px solid #fecaca;
            border-radius: 10px; padding: 11px 14px;
            margin-bottom: 18px; color: #dc2626;
            font-size: 13px; display: flex; align-items: center; gap: 8px;
        }

        .field { margin-bottom: 14px; }

        .field label {
            display: block; font-size: 12.5px; font-weight: 700;
            color: var(--g800); margin-bottom: 7px;
            letter-spacing: .02em; text-transform: uppercase;
        }

        .field-wrap { position: relative; }

        .field-wrap i {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--g400); font-size: 14px; pointer-events: none;
        }

        .field-wrap input {
            width: 100%;
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 14px 12px 40px;
            font-family: inherit; font-size: 14px;
            color: var(--g800); outline: none;
            transition: all .2s;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
        }

        .field-wrap input::placeholder { color: #cbd5e1; }

        .field-wrap input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59,126,255,.1);
        }

        .field-wrap input.invalid { border-color: #f87171; }
        .err-msg { font-size: 12px; color: #dc2626; margin-top: 5px; }

        /* Password grid */
        .pw-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
        }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--navy2) 0%, var(--accent) 100%);
            color: white; border: none; border-radius: 10px;
            padding: 14px; font-family: inherit;
            font-size: 15px; font-weight: 700;
            cursor: pointer; transition: all .25s;
            box-shadow: 0 4px 20px rgba(26,46,111,.3);
            display: flex; align-items: center; justify-content: center; gap: 9px;
            margin-top: 20px; margin-bottom: 18px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(59,126,255,.35);
        }

        .or-div {
            display: flex; align-items: center; gap: 12px; margin-bottom: 16px;
        }

        .or-div::before, .or-div::after {
            content: ''; flex: 1; height: 1px; background: #e2e8f0;
        }

        .or-div span { font-size: 12px; color: var(--g400); font-weight: 500; }

        .login-row {
            text-align: center; font-size: 13.5px; color: var(--g600);
        }

        .login-row a {
            color: var(--accent); font-weight: 700; text-decoration: none;
        }

        .login-row a:hover { color: var(--navy2); text-decoration: underline; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; } 50% { opacity: .4; }
        }

        @media (max-width: 820px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
            .right-panel { padding: 40px 28px; }
            .pw-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

{{-- ── LEFT PANEL ── --}}
<div class="left-panel">
    <div class="orb orb-a"></div>
    <div class="orb orb-b"></div>

    <a href="{{ route('landing') }}" class="lp-brand">
        <div class="lp-brand-icon"><i class="fas fa-book-open"></i></div>
        <div>
            <div class="lp-brand-name">Perpustakaan </div>
            <div class="lp-brand-sub">SDN Pasireurih</div>
        </div>
    </a>

    <div class="lp-center">
        <div class="lp-badge">
            <span class="dot"></span>
            Daftar Sekarang — Gratis!
        </div>
        <h1 class="lp-title">
            Bergabunglah dengan<br>
            komunitas<br>
            <span class="gold">Perpustakaan SDN Pasireurih</span>
        </h1>
        <p class="lp-desc">
            Daftarkan diri Anda dan nikmati kemudahan akses koleksi buku serta layanan peminjaman digital kami.
        </p>
        <div class="lp-steps">
            <div class="lp-step">
                <div class="step-num">1</div>
                <div class="step-text">
                    <div class="step-title">Buat Akun</div>
                    <div class="step-desc">Isi formulir pendaftaran dengan data yang valid</div>
                </div>
            </div>
            <div class="lp-step">
                <div class="step-num">2</div>
                <div class="step-text">
                    <div class="step-title">Jelajahi Koleksi</div>
                    <div class="step-desc">Temukan ribuan buku dari berbagai kategori</div>
                </div>
            </div>
            <div class="lp-step">
                <div class="step-num">3</div>
                <div class="step-text">
                    <div class="step-title">Pinjam & Nikmati</div>
                    <div class="step-desc">Ajukan peminjaman dan ambil buku di perpustakaan</div>
                </div>
            </div>
        </div>
    </div>

    <div class="lp-bottom">
        <div class="lp-note">
            <i class="fas fa-shield-alt"></i>
            <div class="lp-note-text">
                <strong>Data Anda aman.</strong> Informasi pendaftaran hanya digunakan untuk keperluan layanan perpustakaan.
            </div>
        </div>
    </div>
</div>

{{-- ── RIGHT PANEL ── --}}
<div class="right-panel">
    <a href="{{ route('landing') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Beranda
    </a>

    <div class="rp-inner">
        <div class="rp-heading">
            <h2>Mulai Meminjam</h2>
            <p>Lengkapi data di bawah untuk mendaftar sebagai anggota</p>
        </div>

        @if ($errors->any())
            <div class="alert-err">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="field">
                <label>Nama Lengkap</label>
                <div class="field-wrap">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="Nama lengkap Anda" required autocomplete="name" autofocus
                        class="{{ $errors->has('name') ? 'invalid' : '' }}">
                </div>
                @error('name') <div class="err-msg">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>NIS/NIP</label>
                <div class="field-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="nama@email.com" required autocomplete="email"
                        class="{{ $errors->has('email') ? 'invalid' : '' }}">
                </div>
                @error('email') <div class="err-msg">{{ $message }}</div> @enderror
            </div>

           

               
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </button>

            <div class="or-div"><span>atau</span></div>

            <div class="login-row">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
