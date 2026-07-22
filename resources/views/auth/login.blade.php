<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Pengelola — Perpustakaan SDN Pasireurih</title>
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
            width: 380px; height: 380px;
            background: #3b7eff; opacity: .2;
            top: -100px; right: -80px;
        }

        .orb-b {
            width: 250px; height: 250px;
            background: var(--gold); opacity: .12;
            bottom: 60px; left: -40px;
        }

        /* Brand */
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
            font-size: 16px; font-weight: 800;
            color: white; letter-spacing: -.01em;
        }

        .lp-brand-sub {
            font-size: 11px; color: rgba(255,255,255,.5);
            letter-spacing: .06em; text-transform: uppercase;
        }

        /* Center content */
        .lp-center {
            position: relative; z-index: 2;
        }

        .lp-badge {
            display: inline-flex; align-items: center; gap: 7px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            color: rgba(255,255,255,.8);
            font-size: 11.5px; font-weight: 600;
            padding: 6px 14px; border-radius: 99px;
            margin-bottom: 24px;
            backdrop-filter: blur(8px);
        }

        .lp-badge .dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 8px #4ade80;
            animation: pulse 2s infinite;
        }

        .lp-title {
            font-family: 'Sora', sans-serif;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            font-weight: 800; color: white;
            line-height: 1.15; letter-spacing: -.02em;
            margin-bottom: 16px;
        }

        .lp-title .gold { color: var(--gold); }

        .lp-desc {
            font-size: 14.5px; color: rgba(255,255,255,.6);
            line-height: 1.75; max-width: 360px;
            margin-bottom: 36px;
        }

        /* Feature list */
        .lp-features { display: flex; flex-direction: column; gap: 12px; }

        .lp-feat {
            display: flex; align-items: center; gap: 12px;
            color: rgba(255,255,255,.75); font-size: 13.5px; font-weight: 500;
        }

        .lp-feat-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; color: var(--gold); flex-shrink: 0;
        }

        /* Bottom stats */
        .lp-stats {
            display: flex; gap: 28px;
            position: relative; z-index: 2;
        }

        .lp-stat-num {
            font-family: 'Sora', sans-serif;
            font-size: 1.5rem; font-weight: 800; color: white;
        }
        .lp-stat-label { font-size: 11.5px; color: rgba(255,255,255,.45); margin-top: 2px; }
        .lp-stat-div { width: 1px; background: rgba(255,255,255,.12); }

        /* ── RIGHT PANEL ── */
        .right-panel {
            background: #f8faff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 52px;
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

        .rp-heading { margin-bottom: 28px; }

        .rp-heading h2 {
            font-family: 'Sora', sans-serif;
            font-size: 1.7rem; font-weight: 800;
            color: var(--g800); margin-bottom: 6px;
        }

        .rp-heading p { font-size: 13.5px; color: var(--g600); }

        /* Alert */
        .alert-err {
            background: #fef2f2; border: 1px solid #fecaca;
            border-radius: 10px; padding: 11px 14px;
            margin-bottom: 18px; color: #dc2626;
            font-size: 13px; display: flex; align-items: center; gap: 8px;
        }

        /* Input */
        .field { margin-bottom: 16px; }

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

        /* Row */
        .row-between {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 22px;
        }

        .remember-wrap { display: flex; align-items: center; gap: 7px; }

        .remember-wrap input[type="checkbox"] {
            width: 15px; height: 15px; accent-color: var(--accent); cursor: pointer;
        }

        .remember-wrap label { font-size: 13px; color: var(--g600); cursor: pointer; }

        /* Submit */
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

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(59,126,255,.35);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: .4; }
        }

        /* Responsive */
        @media (max-width: 820px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
            .right-panel { padding: 40px 28px; }
            .back-link { top: 16px; right: 16px; }
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
            <div class="lp-brand-name">Perpustakaan</div>
            <div class="lp-brand-sub">SDN Pasireurih</div>
        </div>
    </a>

    <div class="lp-center">
        <div class="lp-badge">
            <span class="dot"></span>
            Portal Khusus Pengelola Perpustakaan
        </div>
        <h1 class="lp-title">
            Selamat datang,<br>
            <span class="gold">Pengelola Perpustakaan<br>SDN Pasireurih</span>
        </h1>
        <p class="lp-desc">
            Halaman ini hanya untuk petugas dan admin perpustakaan.
        </p>
        <div class="lp-features">
            <div class="lp-feat">
                <div class="lp-feat-icon"><i class="fas fa-book"></i></div>
                Kelola koleksi buku dari berbagai kategori
            </div>
            <div class="lp-feat">
                <div class="lp-feat-icon"><i class="fas fa-exchange-alt"></i></div>
                Proses peminjaman dan pengembalian buku
            </div>
            <div class="lp-feat">
                <div class="lp-feat-icon"><i class="fas fa-chart-line"></i></div>
                Pantau laporan & statistik perpustakaan
            </div>
        </div>
    </div>

    <div class="lp-stats">
        <div class="lp-stat">
            <div class="lp-stat-num"></div>
            <div class="lp-stat-label"></div>
        </div>
        <div class="lp-stat-div"></div>
        <div class="lp-stat">
            <div class="lp-stat-num"></div>
            <div class="lp-stat-label"></div>
        </div>
        <div class="lp-stat-div"></div>
        <div class="lp-stat">
            <div class="lp-stat-num"></div>
            <div class="lp-stat-label"></div>
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
            <h2>Login</h2>
            <p>Masukkan kredensial akun Anda untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="alert-err">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label>Email</label>
                <div class="field-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="nama@email.com" required autocomplete="email" autofocus
                        class="{{ $errors->has('email') ? 'invalid' : '' }}">
                </div>
                @error('email') <div class="err-msg">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>Password</label>
                <div class="field-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password"
                        placeholder="Masukkan password" required autocomplete="current-password"
                        class="{{ $errors->has('password') ? 'invalid' : '' }}">
                </div>
                @error('password') <div class="err-msg">{{ $message }}</div> @enderror
            </div>

            <div class="row-between">
                <div class="remember-wrap">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Ingat saya</label>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>

        </form>
    </div>
</div>

</body>
</html>
