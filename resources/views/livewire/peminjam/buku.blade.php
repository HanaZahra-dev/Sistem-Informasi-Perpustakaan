<div>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .kb-wrap * { box-sizing: border-box; }
    .kb-wrap { font-family: 'Poppins', sans-serif; }

    /* ── FLASH ── */
    .flash-ok {
        background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d;
        border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
        font-size: 13px; display: flex; align-items: center; gap: 8px;
    }
    .flash-err {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
        font-size: 13px; display: flex; align-items: center; gap: 8px;
    }

    /* ── PAGE HEADER ── */
    .kb-header {
        display: flex; align-items: flex-start; justify-content: space-between;
        flex-wrap: wrap; gap: 16px;
        margin-bottom: 28px;
    }
    .kb-header-left h2 {
        font-size: 1.5rem; font-weight: 700; color: #1e293b; margin-bottom: 4px;
    }
    .kb-header-left p { font-size: 13px; color: #64748b; }

    /* ── SEARCH ── */
    .kb-search {
        display: flex; align-items: center; gap: 10px;
        background: #fff; border: 1.5px solid #e2e8f0;
        border-radius: 10px; padding: 10px 16px;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        min-width: 260px; flex: 0 0 auto;
        transition: border .2s;
    }
    .kb-search:focus-within { border-color: #1e40af; }
    .kb-search i { color: #94a3b8; font-size: 14px; flex-shrink: 0; }
    .kb-search input {
        border: none; outline: none;
        font-family: 'Poppins', sans-serif;
        font-size: 13px; color: #1e293b; background: transparent; flex: 1;
    }
    .kb-search input::placeholder { color: #94a3b8; }

    /* ── GRID ── */
    .kb-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    /* ── BUKU CARD ── */
    .buku-card {
        background: #fff; border-radius: 16px;
        border: 1px solid rgba(30,64,175,.07);
        box-shadow: 0 2px 12px rgba(30,64,175,.06);
        overflow: hidden; cursor: pointer;
        transition: transform .22s, box-shadow .22s;
        display: flex; flex-direction: column;
    }
    .buku-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(30,64,175,.14);
    }

    .buku-cover-wrap {
        background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
        height: 190px;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden; position: relative;
    }
    .buku-cover-wrap img {
        width: 100%; height: 100%; object-fit: cover;
    }
    .buku-cover-icon {
        width: 80px; height: 80px;
    }

    .buku-card-body {
        padding: 14px 16px 16px;
        display: flex; flex-direction: column; gap: 6px; flex: 1;
    }
    .buku-judul {
        font-size: 14px; font-weight: 700; color: #1e293b;
        line-height: 1.35;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .buku-penulis { font-size: 12px; color: #64748b; }

    .buku-meta {
        display: flex; align-items: center; justify-content: space-between;
        margin-top: 4px;
    }
    .buku-stok {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11.5px; font-weight: 600;
        padding: 4px 10px; border-radius: 99px;
    }
    .stok-ada  { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .stok-abis { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    .buku-detail-btn {
        font-size: 11.5px; font-weight: 600; color: #1e40af;
        background: none; border: none; cursor: pointer;
        font-family: 'Poppins', sans-serif; padding: 0;
        display: flex; align-items: center; gap: 4px; transition: color .15s;
    }
    .buku-detail-btn:hover { color: #2563eb; }

    /* ── PAGINATION ── */
    .kb-pagination { display: flex; justify-content: center; }

    /* ── EMPTY ── */
    .kb-empty { text-align: center; padding: 60px 20px; }
    .kb-empty i { font-size: 52px; color: #bfdbfe; margin-bottom: 16px; display: block; }
    .kb-empty h3 { font-size: 17px; font-weight: 700; color: #1e293b; margin-bottom: 8px; }
    .kb-empty p  { font-size: 13px; color: #94a3b8; }

    /* ══════════════════════════════════════════
       DETAIL BUKU
    ══════════════════════════════════════════ */
    .detail-wrap {
        background: #fff; border-radius: 20px;
        border: 1px solid rgba(30,64,175,.08);
        box-shadow: 0 4px 24px rgba(30,64,175,.08);
        overflow: hidden;
    }

    .detail-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        padding: 28px 32px; display: flex; align-items: center; gap: 24px;
        flex-wrap: wrap;
    }
    .detail-cover {
        width: 110px; height: 144px;
        background: rgba(255,255,255,.15);
        border-radius: 12px; overflow: hidden;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        box-shadow: 0 6px 20px rgba(0,0,0,.2);
    }
    .detail-cover img { width: 100%; height: 100%; object-fit: cover; }
    .detail-cover i { font-size: 44px; color: rgba(255,255,255,.5); }

    .detail-hero-info { flex: 1; min-width: 0; }
    .detail-judul {
        font-size: 1.45rem; font-weight: 700; color: #fff;
        margin-bottom: 6px; line-height: 1.3;
    }
    .detail-penulis { font-size: 14px; color: rgba(255,255,255,.75); margin-bottom: 14px; }
    .detail-stok-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.18); color: #fff;
        border: 1px solid rgba(255,255,255,.3);
        border-radius: 99px; padding: 5px 14px;
        font-size: 12.5px; font-weight: 600;
    }

    .detail-body { padding: 28px 32px; }

    .detail-section-title {
        font-size: 11px; font-weight: 700; color: #64748b;
        text-transform: uppercase; letter-spacing: .07em;
        margin-bottom: 14px;
    }

    .detail-info-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 12px; margin-bottom: 28px;
    }
    .detail-info-item {
        background: #f8fafc; border-radius: 10px;
        border: 1px solid #f1f5f9;
        padding: 12px 14px;
    }
    .dii-label { font-size: 10.5px; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px; }
    .dii-value { font-size: 13.5px; font-weight: 600; color: #1e293b; }

    .detail-actions {
        display: flex; gap: 12px; flex-wrap: wrap; align-items: center;
        padding-top: 20px; border-top: 1px solid #f1f5f9;
    }

    .btn-tambah {
        display: inline-flex; align-items: center; gap: 8px;
        background: #1e3a8a; color: #fff; border: none;
        border-radius: 10px; padding: 11px 24px;
        font-family: 'Poppins', sans-serif; font-size: 13.5px; font-weight: 600;
        cursor: pointer; transition: all .2s;
        box-shadow: 0 4px 14px rgba(30,64,175,.25);
    }
    .btn-tambah:hover { background: #2563eb; transform: translateY(-1px); }
    .btn-tambah:disabled { opacity: .55; cursor: not-allowed; transform: none; }

    .btn-login {
        display: inline-flex; align-items: center; gap: 8px;
        background: #ef4444; color: #fff; border: none;
        border-radius: 10px; padding: 11px 24px;
        font-family: 'Poppins', sans-serif; font-size: 13.5px; font-weight: 600;
        text-decoration: none; transition: all .2s;
    }
    .btn-login:hover { background: #dc2626; color: #fff; }

    .btn-kembali {
        display: inline-flex; align-items: center; gap: 8px;
        background: #f1f5f9; color: #475569;
        border: 1.5px solid #e2e8f0; border-radius: 10px;
        padding: 10px 20px; font-family: 'Poppins', sans-serif;
        font-size: 13.5px; font-weight: 600; cursor: pointer;
        transition: all .2s;
    }
    .btn-kembali:hover { background: #e2e8f0; }
</style>

<div class="kb-wrap">

    {{-- Flash --}}
    @if (session('sukses'))
        <div class="flash-ok"><i class="fas fa-check-circle"></i> {{ session('sukses') }}</div>
    @endif
    @if (session('gagal'))
        <div class="flash-err"><i class="fas fa-exclamation-circle"></i> {{ session('gagal') }}</div>
    @endif

    {{-- ══════════════ DETAIL BUKU ══════════════ --}}
    @if ($detail_buku)

        <div class="detail-wrap">
            {{-- Hero --}}
            <div class="detail-hero">
                <div class="detail-cover">
                    @if ($buku->sampul ?? false)
                        <img src="/storage/{{ $buku->sampul }}" alt="{{ $buku->judul }}">
                    @else
                        <i class="fas fa-book"></i>
                    @endif
                </div>
                <div class="detail-hero-info">
                    <div class="detail-judul">{{ $buku->judul }}</div>
                    <div class="detail-penulis">{{ $buku->penulis }}</div>
                    <div class="detail-stok-badge">
                        @if ($buku->stok > 0)
                            <i class="fas fa-check-circle"></i> Tersedia · {{ $buku->stok }} buku
                        @else
                            <i class="fas fa-times-circle"></i> Stok Habis
                        @endif
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="detail-body">
                <div class="detail-section-title">Informasi Buku</div>
                <div class="detail-info-grid">
                    <div class="detail-info-item">
                        <div class="dii-label">Kategori</div>
                        <div class="dii-value">{{ $buku->kategori->nama ?? '-' }}</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="dii-label">Penerbit</div>
                        <div class="dii-value">{{ $buku->penerbit->nama ?? '-' }}</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="dii-label">Rak</div>
                        <div class="dii-value">{{ $buku->rak->rak ?? '-' }}</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="dii-label">Baris</div>
                        <div class="dii-value">{{ $buku->rak->baris ?? '-' }}</div>
                    </div>
                    <div class="detail-info-item">
                        <div class="dii-label">Stok</div>
                        <div class="dii-value">{{ $buku->stok }}</div>
                    </div>
                </div>

                <div class="detail-actions">
                    @auth
                        <button
                            wire:click="keranjang({{ $buku->id }})"
                            wire:loading.attr="disabled"
                            class="btn-tambah"
                            @if($buku->stok < 1) disabled @endif>
                            <i class="fas fa-shopping-cart"></i>
                            Tambah ke Keranjang
                        </button>
                    @else
                        <a href="/login" class="btn-login">
                            <i class="fas fa-sign-in-alt"></i> Login untuk Meminjam
                        </a>
                    @endauth

                    <button wire:click="$set('detail_buku', false)" class="btn-kembali">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </button>
                </div>
            </div>
        </div>

    {{-- ══════════════ LIST BUKU ══════════════ --}}
    @else

        {{-- Header + Search --}}
        <div class="kb-header">
            <div class="kb-header-left">
                <h2>{{ $title }}</h2>
                <p>Temukan berbagai koleksi buku dari beragam kategori</p>
            </div>
            <div class="kb-search">
                <i class="fas fa-search"></i>
                <input wire:model="search" type="text" placeholder="Cari buku...">
            </div>
        </div>

        {{-- Grid Buku --}}
        @if ($buku->count() > 0)
            <div class="kb-grid">
                @foreach ($buku as $item)
                    <div class="buku-card" wire:click="detailBuku({{ $item->id }})">
                        <div class="buku-cover-wrap">
                            @if ($item->sampul ?? false)
                                <img src="/storage/{{ $item->sampul }}" alt="{{ $item->judul }}">
                            @else
                                <img
                                    src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png"
                                    class="buku-cover-icon"
                                    alt="{{ $item->judul }}">
                            @endif
                        </div>
                        <div class="buku-card-body">
                            <div class="buku-judul">{{ $item->judul }}</div>
                            <div class="buku-penulis">{{ $item->penulis }}</div>
                            <div class="buku-meta">
                                @if ($item->stok > 0)
                                    <span class="buku-stok stok-ada">
                                        <i class="fas fa-book"></i> {{ $item->stok }} Buku
                                    </span>
                                @else
                                    <span class="buku-stok stok-abis">
                                        <i class="fas fa-times"></i> Habis
                                    </span>
                                @endif
                                <button class="buku-detail-btn">
                                    Detail <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="kb-pagination">
                {{ $buku->links() }}
            </div>

        @else
            <div class="kb-empty">
                <i class="fas fa-search"></i>
                <h3>Buku tidak ditemukan</h3>
                <p>Coba kata kunci lain atau pilih kategori yang berbeda.</p>
            </div>
        @endif

    @endif

</div>
