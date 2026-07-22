<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KonfirmasiController extends Controller
{
    public function index()
    {
        $identifikasi = session('peminjam_identifikasi');
        $keranjang    = session('keranjang_pinjam', []);

        $bukuIds  = array_column($keranjang, 'id');
        $listBuku = Buku::whereIn('id', $bukuIds)->get()->keyBy('id');

        return view('peminjam.konfirmasi.index', compact('identifikasi', 'keranjang', 'listBuku'));
    }

    public function ajukan(Request $request)
    {
        $identifikasi = session('peminjam_identifikasi');
        $keranjang    = session('keranjang_pinjam', []);

        if (!$identifikasi || empty($keranjang)) {
            return redirect()->route('pinjam.identifikasi')
                ->with('error', 'Sesi habis. Silakan mulai ulang proses peminjaman.');
        }

        if (empty($identifikasi['anggota_id'])) {
            return redirect()->route('pinjam.identifikasi')
                ->with('error', 'Data anggota tidak ditemukan. Silakan identifikasi ulang.');
        }

        $bukuIds  = array_column($keranjang, 'id');
        $listBuku = Buku::whereIn('id', $bukuIds)->get()->keyBy('id');

        foreach ($listBuku as $buku) {
            if ($buku->stok < 1) {
                return redirect()->route('pinjam.pilih-buku')
                    ->with('error', "Maaf, stok buku \"$buku->judul\" sudah habis. Silakan pilih buku lain.");
            }
        }
        //Ini buat logic kalau semisalnya masih ada peminjam yg sedang aktif meminjam, ataupun menunggu persetujuan maka otomatis ketolak
        $masihMeminjam = Peminjaman::where('anggota_id', $identifikasi['anggota_id'])
                        ->whereIn('status', [1, 2])
                        ->exists(); 


        if ($masihMeminjam) {
        return redirect()->route('pinjam.pilih-buku')
        ->with('error', 'Kamu masih memiliki buku yang belum dikembalikan. Kembalikan dulu sebelum meminjam buku baru.');
        }

        $kodePinjam = 'PJM-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        $peminjaman = Peminjaman::create([
            'kode_pinjam' => $kodePinjam,
            'peminjam_id' => 0,
            'anggota_id'  => $identifikasi['anggota_id'],
            'status'      => 1,
        ]);

        foreach ($listBuku as $buku) {
            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'buku_id'       => $buku->id,
            ]);
        }

        $request->session()->put('peminjaman_selesai', [
            'kode_pinjam'  => $kodePinjam,
            'nama'         => $identifikasi['nama_lengkap'],
            'kode_anggota' => $identifikasi['kode_anggota'] ?? '-',
            'jumlah_buku'  => count($listBuku),
            'judul_buku'   => $listBuku->pluck('judul')->toArray(),
        ]);

        $request->session()->forget(['peminjam_identifikasi', 'keranjang_pinjam']);

        return redirect()->route('pinjam.selesai');
    }
}