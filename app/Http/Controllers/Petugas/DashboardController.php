<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $count_buku             = Buku::count();
        $count_user             = Anggota::count();
        $count_sedang_dipinjam  = Peminjaman::where('status', 2)->count();
        $count_selesai_dipinjam = Peminjaman::where('status', 3)->count();
        $count_menunggu         = Peminjaman::where('status', 1)->count();

        $sedang_dipinjam = Peminjaman::with(['detail_peminjaman.buku', 'anggota', 'user'])
            ->where('status', 2)->latest()->limit(5)->get()
            ->map(fn($p) => $this->withNamaPeminjam($p));

        $selesai_dipinjam = Peminjaman::with(['detail_peminjaman.buku', 'anggota', 'user'])
            ->where('status', 3)->latest()->limit(5)->get()
            ->map(fn($p) => $this->withNamaPeminjam($p));

        $buku            = Buku::latest()->limit(5)->get();
        $anggota_terbaru = Anggota::latest()->limit(5)->get();
        $user            = User::latest()->limit(5)->get();

        return view('petugas/dashboard/index', compact(
            'count_buku', 'count_user',
            'count_sedang_dipinjam', 'count_selesai_dipinjam', 'count_menunggu',
            'buku', 'anggota_terbaru',
            'sedang_dipinjam', 'selesai_dipinjam',
            'user'
        ));
    }

    private function withNamaPeminjam(Peminjaman $p): Peminjaman
    {
        if ($p->anggota) {
            $p->nama_peminjam = $p->anggota->nama;
            $p->sub_peminjam  = $p->anggota->label_jenis . ' · ' . $p->anggota->kode_anggota;
        } elseif ($p->user) {
            $p->nama_peminjam = $p->user->name;
            $p->sub_peminjam  = $p->user->email;
        } else {
            $p->nama_peminjam = 'Anggota #' . $p->peminjam_id;
            $p->sub_peminjam  = $p->kode_pinjam;
        }
        return $p;
    }
}