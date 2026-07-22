<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Buku — Perpustakaan SDN Pasireurih</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
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

        /* ── SWEETALERT CUSTOM ── */
.swal-popup-custom {
    border: 1.5px solid rgba(255,255,255,.15) !important;
    border-radius: 20px !important;
    backdrop-filter: blur(16px) !important;
    box-shadow: 0 32px 80px rgba(0,0,0,.6) !important;
}
.swal-title-custom {
    font-family: 'Sora', sans-serif !important;
    font-size: 22px !important;
    font-weight: 800 !important;
    color: #ffffff !important;
}
.swal2-html-container {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    font-size: 15px !important;
    color: rgba(255,255,255,.75) !important;
    line-height: 1.7 !important;
}
.swal-btn-custom {
    font-family: 'Sora', sans-serif !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    border-radius: 10px !important;
    padding: 10px 28px !important;
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
        .orb-3 { width: 250px; height: 250px; background: #60a5fa;  opacity: .2;  top: 30%;  left: -60px; }

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

        /* ── ANGGOTA BAR ── */
        .anggota-bar {
            background: rgba(0,0,0,.2); border-bottom: 1px solid var(--border);
            padding: 10px 0; position: relative; z-index: 5;
        }
        .anggota-bar .wrap { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .anggota-left { display: flex; align-items: center; gap: 10px; }
        .anggota-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,.15); border: 2px solid rgba(255,255,255,.25);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 800; color: var(--white); flex-shrink: 0;
        }
        .anggota-name { font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700; color: var(--white); display: block; }
        .anggota-nis  { font-size: 11px; font-weight: 500; color: var(--muted); display: block; margin-top: 1px; }
        .kuota-badge {
            display: flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18);
            border-radius: 99px; padding: 5px 14px;
            font-size: 12px; font-weight: 700; color: var(--white);
        }
        .kuota-dot { width: 8px; height: 8px; border-radius: 50%; background: #4ade80; }
        .kuota-dot.penuh { background: #f87171; }

        /* ── LAYOUT ── */
        .layout { flex: 1; display: grid; grid-template-columns: 1fr 290px; gap: 24px; padding: 28px 0 56px; align-items: start; position: relative; z-index: 1; }

        /* ── PANEL KIRI ── */
        .flash { padding: 12px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; backdrop-filter: blur(8px); }
        .flash-ok   { background: rgba(74,222,128,.15); border: 1px solid rgba(74,222,128,.3);  color: #86efac; }
        .flash-err  { background: rgba(248,113,113,.15); border: 1px solid rgba(248,113,113,.3); color: #fca5a5; }
        .flash-info { background: rgba(96,165,250,.15);  border: 1px solid rgba(96,165,250,.3);  color: #93c5fd; }

        .filter-bar { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }

        .input-cari {
            flex: 1; min-width: 180px; height: 44px;
            background: rgba(255,255,255,.09); border: 1.5px solid rgba(255,255,255,.15);
            border-radius: 10px; padding: 0 14px 0 42px;
            font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 500;
            color: var(--white); outline: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.35)' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='7'/%3E%3Cline x1='16.5' y1='16.5' x2='21' y2='21'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: 14px center;
            transition: border-color .18s;
        }
        .input-cari::placeholder { color: rgba(255,255,255,.25); }
        .input-cari:focus { border-color: rgba(255,255,255,.4); }

        .select-kat {
            height: 44px; background: rgba(255,255,255,.09); border: 1.5px solid rgba(255,255,255,.15);
            border-radius: 10px; padding: 0 34px 0 14px;
            font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600;
            color: var(--white); outline: none; cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='13' height='13' viewBox='0 0 24 24' fill='none' stroke='rgba(255,255,255,.4)' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 12px center;
            transition: border-color .18s;
        }
        .select-kat option { background: #1a2e6f; color: #fff; }
        .select-kat:focus { border-color: rgba(255,255,255,.4); }

        .btn-reset {
            height: 44px; padding: 0 14px; background: rgba(255,255,255,.08);
            border: 1.5px solid rgba(255,255,255,.15); border-radius: 10px;
            font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 600;
            color: var(--muted); cursor: pointer; text-decoration: none;
            display: flex; align-items: center; gap: 6px; transition: all .15s;
        }
        .btn-reset:hover { background: rgba(255,255,255,.14); color: var(--white); }

        .btn-cari {
            height: 44px; padding: 0 20px; background: var(--white); color: var(--navy);
            border: none; border-radius: 10px;
            font-size: 13px; font-family: 'Sora', sans-serif; font-weight: 700;
            cursor: pointer; display: flex; align-items: center; gap: 6px; transition: all .18s;
        }
        .btn-cari:hover { background: var(--gold); color: var(--navy-deep); }

        .hasil-label { font-size: 12.5px; font-weight: 600; color: var(--muted); margin-bottom: 16px; }
        .hasil-label strong { color: var(--white); }

        /* ── BUKU GRID ── */
        .buku-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(148px, 1fr)); gap: 14px; }

        .buku-card {
            background: rgba(255,255,255,.08); border: 1.5px solid rgba(255,255,255,.12);
            border-radius: 14px; overflow: hidden;
            transition: all .2s; position: relative;
            backdrop-filter: blur(8px);
        }
        .buku-card:hover:not(.habis) { border-color: rgba(255,255,255,.35); background: rgba(255,255,255,.12); transform: translateY(-2px); }
        .buku-card.dipilih { border-color: var(--gold); background: rgba(245,158,11,.1); }
        .buku-card.habis   { opacity: .5; }

        .badge-dipilih { position: absolute; top: 8px; right: 8px; background: var(--gold); color: var(--navy-deep); font-size: 9.5px; font-weight: 800; padding: 3px 9px; border-radius: 99px; }
        .badge-habis   { position: absolute; top: 8px; right: 8px; background: rgba(248,113,113,.25); color: #fca5a5; font-size: 9.5px; font-weight: 700; padding: 3px 9px; border-radius: 99px; border: 1px solid rgba(248,113,113,.3); }

        .buku-sampul { width: 100%; aspect-ratio: 3/4; object-fit: cover; display: block; cursor: pointer; transition: transform .2s; }
        .buku-sampul:hover { transform: scale(1.03); }
        .buku-sampul-ph { width: 100%; aspect-ratio: 3/4; background: rgba(255,255,255,.06); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background .2s; }
        .buku-sampul-ph:hover { background: rgba(255,255,255,.1); }
        .buku-sampul-ph i { font-size: 36px; color: rgba(255,255,255,.15); }

        .buku-info { padding: 10px 12px 12px; }
        .buku-kat   { font-size: 9.5px; font-weight: 800; color: var(--gold-lt); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px; }
        .buku-judul { font-family: 'Sora', sans-serif; font-size: 12px; font-weight: 700; color: var(--white); line-height: 1.35; margin-bottom: 3px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .buku-penulis { font-size: 11px; font-weight: 500; color: var(--muted); margin-bottom: 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .buku-stok    { font-size: 10.5px; font-weight: 700; color: #4ade80; margin-bottom: 9px; }
        .buku-stok.nol { color: #f87171; }

        .btn-pilih { width: 100%; height: 32px; border-radius: 8px; border: none; font-size: 11.5px; font-family: 'Sora', sans-serif; font-weight: 700; cursor: pointer; transition: all .15s; }
        .btn-pilih-tambah  { background: var(--white); color: var(--navy); }
        .btn-pilih-tambah:hover { background: var(--gold); color: var(--navy-deep); }
        .btn-pilih-hapus   { background: rgba(248,113,113,.2); color: #fca5a5; border: 1px solid rgba(248,113,113,.3); }
        .btn-pilih-hapus:hover { background: rgba(248,113,113,.35); }
        .btn-pilih-disabled { background: rgba(255,255,255,.07); color: rgba(255,255,255,.25); cursor: not-allowed; }

        .buku-kosong { grid-column: 1/-1; padding: 48px 24px; text-align: center; color: var(--muted); }
        .buku-kosong i { font-size: 48px; opacity: .2; margin-bottom: 14px; display: block; }
        .buku-kosong p { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: rgba(255,255,255,.6); margin-bottom: 6px; }

        /* ── PANEL KANAN ── */
        .panel-kanan { position: sticky; top: 120px; }

        .keranjang-card {
            background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.15);
            border-radius: 16px; overflow: hidden; backdrop-filter: blur(16px);
            box-shadow: 0 16px 48px rgba(0,0,0,.3);
        }

        .keranjang-header {
            background: rgba(0,0,0,.25); border-bottom: 1px solid rgba(255,255,255,.1);
            padding: 16px 18px; display: flex; align-items: center; justify-content: space-between;
        }
        .keranjang-judul { font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 800; color: var(--white); display: flex; align-items: center; gap: 8px; }
        .keranjang-judul i { color: var(--gold-lt); }
        .keranjang-count  { background: var(--gold); color: var(--navy-deep); font-family: 'Sora', sans-serif; font-size: 11px; font-weight: 800; padding: 3px 10px; border-radius: 99px; }

        .keranjang-body { padding: 16px; }

        .slot-list { display: flex; flex-direction: column; gap: 10px; margin-bottom: 14px; }
        .slot { border-radius: 10px; padding: 12px 13px; display: flex; align-items: center; gap: 10px; min-height: 60px; }
        .slot-isi   { background: rgba(245,158,11,.1); border: 1.5px solid rgba(245,158,11,.3); }
        .slot-kosong { background: rgba(255,255,255,.05); border: 1.5px dashed rgba(255,255,255,.15); }
        .slot-num   { width: 26px; height: 26px; background: var(--gold); color: var(--navy-deep); border-radius: 50%; font-family: 'Sora', sans-serif; font-size: 11px; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .slot-num-e { width: 26px; height: 26px; background: rgba(255,255,255,.1); border-radius: 50%; flex-shrink: 0; }
        .slot-judul { font-family: 'Sora', sans-serif; font-size: 11.5px; font-weight: 700; color: var(--white); flex: 1; line-height: 1.35; }
        .slot-empty { font-size: 12px; font-weight: 500; color: rgba(255,255,255,.25); flex: 1; }
        .btn-slot-hapus { width: 26px; height: 26px; border-radius: 7px; border: none; background: rgba(248,113,113,.2); color: #fca5a5; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background .15s; }
        .btn-slot-hapus:hover { background: rgba(248,113,113,.35); }
        .btn-slot-hapus i { font-size: 10px; }

        .panduan { background: rgba(245,158,11,.1); border: 1px solid rgba(245,158,11,.25); border-radius: 9px; padding: 10px 12px; font-size: 11.5px; font-weight: 600; color: rgba(255,255,255,.7); line-height: 1.6; margin-bottom: 14px; }

        .btn-lanjut {
            width: 100%; height: 46px; background: var(--white); color: var(--navy);
            border: none; border-radius: 11px;
            font-family: 'Sora', sans-serif; font-size: 13.5px; font-weight: 800;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
            text-decoration: none; transition: all .18s; margin-bottom: 10px;
            box-shadow: 0 6px 20px rgba(0,0,0,.25);
        }
        .btn-lanjut:hover:not(.disabled) { background: var(--gold); color: var(--navy-deep); transform: translateY(-2px); }
        .btn-lanjut.disabled { background: rgba(255,255,255,.1); color: rgba(255,255,255,.25); cursor: not-allowed; box-shadow: none; }

        .btn-kembali {
            width: 100%; height: 38px; background: transparent; color: var(--muted);
            border: 1.5px solid rgba(255,255,255,.15); border-radius: 11px;
            font-family: 'Plus Jakarta Sans', sans-serif; font-size: 12.5px; font-weight: 600;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px;
            text-decoration: none; transition: all .15s;
        }
        .btn-kembali:hover { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.28); color: var(--white); }

        /* ── FOOTER ── */
        footer { border-top: 1px solid var(--border); color: var(--muted); text-align: center; padding: 16px; font-size: 12px; font-weight: 500; position: relative; z-index: 1; }
        footer span { color: rgba(255,255,255,.8); font-weight: 700; }

        /* ══════════════════════════════════════
           MODAL
        ══════════════════════════════════════ */
        .modal-backdrop {
            position: fixed; inset: 0; z-index: 9000;
            background: rgba(5, 10, 40, 0.72);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: none; align-items: center; justify-content: center;
            padding: 20px;
            opacity: 0; pointer-events: none;
            transition: opacity .28s cubic-bezier(.4,0,.2,1);
        }
        .modal-backdrop.aktif {
            opacity: 1; pointer-events: all;
        }
        .modal-box {
            background: linear-gradient(145deg, rgba(26,46,111,.98) 0%, rgba(15,31,92,.98) 100%);
            border: 1.5px solid rgba(255,255,255,.15);
            border-radius: 20px;
            width: 100%; max-width: 640px;
            box-shadow: 0 32px 80px rgba(0,0,0,.6), 0 0 0 1px rgba(255,255,255,.06);
            overflow: hidden;
            transform: translateY(24px) scale(.96);
            transition: transform .32s cubic-bezier(.34,1.56,.64,1), opacity .28s ease;
            opacity: 0;
            position: relative;
        }
        .modal-backdrop.aktif .modal-box {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        .modal-konten {
            display: grid;
            grid-template-columns: 200px 1fr;
            min-height: 280px;
        }
        .modal-sampul-wrap {
            position: relative; overflow: hidden;
            background: rgba(0,0,0,.3); flex-shrink: 0;
        }
        .modal-sampul-wrap img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .modal-sampul-ph { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,.05); }
        .modal-sampul-ph i { font-size: 52px; color: rgba(255,255,255,.12); }
        .modal-sampul-overlay { position: absolute; inset: 0; background: linear-gradient(to right, transparent 60%, rgba(15,31,92,.95)); pointer-events: none; }
        .modal-info { padding: 22px 22px 18px; display: flex; flex-direction: column; overflow-y: auto; max-height: 70vh; }
        .modal-kat { font-size: 10px; font-weight: 800; color: var(--gold-lt); text-transform: uppercase; letter-spacing: .1em; margin-bottom: 6px; }
        .modal-judul { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 800; color: var(--white); line-height: 1.3; margin-bottom: 4px; }
        .modal-penulis { font-size: 12.5px; font-weight: 500; color: rgba(255,255,255,.55); margin-bottom: 14px; }
        .modal-meta { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
        .modal-meta-row { display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 500; color: rgba(255,255,255,.6); }
        .modal-meta-row i { width: 16px; text-align: center; color: var(--gold-lt); flex-shrink: 0; }
        .modal-meta-row strong { color: var(--white); font-weight: 700; }
        .modal-stok-badge { display: inline-flex; align-items: center; gap: 5px; background: rgba(74,222,128,.15); border: 1px solid rgba(74,222,128,.3); color: #86efac; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 99px; margin-bottom: 16px; width: fit-content; }
        .modal-stok-badge.habis { background: rgba(248,113,113,.15); border-color: rgba(248,113,113,.3); color: #fca5a5; }
        .modal-stok-badge i { font-size: 9px; }
        .modal-divider { height: 1px; background: rgba(255,255,255,.08); margin-bottom: 14px; }
        .modal-footer { display: flex; gap: 8px; margin-top: auto; }
        .btn-modal-tutup { flex: 0 0 auto; height: 40px; padding: 0 16px; background: rgba(255,255,255,.08); border: 1.5px solid rgba(255,255,255,.15); border-radius: 10px; color: var(--muted); font-family: 'Sora', sans-serif; font-size: 12.5px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: all .15s; }
        .btn-modal-tutup:hover { background: rgba(255,255,255,.14); color: var(--white); }
        .btn-modal-pilih { flex: 1; height: 40px; border: none; border-radius: 10px; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 7px; transition: all .18s; }
        .btn-modal-pilih.tambah { background: var(--white); color: var(--navy); }
        .btn-modal-pilih.tambah:hover { background: var(--gold); color: var(--navy-deep); }
        .btn-modal-pilih.hapus { background: rgba(248,113,113,.2); color: #fca5a5; border: 1.5px solid rgba(248,113,113,.3); }
        .btn-modal-pilih.hapus:hover { background: rgba(248,113,113,.35); }
        .btn-modal-pilih.disabled { background: rgba(255,255,255,.07); color: rgba(255,255,255,.25); cursor: not-allowed; }
        .modal-close-x { position: absolute; top: 12px; right: 12px; z-index: 2; width: 28px; height: 28px; border-radius: 50%; background: rgba(0,0,0,.35); border: 1px solid rgba(255,255,255,.15); color: rgba(255,255,255,.7); display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 11px; transition: all .15s; }
        .modal-close-x:hover { background: rgba(255,255,255,.15); color: var(--white); }

        @media(max-width: 500px) {
            .modal-konten { grid-template-columns: 1fr; }
            .modal-sampul-wrap { height: 200px; }
            .modal-sampul-overlay { background: linear-gradient(to bottom, transparent 50%, rgba(15,31,92,.95)); }
        }

        @media(max-width:900px){ .layout{grid-template-columns:1fr;} .panel-kanan{position:static;} .wrap{padding:0 16px;} }
        @media(max-width:500px){ .buku-grid{grid-template-columns:repeat(2,1fr);} }
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
            <div class="header-sub">Pilih buku yang ingin dipinjam</div>
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
            <div class="step active">
                <div class="step-circle">2</div>
                <div class="step-label">Pilih Buku</div>
            </div>
            <div class="step-line wait"></div>
            <div class="step wait">
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

{{-- ANGGOTA BAR --}}
<div class="anggota-bar">
    <div class="wrap">
        <div class="anggota-left">
            <div class="anggota-avatar">
                {{ strtoupper(substr(session('peminjam_identifikasi.nama_lengkap', 'A'), 0, 1)) }}
            </div>
            <div>
                <span class="anggota-name">{{ session('peminjam_identifikasi.nama_lengkap') }}</span>
                <span class="anggota-nis">NIS/NIP: {{ session('peminjam_identifikasi.nis_nip') }}</span>
            </div>
        </div>
        @php $jumlahKeranjang = count($keranjang); @endphp
        <div class="kuota-badge">
            <div class="kuota-dot {{ $jumlahKeranjang >= 2 ? 'penuh' : '' }}"></div>
            {{ $jumlahKeranjang }}/2 buku dipilih
        </div>
    </div>
</div>

{{-- LAYOUT --}}
<div class="wrap">
    <div class="layout">

        {{-- PANEL KIRI --}}
        <div>
        @if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: @json(session('success')),
    confirmButtonText: 'OK',
    confirmButtonColor: '#f59e0b',
    background: '#0f1f5c',
    color: '#ffffff',
    iconColor: '#4ade80',
    width: '480px',
    padding: '2rem',
    customClass: {
        popup: 'swal-popup-custom',
        title: 'swal-title-custom',
        confirmButton: 'swal-btn-custom'
    }
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Tidak Bisa Meminjam!',
    text: '{{ session('error') }}',
    confirmButtonText: 'Mengerti',
    confirmButtonColor: '#f59e0b',
    background: '#0f1f5c',
    color: '#ffffff',
    iconColor: '#f87171',
    width: '520px',
    padding: '2.5rem',
    customClass: {
        popup: 'swal-popup-custom',
        title: 'swal-title-custom',
        confirmButton: 'swal-btn-custom'
    }
});
</script>
@endif

            <form method="GET" action="{{ route('pinjam.pilih-buku') }}" class="filter-bar">
                <input type="text" name="cari" class="input-cari" placeholder="Cari judul buku..." value="{{ request('cari') }}">
                <select name="kategori" class="select-kat" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                    @endforeach
                </select>
                @if(request('cari') || request('kategori'))
                    <a href="{{ route('pinjam.pilih-buku') }}" class="btn-reset"><i class="fas fa-times"></i> Reset</a>
                @endif
                <button type="submit" class="btn-cari"><i class="fas fa-search"></i> Cari</button>
            </form>

            <div class="hasil-label">
                Menampilkan <strong>{{ $buku->count() }}</strong> buku
                @if(request('cari')) untuk "<strong>{{ request('cari') }}</strong>" @endif
            </div>

            @php $keranjangIds = collect($keranjang)->pluck('id')->toArray(); @endphp

            <div class="buku-grid">
                @forelse($buku as $b)
                    @php
                        $dipilih     = in_array($b->id, $keranjangIds);
                        $habis       = $b->stok < 1;
                        $kuotaPenuh  = $jumlahKeranjang >= 2 && !$dipilih;
                        $penerbitNama = $b->penerbit->nama ?? '—';
                        $rakInfo      = $b->rak ? 'Rak '.$b->rak->rak.', Baris '.$b->rak->baris : '—';
                        $sampulUrl    = $b->sampul ? asset('storage/'.$b->sampul) : '';
                        $kategoriNama = $b->kategori->nama ?? '—';
                    @endphp
                    <div class="buku-card {{ $dipilih ? 'dipilih' : '' }} {{ $habis ? 'habis' : '' }}">

                        @if($dipilih)   <div class="badge-dipilih"><i class="fas fa-check"></i> Dipilih</div>
                        @elseif($habis) <div class="badge-habis">Habis</div>
                        @endif

                        {{-- Gambar buku — klik untuk buka modal --}}
                        @if($b->sampul)
                            <img src="{{ $sampulUrl }}"
                                 alt="{{ $b->judul }}"
                                 class="buku-sampul"
                                 onclick="bukaBuku(
                                     {{ $b->id }},
                                     '{{ addslashes($b->judul) }}',
                                     '{{ addslashes($b->penulis) }}',
                                     '{{ addslashes($penerbitNama) }}',
                                     '{{ addslashes($rakInfo) }}',
                                     '{{ addslashes($kategoriNama) }}',
                                     {{ $b->stok }},
                                     '{{ $sampulUrl }}',
                                     {{ $dipilih ? 'true' : 'false' }},
                                     {{ $kuotaPenuh ? 'true' : 'false' }}
                                 )"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <div class="buku-sampul-ph" style="display:none;"
                                 onclick="bukaBuku({{ $b->id }},'{{ addslashes($b->judul) }}','{{ addslashes($b->penulis) }}','{{ addslashes($penerbitNama) }}','{{ addslashes($rakInfo) }}','{{ addslashes($kategoriNama) }}',{{ $b->stok }},'',{{ $dipilih ? 'true' : 'false' }},{{ $kuotaPenuh ? 'true' : 'false' }})">
                                <i class="fas fa-book"></i>
                            </div>
                        @else
                            <div class="buku-sampul-ph"
                                 onclick="bukaBuku({{ $b->id }},'{{ addslashes($b->judul) }}','{{ addslashes($b->penulis) }}','{{ addslashes($penerbitNama) }}','{{ addslashes($rakInfo) }}','{{ addslashes($kategoriNama) }}',{{ $b->stok }},'',{{ $dipilih ? 'true' : 'false' }},{{ $kuotaPenuh ? 'true' : 'false' }})">
                                <i class="fas fa-book"></i>
                            </div>
                        @endif

                        <div class="buku-info">
                            <div class="buku-kat">{{ $kategoriNama }}</div>
                            <div class="buku-judul">{{ $b->judul }}</div>
                            <div class="buku-penulis">{{ $b->penulis }}</div>
                            <div class="buku-stok {{ $habis ? 'nol' : '' }}">
                                {{ $habis ? 'Stok habis' : 'Stok: '.$b->stok }}
                            </div>

                            @if($dipilih)
                                <form method="POST" action="{{ route('pinjam.pilih-buku.hapus') }}">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $b->id }}">
                                    <button type="submit" class="btn-pilih btn-pilih-hapus"><i class="fas fa-times"></i> Hapus</button>
                                </form>
                            @elseif($habis)
                                <button class="btn-pilih btn-pilih-disabled" disabled>Tidak Tersedia</button>
                            @elseif($kuotaPenuh)
                                <button class="btn-pilih btn-pilih-disabled" disabled>Kuota Penuh</button>
                            @else
                                <form method="POST" action="{{ route('pinjam.pilih-buku.tambah') }}">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $b->id }}">
                                    <button type="submit" class="btn-pilih btn-pilih-tambah">+ Pilih</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="buku-kosong">
                        <i class="fas fa-book-open"></i>
                        <p>Buku tidak ditemukan</p>
                        <span style="font-size:13px;">Coba kata kunci atau kategori lain</span>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- PANEL KANAN --}}
        <div class="panel-kanan">
            <div class="keranjang-card">
                <div class="keranjang-header">
                    <div class="keranjang-judul"><i class="fas fa-bookmark"></i> Buku Dipilih</div>
                    <div class="keranjang-count">{{ $jumlahKeranjang }}/2</div>
                </div>
                <div class="keranjang-body">

                    <div class="slot-list">
                        @for($i = 0; $i < 2; $i++)
                            @if(isset($keranjang[$i]))
                                <div class="slot slot-isi">
                                    <div class="slot-num">{{ $i+1 }}</div>
                                    <div class="slot-judul">{{ $keranjang[$i]['judul'] }}</div>
                                    <form method="POST" action="{{ route('pinjam.pilih-buku.hapus') }}" style="flex-shrink:0">
                                        @csrf
                                        <input type="hidden" name="buku_id" value="{{ $keranjang[$i]['id'] }}">
                                        <button type="submit" class="btn-slot-hapus"><i class="fas fa-times"></i></button>
                                    </form>
                                </div>
                            @else
                                <div class="slot slot-kosong">
                                    <div class="slot-num-e"></div>
                                    <div class="slot-empty">Slot buku {{ $i+1 }}</div>
                                </div>
                            @endif
                        @endfor
                    </div>

                    <div class="panduan">
                        <i class="fas fa-lightbulb" style="color:var(--gold);"></i>
                        Pilih 1–2 buku, lalu klik <strong style="color:#fff;">Lanjut</strong> untuk konfirmasi.
                    </div>

                    @if($jumlahKeranjang > 0)
                        <a href="{{ route('pinjam.konfirmasi') }}" class="btn-lanjut">
                            Lanjut ke Konfirmasi <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <span class="btn-lanjut disabled">Pilih minimal 1 buku</span>
                    @endif

                    <a href="{{ route('pinjam.identifikasi') }}" class="btn-kembali">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- ══ MODAL DETAIL BUKU ══ --}}
<div class="modal-backdrop" id="modalBackdrop" onclick="tutupModal(event)">
    <div class="modal-box" id="modalBox">

        <button class="modal-close-x" onclick="tutupModalPaksa()">
            <i class="fas fa-times"></i>
        </button>

        <div class="modal-konten">

            <div class="modal-sampul-wrap" id="modalSampulWrap">
                <img id="modalSampulImg" src="" alt="" style="display:none;">
                <div class="modal-sampul-ph" id="modalSampulPh"><i class="fas fa-book"></i></div>
                <div class="modal-sampul-overlay"></div>
            </div>

            <div class="modal-info">
                <div class="modal-kat"    id="modalKat"></div>
                <div class="modal-judul"  id="modalJudul"></div>
                <div class="modal-penulis" id="modalPenulis"></div>

                <div class="modal-meta">
                    <div class="modal-meta-row">
                        <i class="fas fa-building-columns"></i>
                        <span>Penerbit: <strong id="modalPenerbit">—</strong></span>
                    </div>
                    <div class="modal-meta-row">
                        <i class="fas fa-bookmark"></i>
                        <span>Lokasi: <strong id="modalRak">—</strong></span>
                    </div>
                </div>

                <div class="modal-stok-badge" id="modalStokBadge">
                    <i class="fas fa-circle-check"></i>
                    <span id="modalStokTeks">Tersedia</span>
                </div>

                <div class="modal-divider"></div>

                <div class="modal-footer">
                    <button class="btn-modal-tutup" onclick="tutupModalPaksa()">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <div id="modalTombolAksi" style="flex:1;display:flex;"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} <span>SDN Pasireurih 05</span>.
</footer>

<script>
function bukaBuku(id, judul, penulis, penerbit, rak, kategori, stok, sampulUrl, dipilih, kuotaPenuh) {
    document.getElementById('modalKat').textContent      = kategori;
    document.getElementById('modalJudul').textContent    = judul;
    document.getElementById('modalPenulis').textContent  = 'Penulis: ' + penulis;
    document.getElementById('modalPenerbit').textContent = penerbit;
    document.getElementById('modalRak').textContent      = rak;

    var img = document.getElementById('modalSampulImg');
    var ph  = document.getElementById('modalSampulPh');
    if (sampulUrl) {
        img.src = sampulUrl;
        img.style.display = 'block';
        ph.style.display  = 'none';
        img.onerror = function() { img.style.display='none'; ph.style.display='flex'; };
    } else {
        img.style.display = 'none';
        ph.style.display  = 'flex';
    }

    var badge    = document.getElementById('modalStokBadge');
    var stokTeks = document.getElementById('modalStokTeks');
    var habis    = stok < 1;
    if (habis) {
        badge.classList.add('habis');
        stokTeks.textContent = 'Stok habis';
        badge.querySelector('i').className = 'fas fa-circle-xmark';
    } else {
        badge.classList.remove('habis');
        stokTeks.textContent = 'Stok tersedia: ' + stok;
        badge.querySelector('i').className = 'fas fa-circle-check';
    }

    var aksiWrap = document.getElementById('modalTombolAksi');
    aksiWrap.innerHTML = '';

    if (dipilih) {
        var f = document.createElement('form');
        f.method = 'POST';
        f.action = '{{ route("pinjam.pilih-buku.hapus") }}';
        f.style.flex = '1';
        f.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}">'
                    + '<input type="hidden" name="buku_id" value="' + id + '">'
                    + '<button type="submit" class="btn-modal-pilih hapus" style="width:100%;">'
                    + '<i class="fas fa-times"></i> Hapus dari Pilihan</button>';
        aksiWrap.appendChild(f);

    } else if (habis) {
        var b = document.createElement('button');
        b.className = 'btn-modal-pilih disabled'; b.style.width = '100%'; b.disabled = true;
        b.innerHTML = '<i class="fas fa-ban"></i> Stok Habis';
        aksiWrap.appendChild(b);

    } else if (kuotaPenuh) {
        var b = document.createElement('button');
        b.className = 'btn-modal-pilih disabled'; b.style.width = '100%'; b.disabled = true;
        b.innerHTML = '<i class="fas fa-lock"></i> Kuota Penuh (2/2)';
        aksiWrap.appendChild(b);

    } else {
        var f = document.createElement('form');
        f.method = 'POST';
        f.action = '{{ route("pinjam.pilih-buku.tambah") }}';
        f.style.flex = '1';
        f.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}">'
                    + '<input type="hidden" name="buku_id" value="' + id + '">'
                    + '<button type="submit" class="btn-modal-pilih tambah" style="width:100%;">'
                    + '<i class="fas fa-plus"></i> Pilih Buku Ini</button>';
        aksiWrap.appendChild(f);
    }

    var backdrop = document.getElementById('modalBackdrop');
    backdrop.style.display = 'flex';
    requestAnimationFrame(function() {
        requestAnimationFrame(function() {
            backdrop.classList.add('aktif');
        });
    });
    document.body.style.overflow = 'hidden';
}

function tutupModal(e) {
    if (e && e.target !== document.getElementById('modalBackdrop')) return;
    _tutup();
}

function tutupModalPaksa() { _tutup(); }

function _tutup() {
    var backdrop = document.getElementById('modalBackdrop');
    backdrop.classList.remove('aktif');
    document.body.style.overflow = '';
    setTimeout(function() { backdrop.style.display = 'none'; }, 300);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') _tutup();
});
</script>

</body>
</html>
