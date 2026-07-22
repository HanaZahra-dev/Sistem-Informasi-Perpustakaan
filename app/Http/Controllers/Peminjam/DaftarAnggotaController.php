<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class DaftarAnggotaController extends Controller
{
    /**
     * Tampilkan form pendaftaran anggota baru.
     * Jika tidak ada session identifikasi, kembalikan ke langkah 1.
     */
    public function index()
    {
        if (!session('peminjam_identifikasi')) {
            return redirect()->route('pinjam.identifikasi');
        }

        return view('peminjam.daftar-anggota.index');
    }

    /**
     * Simpan anggota baru ke database.
     * - Generate kode_anggota otomatis
     * - Simpan qr_code berisi kode_anggota (di-render oleh JS di sisi klien)
     * - Perbarui session dengan data anggota lengkap
     * - Redirect ke pilih buku
     */
    public function store(Request $request)
    {
        // Pastikan session identifikasi ada
        if (!session('peminjam_identifikasi')) {
            return redirect()->route('pinjam.identifikasi');
        }

        $request->validate(
            [
                'nama'          => 'required|string|min:3|max:100',
                'jenis_anggota' => 'required|in:siswa,guru',
                'kelas'         => 'required_if:jenis_anggota,siswa|nullable|string|max:10',
            ],
            [
                'nama.required'             => 'Nama lengkap wajib diisi ya!',
                'nama.min'                  => 'Nama terlalu pendek, minimal 3 huruf.',
                'jenis_anggota.required'    => 'Pilih jenis anggota dulu ya!',
                'jenis_anggota.in'          => 'Jenis anggota tidak valid.',
                'kelas.required_if'         => 'Kelas wajib dipilih untuk siswa.',
            ]
        );

        $nis_nip = session('peminjam_identifikasi.nis_nip');

        // Double-check: cegah duplikasi jika sudah terdaftar saat halaman masih terbuka
        $existing = Anggota::where('nis_nip', $nis_nip)->first();
        if ($existing) {
            $this->putSessionAnggota($request, $existing);
            return redirect()->route('pinjam.pilih-buku');
        }

        // Generate kode anggota unik
        $kode = Anggota::generateKodeAnggota();

        // Buat anggota baru
        $anggota = Anggota::create([
            'kode_anggota'  => $kode,
            'nama'          => trim($request->nama),
            'nis_nip'       => $nis_nip,
            'jenis_anggota' => $request->jenis_anggota,
            'kelas'         => $request->jenis_anggota === 'siswa' ? $request->kelas : null,
            'qr_code'       => $kode, // string yang akan di-render jadi QR di sisi klien
        ]);

        // Perbarui session dengan data anggota lengkap
        $this->putSessionAnggota($request, $anggota);

        return redirect()->route('pinjam.pilih-buku');
    }

    /**
     * Helper: simpan data anggota ke session.
     */
    private function putSessionAnggota(Request $request, Anggota $anggota): void
    {
        $request->session()->put('peminjam_identifikasi', [
            'anggota_id'    => $anggota->id,
            'kode_anggota'  => $anggota->kode_anggota,
            'nama_lengkap'  => $anggota->nama,
            'nis_nip'       => $anggota->nis_nip,
            'jenis_anggota' => $anggota->jenis_anggota,
            'kelas'         => $anggota->kelas,
            'sudah_anggota' => true,
        ]);
    }
}
