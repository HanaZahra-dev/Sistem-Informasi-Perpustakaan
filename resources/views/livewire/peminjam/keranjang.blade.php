<div>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
.kr-wrap *, .kr-wrap *::before, .kr-wrap *::after { box-sizing: border-box; }

.kr-wrap {
    font-family: 'Plus Jakarta Sans', sans-serif;
    max-width: 900px;
    margin: 36px auto;
    padding: 0 20px 80px;
}

/* ── PAGE HEADER ── */
.kr-page-header { margin-bottom: 24px; }
.kr-page-header h2 { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
.kr-page-header p  { font-size: 13.5px; color: #64748b; }

/* ── FLASH ── */
.flash-ok {
    background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d;
    border-radius: 10px; padding: 12px 16px; margin-bottom: 18px;
    font-size: 13.5px; display: flex; align-items: center; gap: 8px;
}
.flash-err {
    background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
    border-radius: 10px; padding: 12px 16px; margin-bottom: 18px;
    font-size: 13.5px; display: flex; align-items: center; gap: 8px;
}

/* ── TABS ── */
.kr-tabs {
    display: flex; gap: 4px;
    border-bottom: 2px solid #f1f5f9;
    margin-bottom: 22px;
}
.kr-tab {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px; font-size: 13.5px; font-weight: 600;
    color: #64748b; background: transparent; border: none;
    border-bottom: 2px solid transparent; margin-bottom: -2px;
    cursor: pointer; font-family: inherit; transition: all .2s;
    border-radius: 6px 6px 0 0;
}
.kr-tab:hover { color: #1e293b; background: #f8fafc; }
.kr-tab.active { color: #1a2e6f; border-bottom-color: #1a2e6f; background: #eef2ff; }
.kr-tab .tab-badge {
    background: #e2e8f0; color: #475569;
    font-size: 11px; font-weight: 700;
    padding: 2px 7px; border-radius: 99px; min-width: 20px; text-align: center;
}
.kr-tab.active .tab-badge { background: #1a2e6f; color: #fff; }

/* ── CARD ── */
.kr-card {
    background: #fff; border-radius: 16px;
    border: 1px solid rgba(30,64,175,.09);
    box-shadow: 0 4px 20px rgba(30,64,175,.07);
    overflow: hidden;
}
.kr-card-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 22px; border-bottom: 1px solid #f1f5f9;
}
.kr-card-title {
    font-size: 15px; font-weight: 700; color: #1e293b;
    display: flex; align-items: center; gap: 8px;
}
.kr-card-title i { color: #2563eb; }
.kode-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f0f4ff; color: #1a2e6f;
    border: 1px solid rgba(30,64,175,.18); border-radius: 8px;
    padding: 5px 12px; font-size: 12px; font-weight: 700; letter-spacing: .03em;
}

/* ── TABLE ── */
.kr-table { width: 100%; border-collapse: collapse; }
.kr-table thead tr { background: #f8fafc; border-bottom: 2px solid #f1f5f9; }
.kr-table thead th {
    padding: 11px 16px; font-size: 11px; font-weight: 700;
    color: #64748b; text-transform: uppercase; letter-spacing: .06em; text-align: left;
}
.kr-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .12s; }
.kr-table tbody tr:last-child { border-bottom: none; }
.kr-table tbody tr:hover { background: #fafbff; }
.kr-table td { padding: 13px 16px; font-size: 13.5px; color: #1e293b; vertical-align: middle; }

.buku-cell { display: flex; align-items: center; gap: 12px; }
.buku-cover {
    width: 38px; height: 50px; border-radius: 6px;
    background: #f0f4ff; overflow: hidden; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.buku-cover img { width: 100%; height: 100%; object-fit: cover; }
.buku-cover i { color: #bfdbfe; font-size: 17px; }
.buku-judul { font-weight: 700; font-size: 13px; color: #1e293b; margin-bottom: 3px; line-height: 1.3; }
.buku-kode {
    display: inline-block; background: #eff6ff; color: #2563eb;
    font-size: 10.5px; font-weight: 600; padding: 2px 7px; border-radius: 4px;
}

/* ── BADGES ── */
.stok-ok {
    display: inline-flex; align-items: center; gap: 5px;
    background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0;
    font-size: 11.5px; font-weight: 600; padding: 4px 10px; border-radius: 99px;
}
.stok-habis {
    display: inline-flex; align-items: center; gap: 5px;
    background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;
    font-size: 11.5px; font-weight: 600; padding: 4px 10px; border-radius: 99px;
}

/* Status pills */
.pill { font-size: 11.5px; font-weight: 700; padding: 4px 12px; border-radius: 99px; display: inline-block; }
.pill-menunggu { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
.pill-dipinjam { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
.pill-selesai  { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
.pill-ditolak  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

/* ── BUTTONS ── */
.btn-hapus {
    display: inline-flex; align-items: center; gap: 6px;
    background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;
    border-radius: 8px; padding: 7px 12px; font-size: 12.5px; font-weight: 600;
    cursor: pointer; font-family: inherit; transition: all .2s;
}
.btn-hapus:hover { background: #fee2e2; }
.btn-hapus:disabled { opacity: .5; cursor: not-allowed; }

.btn-lanjut {
    display: inline-flex; align-items: center; gap: 8px;
    background: #f1f5f9; color: #1e293b; border: 1.5px solid #e2e8f0;
    border-radius: 10px; padding: 10px 20px;
    font-size: 13.5px; font-weight: 600; text-decoration: none;
    transition: all .2s;
}
.btn-lanjut:hover { background: #e2e8f0; }

.btn-kosong {
    display: inline-flex; align-items: center; gap: 6px;
    background: transparent; color: #dc2626; border: 1.5px solid #fca5a5;
    border-radius: 8px; padding: 9px 14px;
    font-size: 13px; font-weight: 600;
    cursor: pointer; font-family: inherit; transition: all .2s;
}
.btn-kosong:hover { background: #fef2f2; }

.btn-ajukan {
    display: inline-flex; align-items: center; gap: 8px;
    background: #1a2e6f; color: #fff; border: none;
    border-radius: 10px; padding: 11px 24px;
    font-size: 14px; font-weight: 700;
    cursor: pointer; font-family: inherit;
    transition: all .2s; box-shadow: 0 4px 16px rgba(26,46,111,.25);
}
.btn-ajukan:hover { background: #2563eb; transform: translateY(-1px); }
.btn-ajukan:disabled { opacity: .5; cursor: not-allowed; transform: none; }

.btn-cari {
    display: inline-flex; align-items: center; gap: 8px;
    background: #1a2e6f; color: #fff; border-radius: 10px;
    padding: 10px 22px; font-size: 13.5px; font-weight: 700;
    text-decoration: none; transition: all .2s;
}
.btn-cari:hover { background: #2563eb; }

/* ── INFO BAR ── */
.info-bar {
    display: flex; align-items: center; gap: 10px;
    background: #eff6ff; border: 1px solid #bfdbfe;
    border-radius: 10px; padding: 11px 18px;
    font-size: 13px; color: #1e40af;
    margin: 16px 22px 0;
}

/* ── ACTIONS FOOTER ── */
.kr-actions {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 22px; border-top: 1px solid #f1f5f9;
    flex-wrap: wrap; gap: 10px;
}

/* ── EMPTY STATE ── */
.kr-empty { text-align: center; padding: 52px 20px; }
.kr-empty i { font-size: 48px; color: #bfdbfe; margin-bottom: 14px; display: block; }
.kr-empty h3 { font-size: 17px; font-weight: 700; color: #1e293b; margin-bottom: 8px; }
.kr-empty p  { font-size: 13.5px; color: #94a3b8; margin-bottom: 18px; }

/* ── RIWAYAT CARDS ── */
.riwayat-card {
    background: #fff; border-radius: 14px;
    border: 1px solid rgba(30,64,175,.09);
    box-shadow: 0 2px 10px rgba(30,64,175,.06);
    overflow: hidden; margin-bottom: 12px;
}
.riwayat-header {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 20px; cursor: pointer; transition: background .15s;
    flex-wrap: wrap;
}
.riwayat-header:hover { background: #fafbff; }

.riwayat-no {
    width: 28px; height: 28px; border-radius: 50%;
    background: #f0f4ff; color: #2563eb;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; flex-shrink: 0;
}
.riwayat-kode {
    font-size: 12.5px; font-weight: 700; color: #1a2e6f;
    background: #f0f4ff; padding: 4px 10px; border-radius: 6px;
    border: 1px solid rgba(30,64,175,.15); white-space: nowrap;
}
.riwayat-tanggal { font-size: 12px; color: #64748b; flex: 1; min-width: 80px; }
.riwayat-total {
    font-size: 12.5px; color: #64748b;
    display: flex; align-items: center; gap: 5px;
}
.riwayat-chevron { color: #94a3b8; font-size: 12px; transition: transform .2s; }
.riwayat-chevron.open { transform: rotate(180deg); }

.riwayat-detail {
    border-top: 1px solid #f1f5f9;
    padding: 14px 20px; background: #fafbff;
}
.riwayat-detail-title {
    font-size: 11px; font-weight: 700; color: #64748b;
    text-transform: uppercase; letter-spacing: .06em; margin-bottom: 10px;
}
.riwayat-buku-list { display: flex; flex-direction: column; gap: 8px; margin-bottom: 14px; }
.riwayat-buku-item {
    display: flex; align-items: center; gap: 10px;
    background: #fff; border: 1px solid #f1f5f9;
    border-radius: 8px; padding: 10px 12px;
}
.riwayat-buku-icon {
    width: 32px; height: 32px; border-radius: 6px;
    background: #eff6ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.riwayat-buku-icon i { color: #2563eb; font-size: 14px; }
.riwayat-buku-judul  { font-weight: 700; font-size: 13px; color: #1e293b; }
.riwayat-buku-penulis { font-size: 12px; color: #94a3b8; margin-top: 1px; }

.alasan-tolak-box {
    background: #fef2f2; border: 1px solid #fecaca;
    border-radius: 8px; padding: 10px 14px; margin-top: 10px;
    font-size: 12.5px; color: #dc2626;
    display: flex; align-items: flex-start; gap: 8px;
}
.tanggal-strip {
    display: flex; flex-wrap: wrap; gap: 12px;
    font-size: 12.5px; color: #475569; margin-top: 10px;
}
.tanggal-strip span { display: flex; align-items: center; gap: 5px; }
.tanggal-strip i { color: #2563eb; }

/* ── MODAL ── */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,.45);
    z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px;
}
.modal-box {
    background: #fff; border-radius: 16px; width: 100%; max-width: 400px;
    box-shadow: 0 20px 60px rgba(0,0,0,.18); overflow: hidden;
}
.modal-head {
    padding: 18px 22px; border-bottom: 1px solid #f1f5f9;
    display: flex; align-items: center; gap: 10px;
}
.modal-head-icon {
    width: 36px; height: 36px; border-radius: 10px;
    background: #fef2f2; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.modal-head-icon i { color: #dc2626; font-size: 16px; }
.modal-head h3 { font-size: 15px; font-weight: 700; color: #1e293b; }
.modal-body { padding: 18px 22px; font-size: 13.5px; color: #475569; line-height: 1.6; }
.modal-foot {
    padding: 14px 22px; border-top: 1px solid #f1f5f9;
    display: flex; gap: 10px; justify-content: flex-end;
}
.modal-btn-batal {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f1f5f9; color: #1e293b; border: 1px solid #e2e8f0;
    border-radius: 8px; padding: 9px 18px;
    font-family: inherit; font-size: 13.5px; font-weight: 600; cursor: pointer; transition: all .15s;
}
.modal-btn-batal:hover { background: #e2e8f0; }
.modal-btn-hapus {
    display: inline-flex; align-items: center; gap: 6px;
    background: #dc2626; color: #fff; border: none;
    border-radius: 8px; padding: 9px 18px;
    font-family: inherit; font-size: 13.5px; font-weight: 700; cursor: pointer; transition: all .15s;
}
.modal-btn-hapus:hover { background: #b91c1c; }
</style>

{{-- Flash messages --}}
@if (session('sukses'))
    <div class="flash-ok" style="max-width:900px;margin:18px auto 0;padding-left:20px;padding-right:20px;">
        <i class="fas fa-check-circle"></i> {{ session('sukses') }}
    </div>
@endif
@if (session('gagal'))
    <div class="flash-err" style="max-width:900px;margin:18px auto 0;padding-left:20px;padding-right:20px;">
        <i class="fas fa-exclamation-circle"></i> {{ session('gagal') }}
    </div>
@endif

<div class="kr-wrap">

    {{-- Page Header --}}
    <div class="kr-page-header">
        <h2>Keranjang & Riwayat Peminjaman</h2>
        <p>Kelola buku yang ingin Anda pinjam dan pantau status pengajuan Anda.</p>
    </div>

    {{-- TABS --}}
    <div class="kr-tabs">
        <button class="kr-tab active" id="tab-keranjang" onclick="switchTab('keranjang')">
            <i class="fas fa-shopping-cart"></i>
            Keranjang
            <span class="tab-badge">{{ $keranjang ? $keranjang->detail_peminjaman->count() : 0 }}</span>
        </button>
        <button class="kr-tab" id="tab-riwayat" onclick="switchTab('riwayat')">
            <i class="fas fa-history"></i>
            Riwayat Pengajuan
            <span class="tab-badge">{{ $riwayat->count() }}</span>
        </button>
    </div>

    {{-- ══════════════════════════════
         TAB KERANJANG (status = 0)
    ══════════════════════════════ --}}
    <div id="panel-keranjang">
        @if (!$keranjang || $keranjang->detail_peminjaman->isEmpty())
            <div class="kr-card">
                <div class="kr-empty">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Keranjang Kosong</h3>
                    <p>Belum ada buku yang ditambahkan ke keranjang.<br>Cari buku di halaman koleksi dan klik "Tambah ke Keranjang".</p>
                    <a href="{{ route('koleksi.buku') }}" class="btn-cari">
                        <i class="fas fa-book-open"></i> Jelajahi Koleksi Buku
                    </a>
                </div>
            </div>
        @else
            <div class="kr-card">
                {{-- Header --}}
                <div class="kr-card-head">
                    <div class="kr-card-title">
                        <i class="fas fa-shopping-cart"></i>
                        Daftar Buku
                        <span style="color:#64748b;font-weight:500;font-size:13px;">
                            ({{ $keranjang->detail_peminjaman->count() }} buku)
                        </span>
                    </div>
                    <div class="kode-chip">
                        <i class="fas fa-barcode"></i>
                        {{ $keranjang->kode_pinjam }}
                    </div>
                </div>

                {{-- Tabel --}}
                <table class="kr-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Penulis</th>
                            <th>Rak</th>
                            <th>Baris</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjang->detail_peminjaman as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="buku-cell">
                                        <div class="buku-cover">
                                            @if ($item->buku->sampul ?? false)
                                                <img src="/storage/{{ $item->buku->sampul }}" alt="{{ $item->buku->judul }}">
                                            @else
                                                <i class="fas fa-book"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="buku-judul">{{ $item->buku->judul }}</div>
                                            <span class="buku-kode">BK-{{ str_pad($item->buku->id, 4, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->buku->penulis }}</td>
                                <td>{{ $item->buku->rak->rak ?? '-' }}</td>
                                <td>{{ $item->buku->rak->baris ?? '-' }}</td>
                                <td>
                                    @if (($item->buku->stok ?? 0) > 0)
                                        <span class="stok-ok">
                                            <i class="fas fa-check-circle"></i> Tersedia ({{ $item->buku->stok }})
                                        </span>
                                    @else
                                        <span class="stok-habis">
                                            <i class="fas fa-times-circle"></i> Habis
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <button
                                        wire:click="hapus({{ $keranjang->id }}, {{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        class="btn-hapus">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Info bar --}}
                <div class="info-bar">
                    <i class="fas fa-info-circle"></i>
                    Buku yang ada di keranjang belum dipinjam. Silakan ajukan peminjaman jika sudah sesuai.
                </div>

                {{-- Actions --}}
                <div class="kr-actions">
                    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                        <a href="{{ route('koleksi.buku') }}" class="btn-lanjut">
                            <i class="fas fa-arrow-left"></i> Lanjutkan Pinjam
                        </a>
                        <button wire:click="konfirmasiKosongkan" class="btn-kosong">
                            <i class="fas fa-trash-alt"></i> Kosongkan
                        </button>
                    </div>
                    <button
                        wire:click="ajukan({{ $keranjang->id }})"
                        wire:loading.attr="disabled"
                        class="btn-ajukan">
                        <i class="fas fa-paper-plane"></i> Ajukan Peminjaman
                    </button>
                </div>
            </div>
        @endif
    </div>

    {{-- ══════════════════════════════
         TAB RIWAYAT (status 1,2,3,4)
    ══════════════════════════════ --}}
    <div id="panel-riwayat" style="display:none;">
        @if ($riwayat->isEmpty())
            <div class="kr-card">
                <div class="kr-empty">
                    <i class="fas fa-history"></i>
                    <h3>Belum Ada Riwayat</h3>
                    <p>Kamu belum pernah mengajukan peminjaman.</p>
                    <a href="{{ route('koleksi.buku') }}" class="btn-cari">
                        <i class="fas fa-book-open"></i> Cari Buku
                    </a>
                </div>
            </div>
        @else
            @foreach ($riwayat as $item)
                <div class="riwayat-card">
                    <div class="riwayat-header"
                        onclick="toggleRiwayat('rv-{{ $item->id }}', 'icon-{{ $item->id }}')">

                        <div class="riwayat-no">{{ $loop->iteration }}</div>

                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:700;font-size:13.5px;color:#1e293b;">
                                {{ auth()->user()->name }}
                            </div>
                            <div style="font-size:11.5px;color:#94a3b8;margin-top:2px;">
                                {{ $item->created_at->format('d M Y, H:i') }} WIB
                            </div>
                        </div>

                        <div class="riwayat-kode">{{ $item->kode_pinjam }}</div>

                        <div class="riwayat-total">
                            <i class="fas fa-book" style="color:#2563eb;font-size:12px;"></i>
                            {{ $item->detail_peminjaman->count() }} Buku
                        </div>

                        @if ($item->status == 1)
                            <span class="pill pill-menunggu"><i class="fas fa-clock" style="font-size:10px;"></i> Menunggu</span>
                        @elseif ($item->status == 2)
                            <span class="pill pill-dipinjam"><i class="fas fa-book-reader" style="font-size:10px;"></i> Dipinjam</span>
                        @elseif ($item->status == 3)
                            <span class="pill pill-selesai"><i class="fas fa-check-circle" style="font-size:10px;"></i> Dikembalikan</span>
                        @elseif ($item->status == 4)
                            <span class="pill pill-ditolak"><i class="fas fa-times-circle" style="font-size:10px;"></i> Ditolak</span>
                        @endif

                        <i class="fas fa-chevron-down riwayat-chevron" id="icon-{{ $item->id }}"></i>
                    </div>

                    {{-- Detail expand --}}
                    <div class="riwayat-detail" id="rv-{{ $item->id }}" style="display:none;">
                        <div class="riwayat-detail-title">Daftar Buku</div>
                        <div class="riwayat-buku-list">
                            @foreach ($item->detail_peminjaman as $detail)
                                <div class="riwayat-buku-item">
                                    <div class="riwayat-buku-icon">
                                        @if ($detail->buku->sampul ?? false)
                                            <img src="/storage/{{ $detail->buku->sampul }}"
                                                style="width:32px;height:32px;object-fit:cover;border-radius:4px;">
                                        @else
                                            <i class="fas fa-book"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="riwayat-buku-judul"><td>{{ $detail->buku->judul ?? '-' }}</td></div>
                                        <div class="riwayat-buku-penulis">{{ $detail->buku->penulis ?? '-' }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Tanggal (jika sudah diproses) --}}
                        @if ($item->tanggal_pinjam && $item->tanggal_pinjam !== '-')
                            <div class="tanggal-strip">
                                <span><i class="fas fa-calendar-alt"></i> <strong>Pinjam:</strong> {{ $item->tanggal_pinjam }}</span>
                                <span><i class="fas fa-calendar-check"></i> <strong>Batas kembali:</strong> {{ $item->tanggal_kembali }}</span>
                                @if ($item->denda && $item->denda > 0)
                                    <span style="color:#dc2626;"><i class="fas fa-money-bill-wave" style="color:#dc2626;"></i> <strong>Denda:</strong> {{ $item->denda }}</span>
                                @endif
                            </div>
                        @endif

                        {{-- Info kode jika dipinjam --}}
                        @if ($item->status == 2)
                            <div class="info-bar" style="margin:12px 0 0;">
                                <i class="fas fa-barcode"></i>
                                Tunjukkan kode <strong>{{ $item->kode_pinjam }}</strong> kepada petugas saat mengambil buku.
                            </div>
                        @endif

                        {{-- Alasan ditolak --}}
                        @if ($item->status == 4)
                            <div class="alasan-tolak-box">
                                <i class="fas fa-exclamation-circle" style="margin-top:2px;flex-shrink:0;"></i>
                                <div>
                                    <strong>Pengajuan ditolak oleh admin.</strong><br>
                                    @if (!empty($item->alasan_tolak))
                                        Alasan: {{ $item->alasan_tolak }}
                                    @else
                                        Hubungi petugas perpustakaan untuk informasi lebih lanjut.
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</div>

{{-- Modal kosongkan keranjang --}}
@if ($showKosongkanModal)
    <div class="modal-overlay" wire:click.self="tutupKosongkanModal">
        <div class="modal-box">
            <div class="modal-head">
                <div class="modal-head-icon"><i class="fas fa-trash-alt"></i></div>
                <h3>Kosongkan Keranjang?</h3>
            </div>
            <div class="modal-body">
                Semua buku yang ada di keranjang akan dihapus. Tindakan ini tidak bisa dibatalkan.
            </div>
            <div class="modal-foot">
                <button class="modal-btn-batal" wire:click="tutupKosongkanModal">
                    <i class="fas fa-arrow-left"></i> Batal
                </button>
                <button class="modal-btn-hapus" wire:click="hapusMasal">
                    <i class="fas fa-trash-alt"></i> Ya, Kosongkan
                </button>
            </div>
        </div>
    </div>
@endif


<script>
    // Tab switcher
    function switchTab(tab) {
        document.getElementById('panel-keranjang').style.display = tab === 'keranjang' ? 'block' : 'none';
        document.getElementById('panel-riwayat').style.display   = tab === 'riwayat'   ? 'block' : 'none';
        document.getElementById('tab-keranjang').classList.toggle('active', tab === 'keranjang');
        document.getElementById('tab-riwayat').classList.toggle('active',   tab === 'riwayat');
        // Simpan ke sessionStorage supaya tidak reset saat Livewire re-render
        sessionStorage.setItem('krTab', tab);
    }

    // Toggle expand riwayat detail
    function toggleRiwayat(panelId, iconId) {
        const panel = document.getElementById(panelId);
        const icon  = document.getElementById(iconId);

        const open = panel.style.display === 'none' || panel.style.display === '';

        panel.style.display = open ? 'block' : 'none';

        icon.classList.toggle('open', open);
    }

    // Restore tab aktif setelah Livewire re-render
    function restoreTab() {
        const saved = sessionStorage.getItem('krTab');

        if (saved) {
            switchTab(saved);
        }

        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');

        if (tab === 'riwayat') {
            switchTab('riwayat');
        }
    }

    document.addEventListener('livewire:load', function () {
        restoreTab();

        Livewire.hook('message.processed', function () {
            restoreTab();
        });
    });
</script>
