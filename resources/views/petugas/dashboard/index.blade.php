@extends('admin-lte/app')
@section('title', 'Dashboard')
@section('active-dashboard', 'active')

@section('content')

<style>
/* ===== DASHBOARD MODERN ===== */
* { font-family: 'Poppins', sans-serif; }

/* Page header */
.dash-page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.dash-page-header .page-title-wrap h4 {
    font-size: 22px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.dash-page-header .page-title-wrap p {
    font-size: 13px;
    color: #94a3b8;
    margin: 2px 0 0;
}

.dash-date-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 500;
    color: #475569;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}

.dash-date-badge i {
    color: #1e40af;
    font-size: 14px;
}

/* ===== STAT CARDS ===== */
.stat-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px 22px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.09);
}

.stat-card .stat-left .stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1;
    margin-bottom: 6px;
}

.stat-card .stat-left .stat-label {
    font-size: 13px;
    color: #64748b;
    font-weight: 500;
    margin-bottom: 10px;
}

.stat-card .stat-left .stat-sub {
    font-size: 12px;
    color: #22c55e;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}

.stat-card .stat-left .stat-sub.down {
    color: #ef4444;
}

.stat-card .stat-left .stat-sub i {
    font-size: 10px;
}

.stat-icon-wrap {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-icon-wrap i {
    font-size: 22px;
    color: #ffffff;
}

.icon-blue   { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
.icon-teal   { background: linear-gradient(135deg, #06b6d4, #0284c7); }
.icon-green  { background: linear-gradient(135deg, #22c55e, #16a34a); }
.icon-orange { background: linear-gradient(135deg, #f97316, #ea580c); }

/* ===== CHART CARD ===== */
.chart-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    overflow: hidden;
}

.chart-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px 0;
}

.chart-card-header h5 {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.chart-period-btn {
    background: #f1f5f9;
    border: none;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 12px;
    font-weight: 500;
    color: #475569;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background 0.2s;
}

.chart-period-btn:hover { background: #e2e8f0; }

.chart-card-body {
    padding: 12px 16px 16px;
}

/* Chart summary row */
.chart-summary {
    display: flex;
    gap: 0;
    border-top: 1px solid #f1f5f9;
    margin-top: 4px;
}

.chart-summary-item {
    flex: 1;
    padding: 16px 22px;
    border-right: 1px solid #f1f5f9;
}

.chart-summary-item:last-child { border-right: none; }

.chart-summary-item .cs-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #eff6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
}

.chart-summary-item .cs-icon i {
    color: #1e40af;
    font-size: 13px;
}

.chart-summary-item .cs-value {
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1;
}

.chart-summary-item .cs-value.highlight {
    color: #1e40af;
}

.chart-summary-item .cs-label {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 3px;
}

/* ===== RECENT BORROWING CARD ===== */
.recent-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    overflow: hidden;
    height: 100%;
}

.recent-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px 14px;
    border-bottom: 1px solid #f8fafc;
}

.recent-card-header h5 {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.recent-card-header a {
    font-size: 12px;
    color: #1e40af;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.2s;
}

.recent-card-header a:hover { opacity: 0.7; }

/* Borrowing list item */
.borrow-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 22px;
    border-bottom: 1px solid #f8fafc;
    transition: background 0.15s;
}

.borrow-item:last-child { border-bottom: none; }
.borrow-item:hover { background: #f8fafc; }

.borrow-item .bi-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    background: #e2e8f0;
    border: 2px solid #f1f5f9;
}

.borrow-item .bi-info {
    flex: 1;
    min-width: 0;
}

.borrow-item .bi-info .bi-name {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.borrow-item .bi-info .bi-book {
    font-size: 11.5px;
    color: #94a3b8;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.borrow-item .bi-right {
    text-align: right;
    flex-shrink: 0;
}

.borrow-item .bi-right .bi-date {
    font-size: 11px;
    color: #cbd5e1;
    display: block;
    margin-bottom: 4px;
}

.badge-pinjam {
    background: #dbeafe;
    color: #1d4ed8;
    font-size: 10.5px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
}

.badge-terlambat {
    background: #fef3c7;
    color: #b45309;
    font-size: 10.5px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
}

.badge-selesai {
    background: #dcfce7;
    color: #15803d;
    font-size: 10.5px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 20px;
}

/* Empty state */
.empty-recent {
    padding: 32px 22px;
    text-align: center;
    color: #cbd5e1;
    font-size: 13px;
}

.empty-recent i {
    font-size: 32px;
    margin-bottom: 8px;
    display: block;
}
</style>

<!-- Page Header -->
<div class="dash-page-header">
    <div class="page-title-wrap">
        <h4>Dashboard</h4>
        <p>Ringkasan informasi perpustakaan hari ini.</p>
    </div>
    <div class="dash-date-badge">
        <i class="far fa-calendar-alt"></i>
        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6 col-6">
        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-number">{{ $count_buku }}</div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-sub">
                    <i class="fas fa-arrow-up"></i> Koleksi aktif
                </div>
            </div>
            <div class="stat-icon-wrap icon-blue">
                <i class="fas fa-book-open"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-number">{{ $count_user }}</div>
                <div class="stat-label">Total Peminjam</div>
                <div class="stat-sub">
                    <i class="fas fa-arrow-up"></i> Terdaftar
                </div>
            </div>
            <div class="stat-icon-wrap icon-teal">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-number">{{ $count_selesai_dipinjam }}</div>
                <div class="stat-label">Selesai Dipinjam</div>
                <div class="stat-sub">
                    <i class="fas fa-arrow-up"></i> Sudah dikembalikan
                </div>
            </div>
            <div class="stat-icon-wrap icon-green">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-6">
        <div class="stat-card">
            <div class="stat-left">
                <div class="stat-number">{{ $count_sedang_dipinjam }}</div>
                <div class="stat-label">Sedang Dipinjam</div>
                <div class="stat-sub down">
                    <i class="fas fa-clock"></i> Belum dikembalikan
                </div>
            </div>
            <div class="stat-icon-wrap icon-orange">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
</div>

<!-- Chart + Recent Borrowing -->
<div class="row g-3 mb-4">

    <!-- Chart -->
    <div class="col-lg-8">
    <div class="chart-card">
        <div class="chart-card-header">
            <h5>Statistik Peminjaman</h5>

            <a href="/chart" class="chart-period-btn text-decoration-none">
                6 Bulan Terakhir
                <i class="fas fa-chevron-right" style="font-size:10px;"></i>
            </a>

        </div>
            <div class="chart-card-body">
                <canvas id="myChart" height="110"></canvas>
            </div>
            <div class="chart-summary">
                <div class="chart-summary-item">
                    <div class="cs-icon"><i class="fas fa-book"></i></div>
                    <div class="cs-value">{{ $count_selesai_dipinjam }}</div>
                    <div class="cs-label">Total Peminjaman</div>
                </div>
                <div class="chart-summary-item">
                    <div class="cs-icon"><i class="far fa-calendar"></i></div>
                    <div class="cs-value">{{ $count_user > 0 ? round($count_selesai_dipinjam / max(1, 6)) : 0 }}</div>
                    <div class="cs-label">Rata-rata / Bulan</div>
                </div>
                <div class="chart-summary-item">
                    <div class="cs-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="cs-value highlight">{{ \Carbon\Carbon::now()->translatedFormat('M Y') }}</div>
                    <div class="cs-label">Periode Aktif</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Borrowing -->
    <div class="col-lg-4">
        <div class="recent-card">
            <div class="recent-card-header">
                <h5>Peminjaman Terbaru</h5>
                <a href="/transaksi">&rsaquo; Lihat Semua</a>
            </div>

            @forelse ($sedang_dipinjam->take(5) as $item)
            <div class="borrow-item">
                <img class="bi-avatar"
                     src="/adminlte/dist/img/user2-160x160.jpg"
                     alt="User">
                <div class="bi-info">
                    <div class="bi-name">
                        {{ $item->nama_peminjam ?? 'Peminjam' }}
                    </div>
                    <div class="bi-book">
                        {{ $item->buku->judul ?? $item->kode_pinjam }}
                    </div>
                </div>
                <div class="bi-right">
                    <span class="bi-date">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</span>
                    @if(isset($item->status) && $item->status == 'terlambat')
                        <span class="badge-terlambat">Terlambat</span>
                    @else
                        <span class="badge-pinjam">Dipinjam</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-recent">
                <i class="fas fa-inbox"></i>
                Belum ada peminjaman aktif
            </div>
            @endforelse

            @forelse ($selesai_dipinjam->take(3) as $item)
            <div class="borrow-item">
                <img class="bi-avatar"
                     src="/adminlte/dist/img/user2-160x160.jpg"
                     alt="User">
                <div class="bi-info">
                    <div class="bi-name">
                        {{ $item->nama_peminjam ?? 'Peminjam' }}
                    </div>
                    <div class="bi-book">
                        {{ $item->buku->judul ?? $item->kode_pinjam }}
                    </div>
                </div>
                <div class="bi-right">
                    <span class="bi-date">{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') }}</span>
                    <span class="badge-selesai">Selesai</span>
                </div>
            </div>
            @empty
            @endforelse

        </div>
    </div>
</div>

<!-- Bottom Tables -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="recent-card">
            <div class="recent-card-header">
                <h5>Buku Terbaru</h5>
                <a href="/buku">&rsaquo; Lihat Semua</a>
            </div>
            <div style="padding: 0 4px 4px;">
                <table class="table table-hover mb-0" style="font-size:13px;">
                    <thead>
                        <tr style="background:#f8fafc;">
                            <th style="padding:10px 18px; color:#64748b; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; border:none;">#</th>
                            <th style="padding:10px 8px; color:#64748b; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; border:none;">Judul</th>
                            <th style="padding:10px 18px; color:#64748b; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; border:none;">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)
                        <tr>
                            <td style="padding:10px 18px; color:#94a3b8; border-top:1px solid #f8fafc;">{{ $loop->iteration }}</td>
                            <td style="padding:10px 8px; color:#1e293b; font-weight:500; border-top:1px solid #f8fafc;">{{ $item->judul }}</td>
                            <td style="padding:10px 18px; color:#94a3b8; font-size:12px; border-top:1px solid #f8fafc;">{{ $item->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="recent-card">
            <div class="recent-card-header">
                <h5>User Terbaru</h5>
                <a href="/user">&rsaquo; Lihat Semua</a>
            </div>
            <div style="padding: 0 4px 4px;">
                <table class="table table-hover mb-0" style="font-size:13px;">
                    <thead>
                        <tr style="background:#f8fafc;">
                            <th style="padding:10px 18px; color:#64748b; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; border:none;">#</th>
                            <th style="padding:10px 8px; color:#64748b; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; border:none;">Nama</th>
                            <th style="padding:10px 18px; color:#64748b; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.5px; border:none;">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td style="padding:10px 18px; color:#94a3b8; border-top:1px solid #f8fafc;">{{ $loop->iteration }}</td>
                            <td style="padding:10px 8px; color:#1e293b; font-weight:500; border-top:1px solid #f8fafc;">{{ $item->name }}</td>
                            <td style="padding:10px 18px; color:#94a3b8; font-size:12px; border-top:1px solid #f8fafc;">{{ $item->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @include('admin-lte/script/chart')
@endsection

@section('chart-script')
    <livewire:petugas.chart-script></livewire:petugas.chart-script>
@endsection
