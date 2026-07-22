<div>
<style>
    .transaksi-wrap { font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif; }
    :root {
        --navy: #1a2e6f; --accent: #2563eb; --light: #f0f4ff;
        --gray-50: #f8fafc; --gray-100: #f1f5f9; --gray-200: #e2e8f0;
        --gray-400: #94a3b8; --gray-600: #475569; --gray-800: #1e293b;
    }

    .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px; }
    .tab-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 16px; border-radius: 8px;
        font-family: inherit; font-size: 13px; font-weight: 600;
        cursor: pointer; border: 1.5px solid transparent; transition: all .2s;
    }
    .tab-btn.default  { background: var(--gray-100); color: var(--gray-800); border-color: var(--gray-200); }
    .tab-btn.default:hover  { background: var(--gray-200); }
    .tab-btn.menunggu { background: #fef3c7; color: #d97706; border-color: #fde68a; }
    .tab-btn.menunggu:hover { background: #fde68a; }
    .tab-btn.dipinjam { background: #eff6ff; color: var(--accent); border-color: #bfdbfe; }
    .tab-btn.dipinjam:hover { background: #dbeafe; }
    .tab-btn.selesai  { background: #f0fdf4; color: #15803d; border-color: #bbf7d0; }
    .tab-btn.selesai:hover  { background: #dcfce7; }

    .transaksi-search {
        display: flex; align-items: center;
        background: white; border: 1.5px solid var(--gray-200);
        border-radius: 10px; padding: 9px 14px; gap: 8px;
        margin-bottom: 20px; max-width: 320px;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
    }
    .transaksi-search:focus-within { border-color: var(--accent); }
    .transaksi-search i { color: var(--gray-400); font-size: 14px; }
    .transaksi-search input {
        border: none; outline: none; font-family: inherit;
        font-size: 13.5px; color: var(--gray-800); background: transparent; flex: 1;
    }

    .flash-sukses {
        background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d;
        border-radius: 10px; padding: 12px 16px; margin-bottom: 16px;
        font-size: 13.5px; display: flex; align-items: center; gap: 8px;
    }
    .flash-gagal {
        background: #fef2f2; border: 1px solid #fecaca; color: #dc2626;
        border-radius: 10px; padding: 12px 16px; margin-bottom: 16px;
        font-size: 13.5px; display: flex; align-items: center; gap: 8px;
    }

    .permintaan-card {
        background: white; border-radius: 16px;
        border: 1px solid rgba(30,64,175,.09);
        box-shadow: 0 2px 10px rgba(30,64,175,.07);
        margin-bottom: 16px; overflow: hidden;
    }
    .permintaan-header {
        display: grid;
        grid-template-columns: 32px 1fr auto auto auto auto;
        align-items: center; gap: 16px;
        padding: 16px 20px; cursor: pointer; transition: background .15s;
    }
    .permintaan-header:hover { background: var(--gray-50); }

    .no-badge {
        width: 28px; height: 28px; border-radius: 50%;
        background: var(--light); color: var(--accent);
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 700; flex-shrink: 0;
    }
    .peminjam-info .nama { font-size: 14px; font-weight: 700; color: var(--gray-800); }
    .peminjam-info .sub  { font-size: 12px; color: var(--gray-400); margin-top: 2px; }
    .kode-pinjam {
        font-size: 12.5px; font-weight: 700; color: var(--navy);
        background: var(--light); padding: 4px 10px; border-radius: 6px;
    }
    .tanggal-info { font-size: 12px; color: var(--gray-600); text-align: right; }

    .status-pill { font-size: 11.5px; font-weight: 700; padding: 4px 12px; border-radius: 99px; white-space: nowrap; }
    .pill-menunggu { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .pill-dipinjam { background: #eff6ff; color: var(--accent); border: 1px solid #bfdbfe; }
    .pill-selesai  { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .pill-ditolak  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    .expand-icon { color: var(--gray-400); font-size: 13px; transition: transform .2s; }
    .expand-icon.open { transform: rotate(180deg); }

    .permintaan-detail {
        border-top: 1px solid var(--gray-100);
        padding: 16px 20px; background: var(--gray-50);
    }
    .detail-title {
        font-size: 12px; font-weight: 700; color: var(--gray-600);
        text-transform: uppercase; letter-spacing: .05em; margin-bottom: 12px;
    }
    .detail-table {
        width: 100%; border-collapse: collapse;
        background: white; border-radius: 10px; overflow: hidden;
        border: 1px solid var(--gray-200); margin-bottom: 16px;
    }
    .detail-table thead tr { background: var(--gray-50); }
    .detail-table thead th {
        padding: 10px 14px; font-size: 11.5px; font-weight: 700;
        color: var(--gray-600); text-transform: uppercase;
        letter-spacing: .04em; text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }
    .detail-table tbody tr { border-bottom: 1px solid var(--gray-100); }
    .detail-table tbody tr:last-child { border-bottom: none; }
    .detail-table td { padding: 11px 14px; font-size: 13px; color: var(--gray-800); vertical-align: middle; }
    .stok-num {
        display: inline-flex; align-items: center; justify-content: center;
        width: 28px; height: 28px; border-radius: 50%;
        background: #f0fdf4; color: #15803d;
        font-size: 12px; font-weight: 700; border: 1px solid #bbf7d0;
    }

    /* ── ACTION BUTTONS — PERBAIKAN MASALAH 1 ── */
    /* Semua tombol aksi memakai wire:click, BUKAN onclick + form */
    .detail-actions { display: flex; gap: 10px; justify-content: flex-end; flex-wrap: wrap; }

    .btn-setuju {
        display: inline-flex; align-items: center; gap: 7px;
        background: #1a2e6f; color: white; border: none;
        border-radius: 8px; padding: 10px 20px;
        font-family: inherit; font-size: 13.5px; font-weight: 700;
        cursor: pointer; transition: all .2s;
        box-shadow: 0 3px 12px rgba(26,46,111,.2);
    }
    .btn-setuju:hover { background: var(--accent); }

    .btn-tolak {
        display: inline-flex; align-items: center; gap: 7px;
        background: #fef2f2; color: #dc2626;
        border: 1.5px solid #fecaca; border-radius: 8px;
        padding: 10px 20px; font-family: inherit;
        font-size: 13.5px; font-weight: 700; cursor: pointer; transition: all .2s;
    }
    .btn-tolak:hover { background: #fee2e2; }

    .btn-kembali-proc {
        display: inline-flex; align-items: center; gap: 7px;
        background: #f0fdf4; color: #15803d;
        border: 1.5px solid #bbf7d0; border-radius: 8px;
        padding: 10px 20px; font-family: inherit;
        font-size: 13.5px; font-weight: 700; cursor: pointer; transition: all .2s;
    }
    .btn-kembali-proc:hover { background: #dcfce7; }
    .tab-btn.ditolak {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.tab-btn.ditolak:hover {
    background: #fee2e2;
}
    /* Modal konfirmasi */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,.45);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999;
    }
    .modal-box {
        background: white; border-radius: 16px; padding: 28px 32px;
        max-width: 420px; width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,.2);
        text-align: center;
    }
    .modal-icon { font-size: 40px; margin-bottom: 14px; }
    .modal-title { font-size: 17px; font-weight: 700; color: #1e293b; margin-bottom: 8px; }
    .modal-sub   { font-size: 13.5px; color: #64748b; margin-bottom: 24px; line-height: 1.6; }
    .modal-actions { display: flex; gap: 10px; justify-content: center; }
    .modal-btn-cancel {
        padding: 9px 22px; border-radius: 8px; border: 1.5px solid #e2e8f0;
        background: #f8fafc; color: #475569; font-family: inherit;
        font-size: 13.5px; font-weight: 600; cursor: pointer;
    }
    .modal-btn-ok {
        padding: 9px 22px; border-radius: 8px; border: none;
        font-family: inherit; font-size: 13.5px; font-weight: 700; cursor: pointer; color: white;
    }
    .modal-btn-ok.ok-setuju  { background: #1a2e6f; }
    .modal-btn-ok.ok-tolak   { background: #dc2626; }
    .modal-btn-ok.ok-kembali { background: #15803d; }

    .empty-state {
        text-align: center; padding: 48px;
        background: white; border-radius: 16px; border: 1px solid var(--gray-100);
    }
    .empty-state i { font-size: 48px; color: #bfdbfe; margin-bottom: 14px; }
    .empty-state h3 { font-size: 16px; font-weight: 700; color: var(--gray-800); margin-bottom: 6px; }
    .empty-state p  { font-size: 13.5px; color: var(--gray-400); }
</style>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="transaksi-wrap">

    @if (session('sukses'))
        <div class="flash-sukses"><i class="fas fa-check-circle"></i> {{ session('sukses') }}</div>
    @endif
    @if (session('gagal'))
        <div class="flash-gagal"><i class="fas fa-exclamation-circle"></i> {{ session('gagal') }}</div>
    @endif

    {{-- Filter Tabs --}}
    <div class="filter-tabs">
    <button wire:click="format" class="tab-btn default">
        <i class="fas fa-list"></i> Semua
    </button>

    <button wire:click="menungguPersetujuan" class="tab-btn menunggu">
    <i class="fas fa-clock"></i> Diajukan
    </button>

    <button wire:click="sedangDipinjam" class="tab-btn dipinjam">
        <i class="fas fa-book-reader"></i> Sedang Dipinjam
    </button>

    <button wire:click="selesaiDipinjam" class="tab-btn selesai">
        <i class="fas fa-check-circle"></i> Selesai
    </button>

    <button wire:click="ditolakPeminjaman" class="tab-btn ditolak">
        <i class="fas fa-times-circle"></i> Ditolak
    </button>
</div>

    {{-- Search --}}
    <div class="transaksi-search">
        <i class="fas fa-search"></i>
        <input wire:model="search" type="text" placeholder="Cari kode peminjaman...">
    </div>

    {{-- List --}}
    @if ($transaksi->isNotEmpty())

        <p style="font-size:12.5px;color:#94a3b8;margin-bottom:14px;">
            {{ $transaksi->total() }} pengajuan ditemukan
        </p>

        @foreach ($transaksi as $item)
            <div class="permintaan-card">

                {{-- Header --}}
                <div class="permintaan-header"
                     onclick="toggleDetail('detail-{{ $item->id }}', 'icon-{{ $item->id }}')">

                    <div class="no-badge">{{ $loop->iteration }}</div>

                    <div class="peminjam-info">
                    <div class="nama">{{ $item->nama_peminjam ?? '(Akun dihapus)' }}</div>
                    <div class="sub">{{ $item->sub_peminjam ?? '-' }}</div>
                    </div>

                    <div class="kode-pinjam">{{ $item->kode_pinjam }}</div>

                    <div class="tanggal-info">
                        {{ $item->created_at->format('d M Y') }}<br>
                        <span style="color:#94a3b8;">{{ $item->created_at->format('H:i') }} WIB</span>
                    </div>

                    <div>
                    @if ($item->status == 1)
                    <span class="status-pill pill-menunggu">Diajukan</span>

@elseif ($item->status == 2)
    <span class="status-pill pill-dipinjam">Dipinjam</span>

@elseif ($item->status == 3)
    <span class="status-pill pill-selesai">Selesai</span>

@elseif ($item->status == 4)
    <span class="status-pill pill-ditolak">Ditolak</span>
@endif
                    </div>

                    <i class="fas fa-chevron-down expand-icon" id="icon-{{ $item->id }}"></i>
                </div>

                {{-- Detail --}}
                <div class="permintaan-detail" id="detail-{{ $item->id }}" style="display:none;">
                    <div class="detail-title">Detail Buku</div>

                    <table class="detail-table">
                        <thead>
                            <tr>
                                <th>No</th><th>Buku</th><th>Penulis</th>
                                <th>Rak</th><th>Baris</th><th>Stok Saat Ini</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($item->detail_peminjaman as $detail)
    @if($detail->buku)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $detail->buku->judul ?? '-' }}</td>
        <td>{{ $detail->buku->penulis ?? '-' }}</td>
        <td>{{ $detail->buku->rak->rak ?? '-' }}</td>
        <td>{{ $detail->buku->rak->baris ?? '-' }}</td>
        <td><span class="stok-num">{{ $detail->buku->stok ?? 0 }}</span></td>
    </tr>
    @endif
@endforeach
                        </tbody>
                    </table>

                    @if ($item->tanggal_pinjam && $item->tanggal_pinjam !== '-')
                        <div style="font-size:13px;color:#475569;margin-bottom:14px;display:flex;gap:20px;flex-wrap:wrap;">
                            <span><i class="fas fa-calendar-alt" style="color:#2563eb;"></i>
                                <strong>Tgl Pinjam:</strong> {{ $item->tanggal_pinjam }}</span>
                            <span><i class="fas fa-calendar-check" style="color:#2563eb;"></i>
                                <strong>Tgl Kembali:</strong> {{ $item->tanggal_kembali }}</span>
                            @if($item->denda && $item->denda !== '-')
                                <span><i class="fas fa-money-bill" style="color:#dc2626;"></i>
                                    <strong>Denda:</strong> {{ $item->denda }}</span>
                            @endif
                        </div>
                    @endif

                    {{--
                    ================================================================
                    PERBAIKAN MASALAH 1 — Tombol aksi menggunakan wire:click
                    ================================================================
                    Sebelumnya memakai: onclick="return confirm('...')" dengan form submit
                    → blade me-render teks javascript mentah bukan tombol interaktif

                    Sekarang memakai wire:click + modal konfirmasi Livewire-friendly
                    ================================================================
                    --}}
                    <div class="detail-actions">
                        @if ($item->status == 1)
                            {{-- Tombol Tolak (kembali ke status 0 / hapus) --}}
                            <button onclick="bukaModal('tolak', {{ $item->id }}, '{{ addslashes($item->kode_pinjam) }}')"
                                    class="btn-tolak">
                                <i class="fas fa-times"></i> Tolak Peminjaman
                            </button>
                            {{-- Tombol Setujui --}}
                            <button onclick="bukaModal('setuju', {{ $item->id }}, '{{ addslashes($item->kode_pinjam) }}')"
                                    class="btn-setuju">
                                <i class="fas fa-check"></i> Setujui Peminjaman
                            </button>

                        @elseif ($item->status == 2)
                            {{-- Tombol Proses Pengembalian --}}
                            <button onclick="bukaModal('kembali', {{ $item->id }}, '{{ addslashes($item->kode_pinjam) }}')"
                                    class="btn-kembali-proc">
                                <i class="fas fa-undo"></i> Proses Pengembalian
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <div style="display:flex;justify-content:center;margin-top:20px;">
            {{ $transaksi->links() }}
        </div>

    @else
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Tidak ada data transaksi</h3>
            <p>Belum ada permintaan peminjaman yang masuk.</p>
        </div>
    @endif

</div>

{{-- ── MODAL KONFIRMASI ── --}}
<div class="modal-overlay" id="modalOverlay" style="display:none;">
    <div class="modal-box">
        <div class="modal-icon" id="modalIcon"></div>
        <div class="modal-title" id="modalTitle"></div>
        <div class="modal-sub" id="modalSub"></div>
        <textarea
    id="alasanTolakInput"
    wire:model.defer="alasan_tolak"
    placeholder="Masukkan alasan penolakan..."
    style="
        width:100%;
        min-height:90px;
        border:1px solid #e2e8f0;
        border-radius:10px;
        padding:12px;
        font-size:13px;
        margin-bottom:18px;
        resize:none;
        display:none;
    "
></textarea>
        <div class="modal-actions">
            <button class="modal-btn-cancel" onclick="tutupModal()">Batal</button>
            <button class="modal-btn-ok" id="modalOkBtn" onclick="konfirmasi()"></button>
        </div>
    </div>
</div>

<script>
    var _modalAksi = null;
    var _modalId   = null;

    function bukaModal(aksi, id, kode) {
        _modalAksi = aksi;
        _modalId   = id;
        var icon  = document.getElementById('modalIcon');
        var title = document.getElementById('modalTitle');
        var sub   = document.getElementById('modalSub');
        var btn   = document.getElementById('modalOkBtn');
        var alasan = document.getElementById('alasanTolakInput');

        if (aksi === 'setuju') {
            icon.innerHTML  = '✅';
            title.innerText = 'Setujui Peminjaman?';
            sub.innerText   = 'Peminjaman kode ' + kode + ' akan disetujui. Stok buku akan berkurang secara otomatis.';
            btn.innerText   = 'Ya, Setujui';
            btn.className   = 'modal-btn-ok ok-setuju';
            alasan.style.display = 'none';
        } else if (aksi === 'tolak') {
            icon.innerHTML  = '❌';
            title.innerText = 'Tolak Peminjaman?';
            sub.innerText   = 'Peminjaman kode ' + kode + ' akan ditolak dan dihapus dari antrian.';
            btn.innerText   = 'Ya, Tolak';
            btn.className   = 'modal-btn-ok ok-tolak';
            alasan.style.display = 'block';
        } else if (aksi === 'kembali') {
            icon.innerHTML  = '📚';
            title.innerText = 'Proses Pengembalian?';
            sub.innerText   = 'Buku dengan kode ' + kode + ' akan ditandai dikembalikan. Stok akan bertambah kembali.';
            btn.innerText   = 'Ya, Kembalikan';
            btn.className   = 'modal-btn-ok ok-kembali';
            alasan.style.display = 'none';
        }

        document.getElementById('modalOverlay').style.display = 'flex';
    }

    function tutupModal() {
        document.getElementById('modalOverlay').style.display = 'none';
        _modalAksi = null;
        _modalId   = null;
    }

    function konfirmasi() {

if (!_modalAksi || !_modalId) return;

let aksi = _modalAksi;
let id   = _modalId;

tutupModal();

if (aksi === 'setuju') {
    Livewire.emit('callSetuju', id);
} else if (aksi === 'tolak') {
   Livewire.emit('callTolak', id);
} else if (aksi === 'kembali') {
    Livewire.emit('callKembali', id);
}
}

    function toggleDetail(detailId, iconId) {
        var detail = document.getElementById(detailId);
        var icon   = document.getElementById(iconId);
        if (detail.style.display === 'none') {
            detail.style.display = 'block';
            icon.classList.add('open');
        } else {
            detail.style.display = 'none';
            icon.classList.remove('open');
        }
    }
</script>
</div>