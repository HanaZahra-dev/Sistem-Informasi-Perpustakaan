<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardPeminjamController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ── PERBAIKAN ──
        // Bug lama: $dipinjam pakai where('status', 1) padahal status 1 = Menunggu verifikasi.
        // Status 2 = benar-benar sedang dipinjam (sudah disetujui admin).
        // Akibat bug: "Daftar Pinjaman Aktif" di dashboard selalu kosong meski ada peminjaman aktif.
        $dipinjam = Peminjaman::with(['detail_peminjaman.buku'])
            ->where('peminjam_id', $user->id)
            ->where('status', 2)
            ->get();

        // Selesai (status 3 = dikembalikan)
        $selesai = Peminjaman::where('peminjam_id', $user->id)
            ->where('status', 3)
            ->count();

        // Keranjang aktif (status 0 = draft belum diajukan)
        $keranjang = Peminjaman::with(['detail_peminjaman.buku'])
            ->where('peminjam_id', $user->id)
            ->where('status', 0)
            ->first();

        $jumlahKeranjang = $keranjang ? $keranjang->detail_peminjaman->count() : 0;

        // Total semua peminjaman yang pernah diajukan (status != 0)
        $totalPeminjaman = Peminjaman::where('peminjam_id', $user->id)
            ->where('status', '!=', 0)
            ->count();

        return view('peminjam.dashboard.index', compact(
            'user',
            'dipinjam',
            'selesai',
            'jumlahKeranjang',
            'totalPeminjaman',
            'keranjang'
        ));
    }
}
