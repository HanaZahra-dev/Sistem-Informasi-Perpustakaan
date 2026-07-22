<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class IdentifikasiController extends Controller
{
    /**
     * Tampilkan form identifikasi peminjam.
     */
    public function index()
    {
        return view('peminjam.identifikasi.index');
    }

    /**
     * Validasi form, cek anggota di database, redirect sesuai hasil.
     *
     * - Ditemukan  → simpan data anggota ke session, redirect ke pilih buku
     * - Tidak ada  → simpan input ke session, redirect ke form daftar anggota
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_lengkap' => 'required|string|min:3|max:100',
                'nis_nip'      => 'required|string|min:4|max:20',
            ],
            [
                'nama_lengkap.required' => 'Nama lengkap wajib diisi ya!',
                'nama_lengkap.min'      => 'Nama terlalu pendek, minimal 3 huruf.',
                'nama_lengkap.max'      => 'Nama terlalu panjang, maksimal 100 huruf.',
                'nis_nip.required'      => 'NIS atau NIP wajib diisi ya!',
                'nis_nip.min'           => 'NIS/NIP terlalu pendek, minimal 4 karakter.',
                'nis_nip.max'           => 'NIS/NIP terlalu panjang, maksimal 20 karakter.',
            ]
        );

        $nis_nip = trim($request->nis_nip);

        // Cek apakah NIS/NIP sudah terdaftar sebagai anggota
        $anggota = Anggota::where('nis_nip', $nis_nip)->first();

        if ($anggota) {
            // ── ANGGOTA DITEMUKAN ──
            // Simpan data anggota lengkap ke session
            $request->session()->put('peminjam_identifikasi', [
                'anggota_id'    => $anggota->id,
                'kode_anggota'  => $anggota->kode_anggota,
                'nama_lengkap'  => $anggota->nama,
                'nis_nip'       => $anggota->nis_nip,
                'jenis_anggota' => $anggota->jenis_anggota,
                'kelas'         => $anggota->kelas,
                'sudah_anggota' => true,
            ]);

            return redirect()->route('pinjam.pilih-buku');
        }

        // ── ANGGOTA BELUM TERDAFTAR ──
        // Simpan input sementara agar form daftar bisa pre-fill
        $request->session()->put('peminjam_identifikasi', [
            'nama_lengkap'  => trim($request->nama_lengkap),
            'nis_nip'       => $nis_nip,
            'sudah_anggota' => false,
        ]);

        return redirect()->route('pinjam.daftar-anggota');
    }
}
